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

    .logo {
        position: absolute;
        left: 47%;
        transform: translateX(-50%);
    }

    .logo img {
        width: 150%;
        height: 150%;
    }

    .product-page {
        display: flex;
        max-width: 1200px;
        width: 100%;
        gap: 100px;
        padding: 20px;
        box-sizing: border-box;
        margin: 0 auto;
    }

    /* Стили для изображений продукта */
    .product-images {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .main-image img {
        width: 100%;
        object-fit: cover;
        margin-bottom: 20px;
    }

    .thumbnail-images {
        display: flex;
        gap: 10px;
    }

    .thumbnail-images img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        cursor: pointer;
        border: 1px solid transparent;
    }

    .thumbnail-images img.active {
        border: 1px solid black;
    }

    /* Стили для информации о продукте */
    .product-info {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .price {
        font-size: 24px;
        color: #000;
        white-space: nowrap;
    }

    .product-description {
        margin-top: 20px;
        margin-bottom: 20px;
    }

    .add-to-cart {
        padding: 15px;
        background-color: #333;
        color: white;
        border: none;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }

    .add-to-cart:hover {
        background-color: black;
    }

    /* Адаптивность для мобильных устройств */
    @media (max-width: 768px) {
        .product-page {
            flex-direction: column;
            align-items: center;
        }
    }

    .product-name-title {
        display: flex;
        justify-content: space-between;
        align-items: top;
    }

    .product-name-title h1 {
        font-size: 24px;
        font-weight: normal;
    }

    /* Стили для обертки select */
    .custom-select-wrapper {
        position: relative;
        display: inline-block;
        margin-bottom: 20px;
    }

    /* Скрыть стандартный select */
    .custom-select {
        display: none;
    }

    /* Стили для кастомного селекта */
    .custom-select-trigger {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px;
        background-color: #fff;
        border: 1px solid #ddd;
        cursor: pointer;
        font-size: 14px;
        color: #333;
        position: relative;
        width: 100%;
        box-sizing: border-box;
        z-index: 2;
    }

    /* Стили для выпадающего списка */
    .custom-options {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background-color: #fff;
        border: 1px solid #ddd;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        z-index: 3;
        display: flex;
        flex-direction: column;
        max-height: 0;
        /* Изначально высота равна 0 */
        opacity: 1;
        /* Прозрачность 1 (сделано для соответствия другим элементам) */
        overflow: hidden;
        /* Скрытие переполнения */
        transition: max-height 0.3s ease;
        /* Плавное изменение высоты */
    }

    /* Показать выпадающий список */
    .custom-options.open {
        max-height: 200px;
        /* Максимальная высота */
    }

    .custom-options .custom-option {
        padding: 10px;
        cursor: pointer;
    }

    .custom-option.selected {
        background-color: #ddd;
    }

    /* Стили для кнопки */
    .add-to-cart {
        /* margin-top: 20px; */
        /* Отступ сверху, чтобы не перекрывать выпадающий список */
        position: relative;
        z-index: 1;
        width: 100%;
    }

    .product-buttons {
        /* position: relative; */
        display: flex;
        gap: 20px;
        justify-content: space-between;
    }

    

    .heart-container {
        position: relative;
        max-width: 42px;
        max-height: 42px;
        /* overflow: hidden; */
    }

    .heart {
        position: static;
        cursor: pointer;
        height: 100%;
        width: 100%;
        object-fit: cover;
        transition: opacity 0.3s ease-in-out;
    }

    .heart-black {
        opacity: 1;
    }

    .heart-red {
        position: absolute;
        opacity: 0;
    }

    .heart-container.active .heart-black {
        opacity: 0;
    }

    .heart-container.active .heart-red {
        opacity: 1;
    }

    .accordion {
        margin-top: 20px;
        border-bottom: 1px solid #ddd;
    }

    .accordion-item {
        border-bottom: 1px solid #ddd;
    }

    .accordion-header {
        padding: 15px;
        font-size: 16px;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .accordion-content {
        max-height: 0;
        overflow: hidden;
        padding: 0 15px;
        /* Горизонтальный padding */
        font-size: 14px;
        transition: max-height 0.3s ease, padding 0.3s ease;
        /* Плавное изменение высоты и padding */
    }

    .accordion-header::after {
        content: '\002B';
        font-size: 20px;
    }

    .accordion-header.active::after {
        content: '\2212';
    }
</style>
<div class="product-page">
    <!-- Левая колонка: изображения продукта -->
    <div class="product-images">
        <div class="main-image">
            <img src="/img/product.png" alt="Основное изображение продукта">
        </div>
        <div class="thumbnail-images">
            <img src="/img/product.png" alt="Миниатюра 1">
            <img src="/img/category2.png" alt="Миниатюра 2">
            <img src="/img/category2.png" alt="Миниатюра 3">
        </div>
    </div>

    <!-- Правая колонка: информация о продукте -->
    <div class="product-info">
        <div class="product-name-title">
            <h1>Костюмная юбка миди бордового цвета</h1>
            <p class="price">12 980 Р</p>
        </div>

        <div class="product-description">
            <p>Элегантная юбка миди бордового цвета, выполненная из высококачественной костюмной ткани.
                Подходит для деловых встреч и повседневной носки.</p>
        </div>

        <div class="custom-select-wrapper">
            <div class="custom-select-trigger">Выберите размер</div>
            <div class="custom-options">
                <span class="custom-option" data-value="XS">XS</span>
                <span class="custom-option" data-value="S">S</span>
                <span class="custom-option" data-value="M">M</span>
                <span class="custom-option" data-value="L">L</span>
                <span class="custom-option" data-value="XL">XL</span>
                <span class="custom-option" data-value="S/M">S/M</span>
                <span class="custom-option" data-value="M/L">M/L</span>
                <span class="custom-option" data-value="L/XL">L/XL</span>
            </div>
            <select id="product-size" class="custom-select">
                <option value="XS">XS</option>
                <option value="S">S</option>
                <option value="M">M</option>
                <option value="L">L</option>
                <option value="XL">XL</option>
                <option value="S/M">S/M</option>
                <option value="M/L">M/L</option>
                <option value="L/XL">L/XL</option>
            </select>
        </div>

        <div class="product-buttons">
            <button class="add-to-cart">Добавить в корзину</button>
            <div class="heart-container">
                <img class="heart heart-black" src="/img/heart_black.png" alt="heart">
                <img class="heart heart-red" src="/img/filled_heart_red.png" alt="heart">
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-item">
                <div class="accordion-header">Описание</div>
                <div class="accordion-content">
                    <p>Это описание продукта...</p>
                </div>
            </div>
            <div class="accordion-item">
                <div class="accordion-header">Размер и посадка</div>
                <div class="accordion-content">
                    <p>Информация о размере и посадке...</p>
                </div>
            </div>
            <div class="accordion-item">
                <div class="accordion-header">Материалы и уход</div>
                <div class="accordion-content">
                    <p>Информация о материалах и уходе...</p>
                </div>
            </div>
            <!-- Добавьте дополнительные секции аккордеона, если нужно -->
        </div>
    </div>
</div>
</body>
<script>
    const thumbnails = document.querySelectorAll('.thumbnail-images img');
    const mainImage = document.querySelector('.main-image img');

    thumbnails.forEach(thumbnail => {
        thumbnail.addEventListener('click', () => {
            // Меняем основное изображение
            mainImage.src = thumbnail.src;

            // Удаляем класс "active" у всех миниатюр
            thumbnails.forEach(img => img.classList.remove('active'));

            // Добавляем класс "active" к нажатой миниатюре
            thumbnail.classList.add('active');
        });
    });
    document.addEventListener('DOMContentLoaded', function() {
        const selectWrapper = document.querySelector('.custom-select-wrapper');
        const trigger = selectWrapper.querySelector('.custom-select-trigger');
        const options = selectWrapper.querySelectorAll('.custom-option');
        const hiddenSelect = selectWrapper.querySelector('.custom-select');

        trigger.addEventListener('click', function() {
            const optionsList = selectWrapper.querySelector('.custom-options');
            optionsList.classList.toggle('open');
        });

        options.forEach(option => {
            option.addEventListener('click', function() {
                trigger.textContent = this.textContent;
                hiddenSelect.value = this.getAttribute('data-value');

                options.forEach(opt => opt.classList.remove('selected'));
                this.classList.add('selected');

                selectWrapper.querySelector('.custom-options').classList.remove('open');
            });
        });

        document.addEventListener('click', function(e) {
            if (!selectWrapper.contains(e.target)) {
                selectWrapper.querySelector('.custom-options').classList.remove('open');
            }
        });
    });

    document.querySelector('.heart-container').addEventListener('click', function() {
        this.classList.toggle('active');
    });

    const accordionHeaders = document.querySelectorAll('.accordion-header');
    accordionHeaders.forEach(header => {
        header.addEventListener('click', () => {
            const currentlyActiveHeader = document.querySelector('.accordion-header.active');
            if (currentlyActiveHeader && currentlyActiveHeader !== header) {
                currentlyActiveHeader.classList.toggle('active');
                const activeContent = currentlyActiveHeader.nextElementSibling;
                activeContent.style.maxHeight = 0; // Сворачиваем другой активный аккордеон
                activeContent.style.paddingTop = 0; // Устанавливаем padding сверху в 0
                activeContent.style.paddingBottom = 0; // Устанавливаем padding снизу в 0
            }

            header.classList.toggle('active');
            const accordionContent = header.nextElementSibling;

            if (header.classList.contains('active')) {
                accordionContent.style.maxHeight = accordionContent.scrollHeight + 'px'; // Устанавливаем высоту контента
                accordionContent.style.paddingTop = '15px'; // Добавляем padding сверху при открытии
                accordionContent.style.paddingBottom = '15px'; // Добавляем padding снизу при открытии
            } else {
                accordionContent.style.maxHeight = 0; // Сворачиваем контент
                accordionContent.style.paddingTop = 0; // Устанавливаем padding сверху в 0
                accordionContent.style.paddingBottom = 0; // Устанавливаем padding снизу в 0
            }
        });
    });
</script>

</html>