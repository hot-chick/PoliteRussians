<x-layout></x-layout>
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
</style>
<div class="cart">
    <h1>Корзина</h1>

    @if ($products->isEmpty())
        <p>Корзина пуста. Вы пока ничего не добавили в корзину.</p>
        <a href="/catalog" class="btn btn-primary">В каталог</a>
    @else
        @foreach ($products as $product)
            <div class="cart-item">
                <!-- Отображаем заголовок товара и его размер -->
                <p>Товар: {{ $product->title }} - Размер: {{ $product->size }}</p>
                <form action="{{ route('cart.remove') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="size" value="{{ $product->size }}">
                    <button class="btn-primary" type="submit">Удалить</button>
                </form>
            </div>
        @endforeach
    @endif
</div>


<x-footer></x-footer>
