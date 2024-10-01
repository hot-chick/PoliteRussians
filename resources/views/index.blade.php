<x-Layout></x-Layout>
<style>
    .container {
        height: 65vh;
    }

    .products {
        width: 90%;
        margin: 50px auto;
    }

    .whitebox {
        height: 10vh;
    }

    @media (max-width: 768px) {
        header {
            height: 80px;
        }

        .category {
            display: none;
        }

        .products {
            width: 90%;
            margin-top: -50px;
        }

        .whitebox {
            height: 7vh;
        }
    }
</style>
<img class="indeximg" src="/img/index.webp" alt="index">
<div class="container">

</div>

<div class="content">
    <div class="category">
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

<div class="whitebox">

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