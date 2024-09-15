<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function product_show($id)
    {
        $product = Product::with(['photos', 'sizes'])->findOrFail($id); // Загружаем продукт с фотографиями и размерами
        $isInWishlist = in_array($id, session()->get('wishlist', []));
        return view('product', compact('product', 'isInWishlist')); // Передаем переменную isInWishlist
    }

    public function showByCompositeArticle($article)
    {
        // Поиск товара по составной статье
        $product = Product::where('article', $article)->firstOrFail();

        // Проверка, находится ли товар в избранном
        $isInWishlist = in_array($product->id, session()->get('wishlist', []));

        // Возвращаем вид продукта
        return view('product', compact('product', 'isInWishlist'));
    }

    public function index(Request $request)
    {
        // Получаем параметр сортировки из запроса, если он не передан, то по умолчанию сортировка по возрастанию
        $sort = $request->get('sort', 'asc');

        // Получаем продукты с фотографиями и сортируем по цене
        $products = Product::with('photos')
            ->orderBy('price', $sort)  // Сортируем по цене
            ->get();

        // Передаем данные в представление
        return view('catalog', compact('products', 'sort'));
    }
}
