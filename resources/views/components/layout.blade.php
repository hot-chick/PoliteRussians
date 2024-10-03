<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&">

    <link rel="shortcut icon" href="/img/favicon.jpeg" type="image/x-icon">
    <link rel="icon" href="/img/favicon.jpeg" type="image/x-icon">
    <link rel="stylesheet" href="/css/style.css">
    <script src="https://api-maps.yandex.ru/2.1/?apikey=95d7b5bc-89bf-49b2-95ac-9e329e11ec37&lang=ru_RU"
        type="text/javascript"></script>
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
            <a href="/" class="logo"><img src="/img/LOGOW.png" alt="logo"></a>
            <div class="mobile_counts">
                <a href="/wishlist">
                    <img src="/img/heart.png" alt="Список желаемого">
                    <span class="wishlist-count">{{ count(session()->get('wishlist', [])) }}</span>
                </a>

                <a href="/checkout">
                    <img src="/img/paper_bag.png" alt="Корзина">
                    <span class="cart-count">{{ count(session()->get('cart', [])) }}</span>
                </a>
            </div>

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
                    <li><a href="/about_us">О нас</a></li>
                </ul>
            </nav>
            <div class="user_menu">
                <div class="search">
                    <img src="/img/search_white.png" alt="Поиск">
                    <input class="search-input" type="text" id="search" placeholder="Поиск...">
                    <div id="search-results" class="search-results"></div>
                </div>

                <a href="/wishlist">
                    <img src="/img/heart.png" alt="Список желаемого">
                    <span class="wishlist-count">{{ count(session()->get('wishlist', [])) }}</span>
                </a>

                <a href="/checkout">
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
            </ul>
        </nav>
    </header>
    @if (session('success'))
    <div class="alert alert-success">
        <span>{{ session('success') }}</span>
        <button class="close-alert">&times;</button>
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-error">
        <span>{{ session('error') }}</span>
        <button class="close-alert">&times;</button>
    </div>
    @endif
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search-input');
            const searchResults = document.getElementById('search-results');

            if (!searchInput || !searchResults) {
                console.error('Search input or results container not found.');
                return;
            }

            searchInput.addEventListener('input', function() {
                const query = searchInput.value;

                if (query.length > 2) {
                    console.log(`Отправка запроса: /search?query=${query}`);

                    fetch(`/search?query=${query}`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(`HTTP error! status: ${response.status}`);
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.length === 0) {
                                console.warn('No results found');
                            } else {
                                console.log('Полученные данные:', data);
                            }
                        })
                        .catch(error => {
                            console.error('Ошибка при выполнении поиска:', error);
                        });
                } else {
                    searchResults.innerHTML = '';
                    searchResults.style.display = 'none';
                }
            });
        });


        document.getElementById('search').addEventListener('input', function() {
            let query = this.value;

            if (query.length >= 2) {
                fetch(`/search?query=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(data => {
                        let resultsContainer = document.getElementById('search-results');
                        resultsContainer.innerHTML = '';

                        if (data.length > 0) {
                            data.forEach(product => {
                                let resultItem = document.createElement('div');
                                resultItem.textContent = `${product.title} (${product.article})`;
                                resultItem.addEventListener('click', () => {
                                    window.location.href = `/product/${product.id}`;
                                });
                                resultsContainer.appendChild(resultItem);
                            });
                            resultsContainer.style.display = 'block';
                        } else {
                            resultsContainer.innerHTML = '<div>Ничего не найдено</div>';
                            resultsContainer.style.display = 'block';
                        }
                    })
                    .catch(error => console.error('Ошибка при выполнении поиска:', error));
            } else {
                document.getElementById('search-results').innerHTML = '';
                document.getElementById('search-results').style.display = 'none';
            }
        });

        // Обработчик клика по документу для скрытия результатов при клике вне поиска
        document.addEventListener('click', function(e) {
            const searchField = document.getElementById('search');
            const resultsContainer = document.getElementById('search-results');

            // Если клик произошел вне поля поиска или результатов, скрываем список
            if (!searchField.contains(e.target) && !resultsContainer.contains(e.target)) {
                resultsContainer.innerHTML = ''; // Очищаем результаты
                resultsContainer.style.display = 'none'; // Скрываем контейнер
            }
        });


        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('mobile-menu-toggle');
            const mobileMenu = document.getElementById('mobile-menu');

            menuToggle.addEventListener('click', function() {
                menuToggle.classList.toggle('open');
                mobileMenu.classList.toggle('open');
            });

            document.addEventListener('click', function(e) {
                if (!menuToggle.contains(e.target) && !mobileMenu.contains(e.target)) {
                    mobileMenu.classList.remove('open');
                    menuToggle.classList.remove('open');
                }
            });
        });


        document.addEventListener('DOMContentLoaded', function() {
            const closeButtons = document.querySelectorAll('.close-alert');

            closeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    this.parentElement.style.display = 'none';
                });
            });
        });
    </script>