<x-Layout></x-Layout>
<style>
    .image-container {
        position: relative;
        width: 100%;
        height: calc(100vh + 80px);
        margin-top: -150px;
        overflow: hidden;
    }

    .indeximg {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: top;
    }

    .category-container {
        position: absolute;
        bottom: 20px; 
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 20px;
        justify-content: space-between;
        flex-wrap: wrap;
        width: 90%;
        z-index: 5; 
    }

    .products {
        width: 90%;
        margin: 50px auto;
        overflow: auto;
    }

    .container {
        min-height: 50vh;
        padding: 20px;
    }
    
    @media (max-width: 768px) {
        .indeximg {
            content: url('/img/index-mobile.png');
            width: 100%;
            height: auto;
        }

        .category-container {
            display: none;
        }

        .products {
            width: 100%;
            margin-top: -150px;
            gap: 10px;
        }

        .card {
            max-width: 180px;
        }
    }
</style>

<div class="image-container">
    <img class="indeximg" src="/img/index.webp" alt="index">

    <div class="category-container">
        @foreach ($categories as $category)
        @if ($category->id != 14)
        <a href="{{ route('catalog', $category->id) }}" class="category-item">
            <img src="{{ asset($category->photo_url) }}" loading="lazy" alt="{{ $category->title }}">
            <span>{{ $category->title }}</span>
        </a>
        @endif
        @endforeach
    </div>
</div>

<div class="products">
    @foreach ($products->take(8) as $product)
    @if ($product->photos->isNotEmpty())
    <a href="{{ route('product', $product->id) }}">
        <div class="card">
            <img src="{{ asset($product->photos->first()->photo_url) }}" loading="lazy" alt="продукт">
            <p>{{ $product->title }}</p>
            <p>{{ $product->price }} ₽</p>
        </div>
    </a>
    @endif
    @endforeach
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const header = document.querySelector('header');

        window.addEventListener('scroll', function() {
            if (window.scrollY > 20) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    });
</script>
<x-footer></x-footer>