<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    public function index()
    {
        // Проверяем, есть ли кэшированные товары
        $products = Cache::remember('products_main_page', 60, function () {
            // Если кэша нет, загружаем товары и сохраняем их в кэш на 60 минут
            return Product::with('photos')->get();
        });

        $categories = Cache::remember('categories_main_page', 60, function () {
            return Category::all();
        });

        return view('index', compact('products', 'categories'));
    }
}
