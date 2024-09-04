<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/style.css">
    <title>PoliteRussians</title>
</head>
<style>
    header {
        position: sticky;
        top: 0;
        transition: background-color 0.4s, color 0.4s;
        background-color: white;
        color: black;
        z-index: 1000;
        border-bottom: 1px solid rgb(231, 231, 231);
    }

    .header_wrapper {
        display: flex;
        align-items: center;
        padding: 24px;
        margin: 0 auto;
        justify-content: space-between;
        width: 68%;
    }

    header:hover * {
        color: black;
    }

    header:hover {
        background-color: white;
        color: black;
    }

    header img {
        filter: invert(1);
    }

    header.scrolled {
        background-color: white;
        color: black;
    }

    header.scrolled * {
        color: black;
    }

    header.scrolled img {
        filter: invert(1);
    }

    ul {
        text-decoration: none;
    }

    li {
        list-style-type: none;
    }

    header ul {
        display: flex;
        gap: 24px;
        list-style: none;
        align-items: center;
    }

    ul a {
        color: black;
        position: relative;
        padding-bottom: 5px;
    }

    ul a::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 0;
        height: 1px;
        background-color: black;
        transition: width 0.3s ease;
    }

    ul a:hover::after {
        width: 100%;
    }

    header img {
        max-width: 125px;
        height: 30px;
    }

    .user_menu img {
        max-width: 30px;
    }

    .user_menu {
        display: flex;
        gap: 24px;
        align-items: center;
        color: black;
    }

    .search {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .container {
        width: 68%;
        margin: 30px auto;
    }

    .filter {
        display: flex;
        justify-content: space-between;
    }

    .filter p {
        font-size: 16px;
    }

    .filter span {
        color: rgb(56, 56, 56);
        font-size: 24px;
    }

    .filter_sort {
        display: flex;
        width: 25%;
        justify-content: space-between;
    }

    .filter img {
        filter: invert(1);
        max-width: 25px;
    }

    .sort {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    /* Контейнер для всех карточек товаров */
    .products {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        /* 4 колонки в ряд по умолчанию */
        gap: 20px;
        /* Пробелы между карточками */
        margin-top: 100px;
    }

    /* Стили для карточки товара */
    .card {
        padding: 10px;
    }

    .card img {
        margin-bottom: 10px;
        width: 100%;
        display: block;
    }

    .card p {
        font-size: 12px;
    }

    /* Эффект при наведении на карточку */


    /* Адаптивность для мобильных устройств */
    @media (max-width: 768px) {
        .container {
            width: 100%;
            margin: 30px auto;
        }

        .products {
            grid-template-columns: repeat(2, 1fr);
            /* 2 колонки в ряд на экранах до 768px */
            width: 100%;
        }
    }

    .card_count {
        margin: 20px 0;
        text-align: center;
        width: 100%;
        padding: 0 10px;
        box-sizing: border-box;
    }

    /* Стили для самого ползунка */
    input[type="range"] {
        -webkit-appearance: none;
        width: 100%;
        height: 2px;
        background: linear-gradient(to right, black 50%, #ddd 50%);
        outline: none;
        transition: background 0.3s ease-in-out;
        cursor: pointer;
    }

    input[type="range"]::-webkit-slider-runnable-track {
        width: 100%;
        height: 8px;
        background: transparent;
        border: none;
        border-radius: 5px;
    }

    input[type="range"]::-webkit-slider-thumb {
        -webkit-appearance: none;
        width: 16px;
        height: 16px;
        background: black;
        cursor: pointer;
        border-radius: 50%;
        position: relative;
        top: -4px;
    }

    input[type="range"]::-moz-range-thumb {
        width: 16px;
        height: 16px;
        background: black;
        cursor: pointer;
        border-radius: 50%;
    }

    input[type="range"]::-moz-range-track {
        background: #ddd;
    }

    input[type="range"]::-moz-range-progress {
        background-color: black;
    }

    /* Цвет перетащенной части ползунка для IE */
    input[type="range"]::-ms-fill-lower {
        background-color: black;
        height: 8px;
    }
</style>

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
    <div class="container">
        <div class="filter">
            <span>Все товары (102 изделия)</span>
            <div class="filter_sort">
                <div class="sort">
                    <img src="/img/arrow_down.png" alt="">
                    <p>Сортировка</p>
                </div>

                <div class="sort">
                    <img src="/img/filter.png" alt="">
                    <p>Фильтры</p>
                </div>
            </div>
        </div>
        <div class="card_count">
            <input type="range" id="productSlider" min="2" max="6" step="2" value="4">
        </div>
        <div class="products">
            <div class="card">
                <img src="/img/product.png" alt="продукт">
                <p>Платье миди шоколадного цвета</p>
                <p>12 980 Р</p>
            </div>
            <div class="card">
                <img src="/img/product.png" alt="продукт">
                <p>Платье миди шоколадного цвета</p>
                <p>12 980 Р</p>
            </div>
            <div class="card">
                <img src="/img/product.png" alt="продукт">
                <p>Платье миди шоколадного цвета</p>
                <p>12 980 Р</p>
            </div>
            <div class="card">
                <img src="/img/product.png" alt="продукт">
                <p>Платье миди шоколадного цвета</p>
                <p>12 980 Р</p>
            </div>
            <div class="card">
                <img src="/img/product.png" alt="продукт">
                <p>Платье миди шоколадного цвета</p>
                <p>12 980 Р</p>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const slider = document.getElementById('productSlider');

            // Обновление цвета заливки ползунка
            function updateSliderFill(value) {
                const min = slider.min;
                const max = slider.max;
                const percent = ((value - min) / (max - min)) * 100;
                slider.style.background = `linear-gradient(to right, black ${percent}%, #ddd ${percent}%)`;
            }

            // Функция для обновления отображаемого количества товаров
            function updateProductsDisplay(count) {
                const cards = document.querySelectorAll('.card');

                // Скрываем все карточки
                cards.forEach((card, index) => {
                    card.style.display = (index < count) ? 'block' : 'none';
                });
            }

            // Слушатель для изменения значения ползунка
            slider.addEventListener('input', function() {
                const selectedValue = parseInt(this.value);
                updateProductsDisplay(selectedValue);
                updateSliderFill(this.value);
            });

            // Устанавливаем начальное количество отображаемых товаров и цвета заливки
            updateProductsDisplay(parseInt(slider.value));
            updateSliderFill(slider.value);
        });
    </script>
</body>

</html>