<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Alegreya:wght@100;400;700&display=swap">
    <link rel="stylesheet" href="/css/style.css">
    <title>PoliteRussians</title>

</head>

<body>
    <header>
        <div class="header_wrapper">
            <nav>
                <ul>
                    <li class="dropdown">
                        <a class="dropdown_catalog" href="/catalog">Каталог</a>
                        <div class="dropdown-content">
                            <ul>
                                @foreach ($categories as $category)
                                    <li><a href="{{ route('catalog', $category->id) }}">{{ $category->title }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                    <!-- <li><a href="/">Новинки</a></li> -->
                    <li><a href="/shops">Магазины</a></li>
                </ul>
            </nav>
            <a href="/" class="logo"><img src="/img/LOGOW.png" alt=""></a>
            <div class="user_menu">
                <div class="search">
                    <img src="/img/search_white.png" alt="Поиск">
                    <p>Поиск</p>
                </div>
                <a href="/wishlist"><img src="/img/heart.png" alt="Список желаемого"></a>
                <a href="/cart"><img src="/img/paper_bag.png" alt="Корзина"></a>
            </div>
        </div>
    </header>
