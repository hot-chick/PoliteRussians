<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;
use App\Mail\OrderConfirmation;
use Illuminate\Support\Facades\Mail;
use YooKassa\Client;

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
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:255',
            'delivery' => 'required|string',
            'payment' => 'required|string',
            'pickup_point' => 'nullable|string',
            'promo_code' => 'nullable|string',
        ]);

        // Get cart items
        $cartItems = session('cart', []);
        $totalPrice = 0;
        $orderedProducts = [];

        foreach ($cartItems as $item) {
            $product = \App\Models\Product::find($item['product_id']);

            if ($product) {
                // Если 'quantity' не задан, установим его в 1 по умолчанию
                $quantity = isset($item['quantity']) ? $item['quantity'] : 1;

                $totalPrice += $product->price * $quantity; // Учитываем количество товаров

                $orderedProducts[] = [
                    'title' => $product->title,
                    'price' => $product->price,
                    'size' => $item['size']
                ];
            }
        }

        // Promo code logic
        $discount = 0;
        if ($request->has('promo_code')) {
            $promo = \App\Models\Promo::where('title', $request->input('promo_code'))->first();
            if ($promo) {
                $discount = $promo->discount;
                $totalPrice = $totalPrice - ($totalPrice * $discount / 100);
            }
        }

        $orderData = $request->only(['name', 'lastname', 'email', 'phone', 'address', 'delivery', 'payment', 'pickup_point']);
        $orderData['totalPrice'] = $totalPrice;
        $orderData['discount'] = $request->input('discount', 0); // Получаем скидку из запроса
        $orderData['products'] = $orderedProducts; // Adding the ordered products

        // Send email to customer
        Mail::to($orderData['email'])->send(new OrderConfirmation($orderData));

        // Send email to the fixed email address
        Mail::to('polite.russians.ru@yandex.ru')->send(new OrderConfirmation($orderData));

        // Clear the cart after processing the order
        Session::forget('cart');

        // Redirect to the success page
        return redirect()->route('checkout.success')->with('orderData', $orderData);
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

    public function createPayment(Request $request)
    {
        // Создаем клиента Yookassa
        $client = new Client();
        $client->setAuth('shopId', 'secretKey'); // Замените на ваш Shop ID и секретный ключ

        // Формируем данные для платежа
        $payment = $client->createPayment(
            [
                'amount' => [
                    'value' => number_format($request->total, 2, '.', ''), // Общая сумма заказа
                    'currency' => 'RUB',
                ],
                'confirmation' => [
                    'type' => 'redirect',
                    'return_url' => route('payment.success'), // Страница для возврата после оплаты
                ],
                'capture' => true,
                'description' => 'Оплата заказа №' . $request->order_id,
            ],
            uniqid('', true) // Уникальный идентификатор заказа
        );

        // Возвращаем URL для перенаправления на страницу оплаты
        return redirect($payment->getConfirmation()->getConfirmationUrl());
    }

    public function paymentSuccess(Request $request)
    {
        // Логика успешной оплаты
        return view('checkout.success');
    }
}
