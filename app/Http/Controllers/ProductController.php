<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function product_show($id)
    {
        $product = Product::with(['photos', 'sizes'])->findOrFail($id);
        $isInWishlist = in_array($id, session()->get('wishlist', []));
        $crossSoleProducts = Product::with('crossSoldProducts')->find($id);
        return view('product', compact('product', 'isInWishlist', 'crossSoleProducts'));
    }

    public function showByCompositeArticle($article)
    {
        $product = Product::where('article', $article)->firstOrFail();

        $isInWishlist = in_array($product->id, session()->get('wishlist', []));

        return view('product', compact('product', 'isInWishlist'));
    }

    public function index(Request $request)
    {
        $sort = $request->get('sort', 'asc');

        $products = Product::with('photos')
            ->orderBy('price', $sort)
            ->get();

        return view('catalog', compact('products', 'sort'));
    }


    public function search(Request $request)
    {
        $query = $request->input('query');
        try {
            $products = Product::where('title', 'LIKE', "%$query%")
                ->orWhere('article', 'LIKE', "%$query%")
                ->orWhere('description', 'LIKE', "%$query%")
                ->orWhereHas('category', function ($q) use ($query) {
                    $q->where('title', 'LIKE', "%$query%");
                })
                ->get();

            return response()->json($products);
        } catch (\Exception $e) {
            \Log::error('Search error: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }
}
