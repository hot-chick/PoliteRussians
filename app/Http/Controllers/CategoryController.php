<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
    public function index()
    {
        $products = Product::with('photos')->get();
        $categories = Category::all();
        return view('index', compact('products', 'categories')); 
    }
}
