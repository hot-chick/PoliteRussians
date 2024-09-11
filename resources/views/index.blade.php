<x-layout></x-layout>
<style>
    .container {
        height: 59vh;
        padding: 20px;
        width: 85%;
        margin: 30px auto;
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
<div class="about">
    <h1>Вежливые русские</h1>
</div>
<div class="products">
    <a href="/product">
        <div class="card">
            <img src="/img/product.png" alt="продукт">
            <p>Платье миди шоколадного цвета</p>
            <p>12 980 Р</p>
        </div>
    </a>
    <a href="/product">
        <div class="card">
            <img src="/img/product.png" alt="продукт">
            <p>Платье миди шоколадного цвета</p>
            <p>12 980 Р</p>
        </div>
    </a>
    <a href="/product">
        <div class="card">
            <img src="/img/product.png" alt="продукт">
            <p>Платье миди шоколадного цвета</p>
            <p>12 980 Р</p>
        </div>
    </a>
    <a href="/product">
        <div class="card">
            <img src="/img/product.png" alt="продукт">
            <p>Платье миди шоколадного цвета</p>
            <p>12 980 Р</p>
        </div>
    </a>
    <a href="/product">
        <div class="card">
            <img src="/img/product.png" alt="продукт">
            <p>Платье миди шоколадного цвета</p>
            <p>12 980 Р</p>
        </div>
    </a>
    <a href="/product">
        <div class="card">
            <img src="/img/product.png" alt="продукт">
            <p>Платье миди шоколадного цвета</p>
            <p>12 980 Р</p>
        </div>
    </a>
    <a href="/product">
        <div class="card">
            <img src="/img/product.png" alt="продукт">
            <p>Платье миди шоколадного цвета</p>
            <p>12 980 Р</p>
        </div>
    </a>
    <a href="/product">
        <div class="card">
            <img src="/img/product.png" alt="продукт">
            <p>Платье миди шоколадного цвета</p>
            <p>12 980 Р</p>
        </div>
    </a>
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