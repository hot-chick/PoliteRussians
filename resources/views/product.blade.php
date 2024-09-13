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
        background-color: rgb(219, 219, 219);
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
            @if ($product->photos->isNotEmpty())
                <!-- Выводим первое изображение продукта -->
                <img src="{{ asset($product->photos->first()->photo_url) }}" alt="Основное изображение продукта">
            @else
                <!-- Если изображений нет, используем изображение по умолчанию -->
                <img src="/img/product.png" alt="Основное изображение продукта">
            @endif
        </div>
        <div class="thumbnail-images">
            <!-- Цикл для отображения всех миниатюр продукта -->
            @foreach ($product->photos as $photo)
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
                @foreach ($product->sizes as $size)
                    <span class="custom-option" data-value="{{ $size->title }}">{{ $size->title }}</span>
                @endforeach
            </div>
            <select id="product-size" class="custom-select">
                @foreach ($product->sizes as $size)
                    <option value="{{ $size->title }}">{{ $size->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="product-buttons">
            <!-- Кнопка добавления в корзину -->
            <button class="add-to-cart" data-product-id="{{ $product->id }}">Добавить в корзину</button>
            <div class="heart-container">
                <div class="heart-box" data-product-id="{{ $product->id }}"
                    class="{{ $isInWishlist ? 'clicked' : '' }}">
                    <img class="heart heart-black" src="/img/heart_black.png" alt="heart">
                    <img class="heart heart-red" src="/img/filled_heart_red.png" alt="heart">
                </div>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-item">
                <div class="accordion-header">Артикул</div>
                <div class="accordion-content">
                    <p>{{ $product->description }}</p>
                </div>
            </div>
            <div class="accordion-item">
                <div class="accordion-header">Обмеры</div>
                <div class="accordion-content">
                    <p>{{ $product->description }}</p>
                </div>
            </div>
            <div class="accordion-item">
                <div class="accordion-header">Состав</div>
                <div class="accordion-content">
                    {{-- <p>{{ $product->composition }}</p> --}}
                </div>
            </div>
            <div class="accordion-item">
                <div class="accordion-header">Уход за изделием</div>
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

    document.addEventListener('DOMContentLoaded', () => {
        const heartBoxes = document.querySelectorAll('.heart-box');

        heartBoxes.forEach(box => {
            const productId = box.dataset.productId;
            // Проверка состояния из сессии
            const isInWishlist =
                {{ json_encode(in_array($product->id, session()->get('wishlist', []))) }};

            if (isInWishlist) {
                box.classList.add('clicked');
            }

            box.addEventListener('click', () => {
                box.classList.toggle('clicked');

                fetch('/wishlist/toggle', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector(
                                'meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            productId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log('Product added to wishlist.');
                        } else {
                            console.error('Error adding product to wishlist.');
                        }
                    });
            });
        });
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

    document.addEventListener('DOMContentLoaded', () => {
        const addToCartButton = document.querySelector('.add-to-cart');

        addToCartButton.addEventListener('click', () => {
            const productId = addToCartButton.dataset.productId;
            const selectedSize = document.querySelector('#product-size').value;

            fetch('/cart/add', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                            .getAttribute('content')
                    },
                    body: JSON.stringify({
                        productId,
                        size: selectedSize
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log('Товар добавлен в корзину.');
                        window.location
                            .reload(); // Перезагрузка страницы после добавления в корзину
                    } else {
                        console.error('Ошибка при добавлении товара в корзину.');
                    }
                })
                .catch(error => console.error('Ошибка:', error));
        });
    });
</script>

<x-footer></x-footer>
