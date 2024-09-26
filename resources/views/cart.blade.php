<x-Layout></x-Layout>
<style>
    header {
        background-color: #fff;
        border-bottom: 1px solid rgb(231, 231, 231);
        color: black;
    }

    header a {
        color: black;
    }

    .logo img {
        filter: invert(1);
    }

    .user_menu img {
        filter: invert(1);
    }

    p {
        color: black
    }

    header:hover {
        background-color: rgb(231, 231, 231);
        border-bottom: 1px solid rgb(231, 231, 231);
        color: black;
    }

    .dropdown-content {
        background-color: rgb(231, 231, 231);
    }

    @media (max-width: 768px) {
        header {
            background-color: rgb(231, 231, 231);
            height: 80px;
        }

    }

    h1 {
        width: 100%;
        text-align: center;
        font-size: 36px;
        margin-bottom: 20px;
    }

    .wishlist-count {
        color: black;
    }

    .cart-count {
        color: black;
    }


    .dropdown_catalog {
        cursor: pointer;
        color: black;
    }

    h1 {
        font-weight: 500;
    }
</style>
<h1>Корзина</h1>
<div class="cart">
    @if (!session('cart') || count(session('cart')) === 0)
    <p>Корзина пуста. Вы пока ничего не добавили в корзину.</p>
    <a href="/catalog" class="btn btn-primary">В каталог</a>
    @else
    <div class="products-grid">
        @php
        $totalPrice = 0;
        $cartItems = [];

        // Группируем товары по ID
        foreach (session('cart', []) as $item) {
        $cartItems[$item['product_id']][] = $item;
        }
        @endphp

        @foreach ($cartItems as $productId => $items)
        @php
        $product = \App\Models\Product::find($productId);
        if ($product) {
        $totalPrice += $product->price * count($items); // Суммируем цену с учетом количества
        }
        @endphp

        @if ($product && $product->photos->isNotEmpty())
        <div class="card">
            <a href="{{ route('product', $product->id) }}">
                <img src="{{ asset($product->photos->first()->photo_url) }}" alt="{{ $product->title }}">
            </a>
            <p>{{ $product->title }}</p>
            <p>{{ $product->price }} ₽</p>
            @php
            $size = $items[0]['size']; // Все товары имеют одинаковый размер
            @endphp
            <p>Размер: {{ $size }}</p>
            <div class="quantity-controls">
                <p>Количество:</p>
                <p class="quantity"> {{ count($items) }}</p>
            </div>
            <button class="add-to-cart" data-product-id="{{ $product->id }}">Удалить</button>
        </div>
        @endif
        @endforeach
    </div>

    <div class="cart-summary">
        <p>Итого к оплате: <strong>{{ $totalPrice }} ₽</strong></p>
        <a href="/checkout" class="btn btn-primary">Оформить заказ</a>
    </div>
    @endif
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const quantityButtons = document.querySelectorAll('.quantity-btn');
        const cartSummary = document.querySelector('.cart-summary p strong');

        function updateCart(productId, quantity) {
            fetch('/cart/update', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        productId: productId,
                        quantity: quantity
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        updateCartSummary();
                    } else {
                        console.error('Ошибка при обновлении количества товара.');
                    }
                })
                .catch(error => console.error('Ошибка:', error));
        }

        function updateCartSummary() {
            fetch('/cart/summary')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        cartSummary.textContent = `${data.totalPrice} Р`;
                    } else {
                        console.error('Ошибка при обновлении суммы корзины.');
                    }
                })
                .catch(error => console.error('Ошибка:', error));
        }

        quantityButtons.forEach(button => {
            button.addEventListener('click', () => {
                const productId = button.getAttribute('data-product-id');
                const action = button.getAttribute('data-action');
                const quantitySpan = button.parentElement.querySelector('.quantity');

                let quantity = parseInt(quantitySpan.textContent);

                if (action === 'increase') {
                    quantity += 1;
                } else if (action === 'decrease' && quantity > 1) {
                    quantity -= 1;
                }

                // Обновляем количество на клиенте
                quantitySpan.textContent = quantity;

                // Обновляем корзину на сервере
                updateCart(productId, quantity);
            });
        });

        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', () => {
                const productId = button.getAttribute('data-product-id');

                fetch('/cart/remove', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            productId: productId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            window.location.reload(); // Перезагрузка страницы после успешного удаления
                        } else {
                            console.error('Ошибка при удалении товара.');
                        }
                    })
                    .catch(error => console.error('Ошибка:', error));
            });
        });

        // Инициализация суммы корзины при загрузке страницы
        updateCartSummary();
    });
</script>

<x-footer></x-footer>