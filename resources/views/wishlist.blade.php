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

    .wishlist h1 {
        font-weight: normal;
    }

    .wishlist-count {
        color: black;
    }

    .dropdown_catalog {
        cursor: pointer;
        color: black;
    }
    .cart-count {
        color: black;
    }
</style>
<div class="seolinks">
    <a class="seolinks0" href="/">Главная </a>/ <a class="seolinks1" href="/wishlist"> Список желаемого</a>
</div>
<div class="wishlist">
    @if ($products->isEmpty())
    <h1>Список избранного</h1>
    <p>Здесь вы можете сохранять товары, которые вам понравились,
        чтобы вернуться к ним позже и обдумать покупку.</p>
    <a href="/catalog" class="btn btn-primary">В каталог</a>
    @else
    <h1>Ваш список избранного</h1>
    <div class="products-grid">
        @foreach ($products as $product)
        @if ($product->photos->isNotEmpty())
        <div class="card">
            <a href="{{ route('product', $product->id) }}">
                <img src="{{ asset($product->photos->first()->photo_url) }}" alt="{{ $product->title }}">
            </a>
            <p>{{ $product->title }}</p>
            <p>{{ $product->price }} Р</p>
            <div class="remove-from-wishlist" data-product-id="{{ $product->id }}">
                <img src="/img/filled_heart_red.png" alt="Remove from wishlist">
            </div>
        </div>
        @endif
        @endforeach
    </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const removeFromWishlistButtons = document.querySelectorAll('.remove-from-wishlist');

        removeFromWishlistButtons.forEach(button => {
            button.addEventListener('click', () => {
                const productId = button.dataset.productId;

                fetch('/wishlist/toggle', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector(
                                'meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            productId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Удаляем карточку продукта из DOM
                            button.closest('.card').remove();
                            console.log('Product removed from wishlist.');
                        } else {
                            console.error('Error removing product from wishlist.');
                        }
                    });
            });
        });
    });
</script>
<x-footer></x-footer>