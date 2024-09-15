<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    public function success()
    {
        return view('checkout-success');
    }
}
