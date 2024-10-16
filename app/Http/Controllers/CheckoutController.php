<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;
use App\Mail\OrderConfirmation;
use Illuminate\Support\Facades\Mail;
use App\Models\Product;
use App\Models\Promo;
use YooKassa\Client;
use App\Models\Order;
use Exception;

class CheckoutController extends Controller
{
    public function remove(Request $request)
    {
        $productId = $request->input('product_id');
        $cart = session('cart', []);

        // Удаляем товар из корзины
        foreach ($cart as $key => $item) {
            if ($item['product_id'] == $productId) {
                unset($cart[$key]);
                break; // Останавливаем цикл после удаления товара
            }
        }

        // Перезаписываем сессию
        session()->put('cart', array_values($cart));

        return response()->json(['success' => true]);
    }
    public function show()
    {
        // Get delivery points when showing the checkout page
        $points = $this->getDeliveryPoints();
        return view('checkout')->with('points', $points);
    }


    public function process(Request $request)
    {
        // Валидация входящего запроса
        $request->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:255',
            'delivery' => 'required|string',
            'payment' => 'required|string', // Определяем способ оплаты
            'pickup_point' => 'nullable|string',
            'promo_code' => 'nullable|string',
        ]);

        // Получаем товары из сессии
        $cartItems = session('cart', []);
        if (empty($cartItems)) {
            return response()->json(['error' => 'Корзина пуста.']);
        }

        $totalPrice = 0;
        $orderedProducts = [];

        // Цикл по товарам в корзине
        foreach ($cartItems as $item) {
            $product = Product::find($item['product_id']);
            if ($product) {
                $quantity = isset($item['quantity']) ? $item['quantity'] : 1;
                $totalPrice += $product->price * $quantity;

                $orderedProducts[] = [
                    'description' => $product->title,
                    'quantity' => number_format($quantity, 2, '.', ''),
                    'amount' => [
                        'value' => number_format($product->price, 2, '.', ''),
                        'currency' => 'RUB',
                    ],
                    'vat_code' => '2',
                    'payment_mode' => 'full_prepayment',
                    'payment_subject' => 'commodity',
                ];
            }
        }

        // Обработка промокода
        $discount = 0;
        if ($request->has('promo_code')) {
            $promo = Promo::where('title', $request->input('promo_code'))->first();
            if ($promo) {
                $discount = $promo->discount;
                $totalPrice -= ($totalPrice * $discount / 100);
            }
        }

        $orderData = $request->only(['name', 'lastname', 'email', 'phone', 'address', 'delivery', 'payment', 'pickup_point']);
        $orderData['totalPrice'] = $totalPrice;
        $orderData['discount'] = $discount;
        $orderData['products'] = $orderedProducts;
        Session::put('order_data', $orderData); // Сохраняем в сессии

        // Проверяем тип оплаты
        if ($request->payment == 'cash') {
            // Логика для оплаты наличными
            return $this->handleCashPayment($request, $orderedProducts, $totalPrice, $discount);
        } else {
            // Логика для оплаты через ЮKassa
            return $this->handleYooKassaPayment($request, $orderedProducts, $totalPrice, $discount);
        }
    }

    private function handleCashPayment($request, $orderedProducts, $totalPrice, $discount)
    {
        $orderData = $request->only(['name', 'lastname', 'email', 'phone', 'address', 'delivery', 'payment', 'pickup_point']);
        $orderData['totalPrice'] = $totalPrice;
        $orderData['discount'] = $discount;
        $orderData['products'] = $orderedProducts;

        Mail::to($orderData['email'])->send(new OrderConfirmation($orderData));
        Mail::to('polite.russians.ru@yandex.ru')->send(new OrderConfirmation($orderData));

        // Очистка корзины и перенаправление на страницу успеха
        Session::forget('cart');

        return response()->json(['success' => true, 'redirect_url' => route('checkout.success')]);
    }

    private function handleYooKassaPayment($request, $orderedProducts, $totalPrice, $discount)
    {
        $client = new Client();
        $client->setAuth(env('YOOKASSA_SHOP_ID'), env('YOOKASSA_SECRET_KEY'));

        try {
            $payment = $client->createPayment([
                'amount' => [
                    'value' => number_format($totalPrice, 2, '.', ''),
                    'currency' => 'RUB',
                ],
                'capture' => true,
                'confirmation' => [
                    'type' => 'redirect',
                    'return_url' => route('checkout.payment.success'), // Перенаправление на успешную оплату
                ],
                'description' => 'Оплата заказа',
                'receipt' => [
                    'customer' => [
                        'email' => $request->email,
                        'phone' => $request->phone,
                    ],
                    'items' => $orderedProducts,
                ],
            ], uniqid('', true));

            // Сохраняем payment_id в сессии
            session()->put('payment_id', $payment->getId());

            return response()->json(['confirmation_url' => $payment->getConfirmation()->getConfirmationUrl()]);
        } catch (Exception $e) {
            \Log::error('Ошибка создания платежа: ' . $e->getMessage());
            return response()->json(['error' => 'Ошибка при создании платежа']);
        }
    }

    public function getDeliveryPoints()
    {
        return Cache::remember('cdek_delivery_points', 3600, function () {
            // Получаем токен для доступа к API CDEK
            $data = [
                'grant_type' => 'client_credentials',
                'client_id' => 'AYbysMJOhZ7SYdkQ1SdnDGZLjmBXL1dd',
                'client_secret' => 'FekzxWMxnrk5amylVrxDwyufxapsNEnI'
            ];

            $response = Http::asForm()->post('https://api.cdek.ru/v2/oauth/token', $data);
            $auth = $response->json();

            // Получаем пункты доставки (фильтр по стране Россия)
            $deliveryPointsResponse = Http::withToken($auth['access_token'])
                ->get('https://api.cdek.ru/v2/deliverypoints', [
                    'country_code' => 'RU' // Фильтр по России
                ]);

            $deliveryPoints = $deliveryPointsResponse->json();

            // Проверяем, что массив не пустой
            if (empty($deliveryPoints)) {
                return []; // Возвращаем пустой массив
            }

            // Фильтруем только пункты ПВЗ (исключаем постаматы и другие точки)
            return array_map(function ($point) {
                return [
                    'latitude' => $point['location']['latitude'] ?? null,
                    'longitude' => $point['location']['longitude'] ?? null,
                    'name' => $point['name'] ?? 'Без имени'
                ];
            }, array_filter($deliveryPoints, function ($point) {
                return isset($point['type']) && $point['type'] === 'PVZ'; // Фильтруем только PVZ
            }));
        });
    }

    public function success()
    {
        return view('checkout-success');
    }

    public function paymentSuccess(Request $request)
    {
        // Получаем payment_id из сессии
        $paymentId = session()->get('payment_id');

        if (!$paymentId) {
            return redirect()->route('checkout.failure')->with('error', 'Платеж не найден.');
        }

        $client = new Client();
        $client->setAuth(env('YOOKASSA_SHOP_ID'), env('YOOKASSA_SECRET_KEY'));

        try {
            $payment = $client->getPaymentInfo($paymentId); // Получение информации о платеже

            if ($payment->status === 'succeeded') {
                // Логика отправки уведомления
                $orderData = session('order_data');
                Mail::to($orderData['email'])->send(new OrderConfirmation($orderData));
                Mail::to('polite.russians.ru@yandex.ru')->send(new OrderConfirmation($orderData));

                // Очистка корзины
                Session::forget('cart');

                return redirect()->route('checkout.success')->with('order', $orderData);
            } else {
                return redirect()->route('checkout.failure')->with('error', 'Оплата не удалась.');
            }
        } catch (Exception $e) {
            \Log::error('Ошибка при проверке платежа: ' . $e->getMessage());
            return redirect()->route('checkout.failure')->with('error', 'Ошибка при проверке статуса платежа.');
        }
    }
}
