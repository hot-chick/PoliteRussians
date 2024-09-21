<?php

namespace App\View\Components;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Layout extends Component
{
    public $categories;
    public $wishlistCount;
    public $cartCount;

    public function __construct()
    {
        // Получаем категории
        $this->categories = Category::all();

        // Получаем количество товаров в избранном (wishlist)
        $this->wishlistCount = count(session()->get('wishlist', []));

        // Получаем количество товаров в корзине (cart)
        $this->cartCount = count(session()->get('cart', []));
    }

    public function render(): View|Closure|string
    {
        return view('components.Layout', [
            'categories' => $this->categories,
            'wishlistCount' => $this->wishlistCount,
            'cartCount' => $this->cartCount,
        ]);
    }
}
