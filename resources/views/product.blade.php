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
<div class="product-page">
    <!-- Левая колонка: изображения продукта -->
    <div class="product-images">
        <div class="main-image">
            <!-- Проверка наличия изображений продукта -->
            @if($product->photos->isNotEmpty())
            <!-- Выводим первое изображение продукта -->
            <img src="{{ asset($product->photos->first()->photo_url) }}" alt="Основное изображение продукта">
            @else
            <!-- Если изображений нет, используем изображение по умолчанию -->
            <img src="/img/product.png" alt="Основное изображение продукта">
            @endif
        </div>
        <div class="thumbnail-images">
            <!-- Цикл для отображения всех миниатюр продукта -->
            @foreach($product->photos as $photo)
            <img src="{{ asset($photo->photo_url) }}" alt="Миниатюра {{ $loop->iteration }}">
            @endforeach
        </div>
    </div>

    <!-- Правая колонка: информация о продукте -->
    <div class="product-info">
        <div class="product-name-title">
            <!-- Отображение названия и цены продукта -->
            <h1>{{ $product->title }}</h1>
            <p class="price">{{ $product->price }} Р</p>
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
        </div>
    </div>
</div>

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
                accordionContent.style.maxHeight = accordionContent.scrollHeight +
                    'px'; // Устанавливаем высоту контента
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

<x-footer></x-footer>