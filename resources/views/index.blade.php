<x-layout></x-layout>
<style>
    .container {
        height: 59vh;
        padding: 20px;
        width: 85%;
        margin: 30px auto;
    }

    @media (max-width: 768px) {
        header {
            background-color: rgb(219, 219, 219);
            height: 80px;
        }
    }
</style>
<video autoplay loop muted class="bgvideo" id="bgvideo">
    <source src="/video/index.mp4" type="video/mp4">
</video>
<div class="container">

</div>
<div class="content">
    <div class="category">
        
        <a href="/" class="category-item">
            <img src="/img/category2.png" alt="Категория">
            <span>Футболки</span>
        </a>
        <a href="/" class="category-item">
            <img src="/img/category2.png" alt="Категория">
            <span>Футболки</span>
        </a>
        <a href="/" class="category-item">
            <img src="/img/category2.png" alt="Категория">
            <span>Футболки</span>
        </a>
        <a href="/" class="category-item">
            <img src="/img/category2.png" alt="Категория">
            <span>Футболки</span>
        </a>
        <a href="/" class="category-item">
            <img src="/img/category2.png" alt="Категория">
            <span>Футболки</span>
        </a>
        <a href="/" class="category-item">
            <img src="/img/category2.png" alt="Категория">
            <span>Футболки</span>
        </a>
    </div>
</div>
<div class="pulse">
    <h1 class="STAR">STAR FIGHTING PROMOTION 4</h1><br>
    <h1 class="MMA"> ПРОФЕССИОНАЛЬНЫЙ ТУРНИР ПО ПРАВИЛАМ ММА</h1><br>
    <h1 class="Batyr">
        <<СИЛА БАТЫРА>>
    </h1><br>
    <h1 class="START">27 СЕНТЯБРЯ. ТИНЬКОФФ ХОЛЛ START: 19:00</h1>
</div>
<div class="products">
    @foreach ($products as $product)
    <!-- Проверка наличия хотя бы одной фотографии у продукта -->
    @if ($product->photos->isNotEmpty())
    <a href="{{ route('product', $product->id) }}">
        <div class="card">
            <img src="{{ asset($product->photos->first()->photo_url) }}" alt="продукт">
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
            if (window.scrollY > 50) { // Если прокрутка более чем на 50px
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    });
</script>
<x-footer></x-footer>