<x-Layout></x-Layout>
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

    @media (max-width: 768px) {
        header {
            background-color: rgb(231, 231, 231);
            height: 80px;
        }

        .product-page{
            width: 100%;
        }

        .thumbnail-images img{
            width: 50px;
            height: 50px;
        }
    }

    .wishlist-count {
        color: black;
    }

    .dropdown_catalog {
        cursor: pointer;
        color: black;
    }

    .cart-count {
        color: black;
    }
</style>
<div class="seolinks">
    <a class="seolinks0" href="/">Главная </a>/ <a class="seolinks1" href="/catalog"> Каталог</a>/ <a class="seolinks1" href=""> Товар</a>
</div>
<div class="product-page">
    <!-- Левая колонка: изображения продукта -->
    <div class="product-images">
        <div class="thumbnail-images">
            @foreach ($product->photos as $photo)
                <img src="{{ asset($photo->photo_url) }}" alt="Миниатюра {{ $loop->iteration }}">
            @endforeach
        </div>

        <div class="main-image">
            @if ($product->photos->isNotEmpty())
                <img src="{{ asset($product->photos->first()->photo_url) }}" alt="Основное изображение продукта">
            @else
                <img src="/img/product.png" alt="Основное изображение продукта">
            @endif
        </div>
    </div>

    <!-- Правая колонка: информация о продукте -->
    <div class="product-info">
        <div class="product-name-title">
            <!-- Отображение названия и цены продукта -->
            <h1>{{ $product->title }}</h1>
            <p class="price">{{ $product->price }} ₽</p>
        </div>

        <div class="product-description">
            <p>{{ $product->description }}
                
            </p>
        </div>

        <div class="custom-select-wrapper">
            <div class="custom-select-trigger">Выберите размер</div>
            <div class="custom-options">
                @foreach ($product->sizes as $size)
                <span class="custom-option" data-value="{{ $size->title }}">{{ $size->title }}</span>
                @endforeach
            </div>
            <select id="product-size" class="custom-select">
                <option value="" disabled selected>Выберите размер</option> <!-- Пустой вариант -->
                @foreach ($product->sizes as $size)
                    <option value="{{ $size->title }}">{{ $size->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="product-buttons">
            <!-- Кнопка добавления в корзину -->
            <button class="add-to-cart" data-product-id="{{ $product->id }}">Добавить в корзину</button>
            <div class="heart-container">
                <div class="heart-box" data-product-id="{{ $product->id }}" class="{{ $isInWishlist ? 'clicked' : '' }}">
                    <img class="heart heart-black" src="/img/heart_black.png" alt="heart">
                    <img class="heart heart-red" src="/img/filled_heart_red.png" alt="heart">
                </div>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-item">
                <div class="accordion-header">Артикул</div>
                <div class="accordion-content">
                    <p>{{ $product->article }}</p>
                </div>
            </div>
            <div class="accordion-item">
                <div class="accordion-header">Обмеры</div>
                <div class="accordion-content">

                </div>
            </div>
            <div class="accordion-item">
                <div class="accordion-header">Состав</div>
                <div class="accordion-content">
                    <p>{{ $product->composition }}</p>
                </div>
            </div>
            <div class="accordion-item">
                <div class="accordion-header">Уход за изделием</div>
                <div class="accordion-content">
                    <p>{{ $product->care }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .cross-sale{
        display: flex;
        flex-wrap: wrap;
        width: 85%;
        margin: 0 auto;
    }

    .carda{
        margin: 0 auto;
        max-width: 24%;
    }

    .cross-saleh1{
        font-weight: 500;
        text-align: center;
    }

    @media (max-width: 768px) {
    .carda {
        max-width: 49%;
    }
}
</style>
@if($crossSoleProducts->crossSoldProducts->isNotEmpty())
<h2 class="cross-saleh1">Вместе с этим берут</h2>



<div class="cross-sale">
    @foreach($crossSoleProducts->crossSoldProducts as $crossProduct)
    <a class="carda" href="{{ route('product', $crossProduct->id) }}">
        <div class="card">
            <img src="{{ asset($crossProduct->photos->first()->photo_url) }}" loading="lazy" alt="Продукт">
            <p>{{ $crossProduct->title }}</p>
            <p>{{ $crossProduct->price }} ₽</p>
        </div>
    </a>
    @endforeach
</div>

@endif
<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. Обработчик для миниатюр изображений
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

    // 2. Обработчик для выпадающего списка размеров
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

    // 3. Обработчик для wishlist
    const heartBoxes = document.querySelectorAll('.heart-box');

    heartBoxes.forEach(box => {
        const productId = box.dataset.productId;
        // Проверка состояния из сессии (PHP код нужно обернуть в Blade директиву)
        const isInWishlist = @json(in_array($product->id, session()->get('wishlist', [])));

        if (isInWishlist) {
            box.classList.add('clicked');
        }

        box.addEventListener('click', () => {
            box.classList.toggle('clicked');

            fetch('/wishlist/toggle', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        productId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.reload();
                    } else {
                        console.error('Error adding product to wishlist.');
                    }
                });
        });
    });

    // 4. Обработчик для аккордеона
    const accordionHeaders = document.querySelectorAll('.accordion-header');
    accordionHeaders.forEach(header => {
        header.addEventListener('click', () => {
            const currentlyActiveHeader = document.querySelector('.accordion-header.active');
            if (currentlyActiveHeader && currentlyActiveHeader !== header) {
                currentlyActiveHeader.classList.toggle('active');
                const activeContent = currentlyActiveHeader.nextElementSibling;
                activeContent.style.maxHeight = 0;
                activeContent.style.paddingTop = 0;
                activeContent.style.paddingBottom = 0;
            }

            header.classList.toggle('active');
            const accordionContent = header.nextElementSibling;

            if (header.classList.contains('active')) {
                accordionContent.style.maxHeight = accordionContent.scrollHeight + 'px';
                accordionContent.style.paddingTop = '15px';
                accordionContent.style.paddingBottom = '15px';
            } else {
                accordionContent.style.maxHeight = 0;
                accordionContent.style.paddingTop = 0;
                accordionContent.style.paddingBottom = 0;
            }
        });
    });

    // 5. Обработчик для добавления в корзину
    const addToCartButton = document.querySelector('.add-to-cart');
    const sizeSelect = document.querySelector('#product-size');

    addToCartButton.addEventListener('click', function() {
        const productId = addToCartButton.dataset.productId;
        const selectedSize = sizeSelect.value;

        // Проверка: Если значение размера пустое, показываем предупреждение
        if (!selectedSize) {
            alert('Пожалуйста, выберите размер перед добавлением в корзину.');
            return;
        }

        // Отправка данных на сервер
        fetch('/cart/add', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                productId: productId,
                size: selectedSize
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Товар добавлен в корзину.');
                window.location.reload();
            } else {
                console.error('Ошибка при добавлении товара в корзину:', data.message);
            }
        })
        .catch(error => console.error('Ошибка:', error));
    });
});


   
</script>

<x-footer></x-footer>