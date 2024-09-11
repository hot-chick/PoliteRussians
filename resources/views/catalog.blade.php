<x-layout></x-layout>
<style>
    header {
        background-color: #fff;
        border-bottom: 1px solid rgb(231, 231, 231);
        color: black;
    }

    header a {
        color: black;
    }

    .logo img {
        filter: invert(1);
    }

    .user_menu img {
        filter: invert(1);
    }

    p {
        color: black
    }

    header:hover {
        background-color: rgb(231, 231, 231);
        border-bottom: 1px solid rgb(231, 231, 231);
        color: black;
    }

    .dropdown-content {
        background-color: rgb(231, 231, 231);
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
<x-footer></x-footer>