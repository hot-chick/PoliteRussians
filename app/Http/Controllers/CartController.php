<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Promo;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $productId = $request->input('productId');
        $size = $request->input('size');

        // Получаем текущую корзину из сессии
        $cart = session()->get('cart', []);

        // Добавляем товар в корзину
        $cart[] = [
            'product_id' => $productId,
            'size' => $size
        ];

        // Сохраняем корзину в сессии
        session()->put('cart', $cart);

        return response()->json(['success' => true]);
    }


    public function index()
    {
        // Получаем текущую корзину из сессии
        $cart = session()->get('cart', []);

        // Извлекаем ID продуктов, которые находятся в корзине
        $productIds = array_column($cart, 'product_id');

        // Получаем продукты из базы данных, которые есть в корзине
        $products = Product::whereIn('id', $productIds)->get();

        // Связываем размеры с продуктами для отображения
        foreach ($products as $product) {
            $product->size = collect($cart)->firstWhere('product_id', $product->id)['size'] ?? '';
        }

        // Передаем переменные в шаблон
        return view('cart', compact('products'));
    }

    public function update(Request $request)
    {
        $productId = $request->input('productId');
        $quantity = $request->input('quantity');

        $cart = session()->get('cart', []);
        $updatedCart = [];

        foreach ($cart as $item) {
            if ($item['product_id'] == $productId) {
                if ($quantity > 0) {
                    $item['quantity'] = $quantity;
                    $updatedCart[] = $item;
                }
            } else {
                $updatedCart[] = $item;
            }
        }

        session()->put('cart', $updatedCart);

        return response()->json(['success' => true]);
    }

    public function remove(Request $request)
    {
        $productId = $request->input('productId');

        $cart = session()->get('cart', []);
        $updatedCart = array_filter($cart, function ($item) use ($productId) {
            return $item['product_id'] != $productId;
        });

        session()->put('cart', $updatedCart);

        return response()->json(['success' => true]);
    }

    public function summary()
    {
        $cart = session()->get('cart', []);
        $totalPrice = 0;

        foreach ($cart as $item) {
            $product = \App\Models\Product::find($item['product_id']);
            if ($product) {
                $totalPrice += $product->price * $item['quantity'];
            }
        }

        return response()->json(['success' => true, 'totalPrice' => $totalPrice]);
    }

    public function applyPromo(Request $request)
    {
        // Валидация данных
        $request->validate([
            'promo_code' => 'required|string'
        ]);

        // Поиск промокода в базе данных
        $promo = Promo::where('title', $request->promo_code)->first();

        if ($promo) {
            return response()->json([
                'success' => true,
                'discount' => $promo->discount
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Неверный промокод'
            ]);
        }
    }
}
