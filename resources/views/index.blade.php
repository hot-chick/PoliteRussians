<x-layout></x-layout>

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
</body>
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

</html>