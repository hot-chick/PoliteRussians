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
}
