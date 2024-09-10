<x-layout></x-layout>
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
        width: 70%;
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
        /* 4 колонки по умолчанию */
        gap: 20px;
        /* Пробелы между карточками */
        margin-top: 50px;
    }

    /* Стили для карточки товара */
    .card {
        padding: 10px;
        box-sizing: border-box;
        /* Учитываем padding в ширину */
    }

    .card img {
        margin-bottom: 10px;
        width: 100%;
    }

    .card p {
        font-size: 12px;
    }

    /* Адаптивность для мобильных устройств */
    @media (max-width: 768px) {
        .products {
            grid-template-columns: repeat(2, 1fr);
            /* 2 колонки на экранах до 768px */
        }
    }
</style>


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