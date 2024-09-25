<x-Layout></x-Layout>
<style>
    .container {
        height: 59vh;
        padding: 20px;
        width: 85%;
        margin: 30px auto;
    }

    @media (max-width: 768px) {
        header {
            height: 80px;
        }

        .category {
            display: none;
        }

        .pulse {
            margin-top: -50px;
        }
    }
</style>
<img class="indeximg" src="/img/index.jpg" alt="index">
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
<div class="pulse">
    <h1 class="STAR">STAR FIGHTING PROMOTION 4</h1>
    <h1 class="MMA"> ПРОФЕССИОНАЛЬНЫЙ ТУРНИР ПО ПРАВИЛАМ ММА</h1>
    <h1 class="Batyr">
        <<СИЛА БАТЫРА>>
    </h1>
    <h1 class="START">27 СЕНТЯБРЯ. ТИНЬКОФФ ХОЛЛ START: 19:00</h1>
</div>
<div class="products">
    @foreach ($products as $product)
    @if ($product->photos->isNotEmpty())
    <a href="{{ route('product', $product->id) }}">
        <div class="card">
            <img src="{{ asset($product->photos->first()->photo_url) }}" loading="lazy" alt="продукт">
            <p>{{ $product->title }}</p>
            <p>{{ $product->price }} Р</p>
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