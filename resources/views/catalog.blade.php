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

        .filter {
            margin-right: 70%;
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

    
    .dropdown_catalog {
        cursor: pointer;
        color: black;
    }
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
        @if($product->photos->isNotEmpty())
        <a href="{{ route('product', $product->id) }}">
            <div class="card">
                <img src="{{ asset($product->photos->first()->photo_url) }}" loading="lazy" alt="Продукт">
                <p>{{ $product->title }}</p>
                <p>{{ $product->price }} ₽</p>
            </div>
        </a>
        @endif
        @endforeach
    </div>
</div>
<x-footer></x-footer>