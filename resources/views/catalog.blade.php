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

        .filter {
            margin-right: 60%;
        }

        .filter_sort {
            width: 20%;
            gap: 20px;
        }

        .customm-select {
            width: 150px;
        }
    }

    .wishlist-count {
        color: black;
    }

    .cart-count {
        color: black;
    }

    /* Общий стиль для контейнера сортировки */
</style>
<div class="container">
    <div class="filter">
        <div class="filter_sort">
            <form method="GET" action="{{ route('products.index') }}" class="sort-form">
                <div class="sort">
                    <p>Сортировка</p>
                    <div class="select-wrapper">
                        <select name="sort" onchange="this.form.submit()" class="customm-select">
                            <option value="asc" {{ request('sort') === 'asc' ? 'selected' : '' }}>По возрастанию</option>
                            <option value="desc" {{ request('sort') === 'desc' ? 'selected' : '' }}>По убыванию</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="products">
        @foreach($products as $product)
        <!-- Проверяем, есть ли у продукта хотя бы одна фотография -->
        @if($product->photos->isNotEmpty())
        <a href="{{ route('product', $product->id) }}">
            <div class="card">
                <!-- Выводим первую фотографию продукта -->
                <img src="{{ asset($product->photos->first()->photo_url) }}" alt="Продукт">
                <p>{{ $product->title }}</p>
                <p>{{ $product->price }} Р</p>
            </div>
        </a>
        @endif
        @endforeach
    </div>
</div>
<x-footer></x-footer>