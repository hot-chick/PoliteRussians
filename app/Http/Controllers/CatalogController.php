<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class CatalogController extends Controller
{
    public function show($id)
    {
        $query = Product::query();

        // Фильтрация по категории, если передан id категории через URL
        if ($id) {
            $query->where('category_id', $id);
        }

        // Получаем все отфильтрованные продукты
        $products = $query->get();

        // Возвращаем представление с данными
        return view('catalog', compact('products'));
    }

    public function allproducts()
    {
        $products = Product::with('photos')->get();
        return view('catalog', compact('products'));
    }
}
