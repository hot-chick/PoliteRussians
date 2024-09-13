<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function add(Request $request)
    {
        // Получаем ID товара и выбранный размер из запроса
        $productId = $request->input('productId');
        $size = $request->input('size');

        if (!$productId || !$size) {
            return response()->json(['success' => false, 'message' => 'Не указаны все параметры.'], 400);
        }

        // Получаем текущую корзину из сессии
        $cart = session()->get('cart', []);

        // Добавляем товар в корзину с ID продукта и размером
        $cart[] = ['product_id' => $productId, 'size' => $size];

        // Сохраняем обновленную корзину в сессии
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

    public function remove(Request $request)
    {
        $productId = $request->input('product_id');
        $size = $request->input('size');

        $cart = session()->get('cart', []);

        // Фильтруем корзину, удаляя товар с соответствующим ID и размером
        $updatedCart = array_filter($cart, function ($item) use ($productId, $size) {
            return !($item['product_id'] == $productId && $item['size'] == $size);
        });

        // Обновляем корзину в сессии
        session()->put('cart', $updatedCart);

        return redirect()->back()->with('success', 'Товар удален из корзины.');
    }
}
