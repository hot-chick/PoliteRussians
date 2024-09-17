<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&display=swap">
    <link rel="shortcut icon" href="/img/favicon.png" type="image/x-icon">
    <link rel="icon" href="/img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="/css/style.css">
    <title>PoliteRussians</title>

</head>

<body>
    <header>
        <div class="header_wrapper">
            <div class="menu-toggle" id="mobile-menu-toggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <a href="/" class="logo"><img src="/img/LOGOW.png" alt=""></a>
            <nav>
                <ul class="menu">
                    <li class="dropdown">
                        <span class="dropdown_catalog">Каталог</span>
                        <div class="dropdown-content">
                            <ul>
                                <li><a href="/catalog">Смотреть все</a></li>
                                @foreach ($categories as $category)
                                <li><a href="{{ route('catalog', $category->id) }}">{{ $category->title }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                    <li><a href="/shops">Магазины</a></li>
                </ul>
            </nav>
            <div class="user_menu">
                <div class="search">
                    <img src="/img/search_white.png" alt="Поиск">
                    <p>Поиск</p>
                </div>

                <a href="/wishlist">
                    <img src="/img/heart.png" alt="Список желаемого">
                    <span class="wishlist-count">{{ count(session()->get('wishlist', [])) }}</span>
                </a>

                <a href="/cart">
                    <img src="/img/paper_bag.png" alt="Корзина">
                    <span class="cart-count">{{ count(session()->get('cart', [])) }}</span>
                </a>
            </div>
        </div>
        <nav class="mobile-menu" id="mobile-menu">
            <ul>
                <li><a href="/catalog">Смотреть все</a></li>
                @foreach ($categories as $category)
                <li><a href="{{ route('catalog', $category->id) }}">{{ $category->title }}</a></li>
                @endforeach
                <li><a href="/shops">Магазины</a></li>
                <li><a href="/wishlist">Избранное</a></li>
                <li><a href="/cart">Корзина</a></li>
            </ul>
        </nav>
    </header>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('mobile-menu-toggle');
            const mobileMenu = document.getElementById('mobile-menu');

            // Открытие/закрытие мобильного меню
            menuToggle.addEventListener('click', function() {
                menuToggle.classList.toggle('open');
                mobileMenu.classList.toggle('open');
            });

            // Закрытие меню при клике за пределами
            document.addEventListener('click', function(e) {
                if (!menuToggle.contains(e.target) && !mobileMenu.contains(e.target)) {
                    mobileMenu.classList.remove('open');
                    menuToggle.classList.remove('open');
                }
            });
        });
    </script>