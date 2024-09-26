<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;
use App\Mail\OrderConfirmation;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
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
                $totalPrice += $product->price;
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

        // Prepare order data
        $orderData = $request->only(['name', 'lastname', 'email', 'phone', 'address', 'delivery', 'payment', 'pickup_point']);
        $orderData['totalPrice'] = $totalPrice;
        $orderData['discount'] = $discount;
        $orderData['products'] = $orderedProducts; // Adding the ordered products

        // Send email to customer
        Mail::to($orderData['email'])->send(new OrderConfirmation($orderData));

        // Send email to the fixed email address
        Mail::to('zaitkulov4@gmail.com')->send(new OrderConfirmation($orderData));

        // Clear the cart after processing the order
        Session::forget('cart');

        // Redirect to the success page
        return redirect()->route('checkout.success')->with('orderData', $orderData);
    }

    public function getDeliveryPoints()
    {
        return Cache::remember('cdek_delivery_points', 3600, function () {
            $data = [
                'grant_type' => 'client_credentials',
                'client_id' => 'AYbysMJOhZ7SYdkQ1SdnDGZLjmBXL1dd',
                'client_secret' => 'FekzxWMxnrk5amylVrxDwyufxapsNEnI'
            ];

            $response = Http::asForm()->post('https://api.cdek.ru/v2/oauth/token', $data);
            $auth = $response->json();

            // Получение пунктов выдачи
            $deliveryPointsResponse = Http::withToken($auth['access_token'])->get('https://api.cdek.ru/v2/deliverypoints');
            $deliveryPoints = $deliveryPointsResponse->json();

            // Проверяем, что массив не пустой
            if (empty($deliveryPoints)) {
                return []; // Возвращаем пустой массив
            }

            // Извлекаем только необходимые данные
            return array_map(function ($point) {
                return [
                    'latitude' => $point['location']['latitude'] ?? null,
                    'longitude' => $point['location']['longitude'] ?? null,
                    'name' => $point['name'] ?? 'Без имени'
                ];
            }, $deliveryPoints);
        });
    }

    public function success()
    {
        return view('checkout-success');
    }
}
