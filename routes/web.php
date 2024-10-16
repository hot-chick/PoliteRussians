<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

Route::get('/generate-sitemap', function () {
    // Создаем объект карты сайта
    Sitemap::create()
        ->add(Url::create('/')->setPriority(1.0))
        ->add(Url::create('about_us')->setPriority(1.0))
        ->add(Url::create('/delivery')->setPriority(0.8))
        ->add(Url::create('/giftcatd')->setPriority(0.8))
        ->add(Url::create('/shops')->setPriority(1.0))
        ->add(Url::create('/catalog')->setPriority(1.0))
        ->add(Url::create('/products')->setPriority(0.8))
        ->add(Url::create('/contacts')->setPriority(0.7))
        // Добавляем динамические ссылки на продукты
        ->add(Url::create('/product/{id}')->setPriority(0.6))
        // Можете добавить сюда другие URL или динамически загружать страницы
        ->writeToFile(public_path('sitemap.xml'));

    return "Карта сайта успешно создана!";
});

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

Route::get('/product/{id}', [ProductController::class, 'product_show'])->name('product');

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

Route::post('/apply-promo', [CartController::class, 'applyPromo'])->name('apply.promo');

Route::get('/get-delivery-points', [CheckoutController::class, 'getDeliveryPoints'])->name('get.delivery.points');

Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout.show');

Route::post('/cart/remove', [CheckoutController::class, 'remove'])->name('cart.remove');

Route::get('/search', [ProductController::class, 'search'])->name('search');

Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');

Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');

Route::get('/checkout/payment/success', [CheckoutController::class, 'paymentSuccess'])->name('checkout.payment.success');

Route::post('/checkout/create-payment', [CheckoutController::class, 'process']); // Для создания платежа