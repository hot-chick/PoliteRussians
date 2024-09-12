<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function product_show($id)
    {
        $product = Product::with('photos')->findOrFail($id); // Загружаем продукт с фотографиями
        return view('product', compact('product')); // Передаем продукт в представление
    }
}
