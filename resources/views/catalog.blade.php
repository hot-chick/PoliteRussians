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
        background-color: rgb(219, 219, 219);
        border-bottom: 1px solid rgb(231, 231, 231);
        color: black;
    }

    .dropdown-content {
        background-color: rgb(219, 219, 219);
    }

    @media (max-width: 768px) {
        header {
            background-color: rgb(219, 219, 219);
            height: 80px;
        }

        .filter {
            margin-right: 60%;
        }

        .filter_sort {
            width: 20%;
            gap: 20px;
        }
    }

    /* Общий стиль для контейнера сортировки */
    
</style>
<div class="container">
    <div class="filter">
        <div class="filter_sort">
            <form method="GET" action="{{ route('products.index') }}" class="sort-form">
                <div class="sort">
                    <p>Сортировка</p>
                    <select name="sort" onchange="this.form.submit()" class="customm-select">
                        <option value="asc" {{ request('sort') === 'asc' ? 'selected' : '' }}>По возрастанию</option>
                        <option value="desc" {{ request('sort') === 'desc' ? 'selected' : '' }}>По убыванию</option>
                    </select>
                </div>
            </form>
        </div>
    </div>


    <div class="products">
        @foreach($products as $product)
        <!-- Проверяем, есть ли у продукта хотя бы одна фотография -->
        @if($product->photos->isNotEmpty())
        <a href="{{ route('product', $product->id) }}">
            <div class="card">
                <!-- Выводим первую фотографию продукта -->
                <img src="{{ asset($product->photos->first()->photo_url) }}" alt="Продукт">
                <p>{{ $product->title }}</p>
                <p>{{ $product->price }} Р</p>
            </div>
        </a>
        @endif
        @endforeach
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