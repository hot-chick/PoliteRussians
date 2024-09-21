<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function show()
    {
        return view('checkout');
    }

    public function process(Request $request)
    {
        // Получаем данные из формы
        $data = $request->only(['name', 'email', 'phone', 'address', 'delivery', 'payment']);
        $cart = Session::get('cart', []);

        // Здесь можно сохранить заказ в базу данных, отправить уведомление и т.д.

        // Очистить корзину после оформления заказа
        Session::forget('cart');

        return redirect()->route('checkout.success');
    }

    public function API()
    {
        $data = [
            'grant_type' => 'client_credentials',
            'client_id' => 'AYbysMJOhZ7SYdkQ1SdnDGZLjmBXL1dd',
            'client_secret' => 'FekzxWMxnrk5amylVrxDwyufxapsNEnI'
        ];

        // $response = Http::post('https://api.cdek.ru/v2/oauth/token?parameters', $data);
        $response = Http::asForm()->post('https://api.cdek.ru/v2/oauth/token', $data);

        // dd($response->json());

        $auth = $response->json();

        $city = Http::withToken($auth['access_token'])->get('https://api.edu.cdek.ru/v2/location/cities');

        $delpointsdata = [
            'city_code1',
        ];
        
        $coord = Http::withToken($auth['access_token'])->get('https://api.cdek.ru/v2/deliverypoints');

        dd($city->json());
    }

    public function success()
    {
        return view('checkout-success');
    }
}
