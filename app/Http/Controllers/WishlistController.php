<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class WishlistController extends Controller
{
    public function toggle(Request $request)
    {
        $productId = $request->input('productId');

        if (!$productId) {
            return response()->json(['success' => false], 400);
        }

        $wishlist = session()->get('wishlist', []);

        if (in_array($productId, $wishlist)) {
            $wishlist = array_diff($wishlist, [$productId]);
        } else {
            $wishlist[] = $productId;
        }

        session()->put('wishlist', $wishlist);

        return response()->json(['success' => true]);
    }

    public function index()
    {
        $wishlist = session()->get('wishlist', []);
        $products = Product::whereIn('id', $wishlist)->get();

        return view('wishlist', compact('products'));
    }
}
