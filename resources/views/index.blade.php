<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/style.css">
    <title>PoliteRussians</title>
</head>

<body>
    <header>
        <div class="header_wrapper">
            <nav>
                <ul>
                    <li><a href="/catalog">Каталог</a></li>
                    <li><a href="/">Коллекции</a></li>
                    <li><a href="/">Новинки</a></li>
                    <li><a href="/">Lookbook</a></li>
                    <li><a href="/">Магазины</a></li>
                </ul>
            </nav>
            <a href="/" class="logo"><img src="./img/logo_black.png" alt=""></a>
            <div class="user_menu">
                <div class="search">
                    <img src="/img/search_white.png" alt="Поиск">
                    <p>Поиск</p>
                </div>
                <a href="/"><img src="/img/heart.png" alt="Список желаемого"></a>
                <a href="/"><img src="/img/paper_bag.png" alt="Bag"></a>
            </div>
        </div>
    </header>

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