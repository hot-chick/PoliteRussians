<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CartController;
use App\Models\Category;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/product', function () {
    return view('product');
});

Route::get('/shops', function () {
    return view('shops');
});

Route::get('/lookbook', function () {
    return view('lookbook');
});

Route::get('/about_us', function () {
    return view('about_us');
});

Route::get('/contacts', function () {
    return view('contacts');
});

Route::get('/cart', function () {
    return view('cart');
});

Route::get('/', [CategoryController::class, 'index']);

Route::get('/catalog/{id}', [CatalogController::class, 'show'])->name('catalog');

Route::get('/product/{id}', [ProductController::class, 'product_show'])->name('product');

Route::get('/catalog', [CatalogController::class, 'allproducts']);

Route::post('/wishlist/toggle', [WishlistController::class, 'toggle'])->name('wishlist.toggle');

Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
