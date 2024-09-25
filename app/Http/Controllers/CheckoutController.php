<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

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
            'address' => 'required|string|max:255',
            'delivery' => 'required|string',
            'payment' => 'required|string',
            'pickup_point' => 'nullable|string' // Allow pickup point to be optional
        ]);

        // Collect the data from the request
        $orderData = $request->only(['name', 'lastname', 'email', 'phone', 'address', 'delivery', 'payment', 'pickup_point']);

        // Optionally, you could save this order to your database
        // Order::create($orderData);

        // Clear the cart after processing the order
        Session::forget('cart');

        // Redirect to the success page with the order details
        return redirect()->route('checkout.success')->with('orderData', $orderData);
    }

    public function getDeliveryPoints()
    {
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
    }

    public function success()
    {
        return view('checkout-success');
    }
}
