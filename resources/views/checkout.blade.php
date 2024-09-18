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
        background-color: rgb(219, 219, 219);
        border-bottom: 1px solid rgb(231, 231, 231);
        color: black;
    }

    .dropdown-content {
        background-color: rgb(219, 219, 219);
    }

    @media (max-width: 768px) {
        header {
            background-color: rgb(219, 219, 219);
            height: 80px;
        }
    }

    input {
        opacity: 0.7;
    }

    input:hover {
        opacity: 1;
    }

    .wishlist-count {
        color: black;
    }

    .cart-count {
        color: black;
    }
</style>
<div class="checkout">
    <h1>Оформление заказа</h1>

    <form id="checkout-form" action="{{ route('checkout.process') }}" method="POST">
        @csrf
        <!-- Личные данные -->
        <div class="form-section">
            <h2>Ваши данные</h2>
            <div class="first">
                <div class="form-group">
                    {{-- <label for="name">Имя:</label> --}}
                    <input type="text" id="name" name="name" placeholder="Имя" required>
                </div>
                <div class="form-group">
                    {{-- <label for="lastname">Фамилия:</label> --}}
                    <input type="text" id="lastname" name="lastname" placeholder="Фамилию" required>
                </div>
            </div>
            <div class="second">
                <div class="form-group">
                    {{-- <label for="email">Email:</label> --}}
                    <input type="email" id="email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    {{-- <label for="phone">Телефон:</label> --}}
                    <input type="text" id="phone" name="phone" placeholder="Телефон" required>
                </div>
            </div>
            <div class="form-group">
                {{-- <label for="address">Адрес доставки:</label> --}}
                <input type="text" id="address" name="address" placeholder="Адрес доставки" required>
            </div>
        </div>

        <!-- Способ доставки -->
        <div class="form-section">
            <h2>Способ доставки</h2>
            <div class="delivery-options">
                <label>
                    <input type="radio" name="delivery" value="courier" checked>
                    Доставка курьером
                </label>
                <label>
                    <input type="radio" name="delivery" value="pickup">
                    Самовывоз
                </label>
            </div>
        </div>

        <!-- Способ оплаты -->
        <div class="form-section">
            <h2>Способ оплаты</h2>
            <div class="payment-options">
                <label>
                    <input type="radio" name="payment" value="cash" checked>
                    При получении
                </label>
                <label>
                    <input disabled type="radio" name="payment" value="card">
                    Оплата онлайн
                </label>
                <label>
                    <input disabled type="radio" name="payment" value="installments">
                    Оплата "Долями"
                </label>
            </div>
        </div>

        <!-- Сводка заказа -->
        <div class="order-summary">
            <h2>Ваш заказ</h2>
            <div class="products-grid">
                @php
                    $totalPrice = 0; // Обнуляем переменную для суммы
                @endphp

                @foreach (session('cart', []) as $item)
                    @php
                        $product = \App\Models\Product::find($item['product_id']);
                    @endphp

                    @if ($product && $product->photos->isNotEmpty())
                        <div class="card">
                            <a href="{{ route('product', $product->id) }}">
                                <img src="{{ asset($product->photos->first()->photo_url) }}"
                                    alt="{{ $product->title }}">
                            </a>
                            <p>{{ $product->title }}</p>
                            <p>{{ $product->price }} Р</p>
                            <p>Размер: {{ $item['size'] }}</p>

                            @php
                                $totalPrice += $product->price; // Добавляем цену товара к общей сумме
                            @endphp
                        </div>
                    @endif
                @endforeach
            </div>

            <div class="cart-summary">
                <p>Итого к оплате: <strong>{{ $totalPrice }} Р</strong></p>
            </div>
        </div>

        <!-- Кнопка отправки формы -->
        <button type="submit" class="btn btn-primary">Оформить заказ</button>
    </form>
</div>


<x-footer></x-footer>
