<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\SearchController;
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

Route::get('/delivery', function () {
    return view('delivery');
});

Route::get('/dolyami', function () {
    return view('dolyami');
});

Route::get('/giftcard', function () {
    return view('giftcard');
});

Route::get('/privacy_policy', function () {
    return view('privacy_policy');
});

Route::get('/', [CategoryController::class, 'index']);

Route::get('/catalog/{id}', [CatalogController::class, 'show'])->name('catalog');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// Маршрут для отображения продукта по ID
Route::get('/product/{id}', [ProductController::class, 'product_show'])->name('product');

// Маршрут для отображения продукта по составной статье
Route::get('/product/byArticle/{composite_article}', [ProductController::class, 'showByCompositeArticle'])->name('product.byArticle');

Route::get('/catalog', [CatalogController::class, 'allproducts']);

Route::post('/wishlist/toggle', [WishlistController::class, 'toggle'])->name('wishlist.toggle');

Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');

Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');

Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

Route::get('/cart/summary', [CartController::class, 'summary'])->name('cart.summary');

Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout.show');

Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');

Route::post('/apply-promo', [CartController::class, 'applyPromo'])->name('apply.promo');

Route::get('/get-delivery-points', [CheckoutController::class, 'getDeliveryPoints'])->name('get.delivery.points');

Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');

Route::post('/subscribe', [NewsletterController::class, 'store'])->name('subscribe');

Route::get('/search', [ProductController::class, 'search'])->name('search');
