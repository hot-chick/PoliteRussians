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
    }

    input {
        opacity: 0.7;
    }

    input:hover {
        opacity: 1;
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
<div class="checkout">
    <h1>Оформление заказа</h1>

    <form id="checkout-form" action="{{ route('checkout.process') }}" method="POST">
        @csrf

        <!-- Личные данные -->
        <div class="form-section">
            <h2>Ваши данные</h2>
            <div class="first">
                <div class="form-group">
                    <input type="text" id="name" name="name" placeholder="Имя" required>
                </div>
                <div class="form-group">
                    <input type="text" id="lastname" name="lastname" placeholder="Фамилию" required>
                </div>
            </div>
            <div class="second">
                <div class="form-group">
                    <input type="email" id="email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <input type="text" id="phone" name="phone" placeholder="Телефон" required>
                </div>
            </div>

        </div>

        <!-- Способ доставки -->
        <div class="form-section">
            <h2>Способ доставки</h2>
            <div class="delivery-options">
                <label>
                    <input type="radio" name="delivery" value="courier" onclick="toggleDeliveryMethod('courier')">
                    Доставка курьером
                </label>
                <label>
                    <input type="radio" name="delivery" value="pickup" onclick="toggleDeliveryMethod('pickup')">
                    Самовывоз
                </label>
            </div>
        </div>
        <div class="form-group" id="address-container" style="display: none; margin-bottom: 20px;">
            <input type="text" id="address" name="address" placeholder="Адрес доставки" required>
        </div>
        <div id="map-container" style="display: none; margin-bottom: 20px;">
            <div id="map" style="width: 100%; height: 400px"></div>
            <div id="selected-point"></div>
        </div>
        <!-- Способ оплаты -->
        <div class="form-section">
            <h2>Способ оплаты</h2>
            <div class="payment-options">
                <label>
                    <input type="radio" name="payment" value="cash" checked>
                    При получении
                </label>
                <label>
                    <input disabled type="radio" name="payment" value="card">
                    Оплата онлайн
                </label>
                <label>
                    <input disabled type="radio" name="payment" value="installments">
                    Оплата "Долями"
                </label>
            </div>
        </div>

        <input type="hidden" id="selected-point-id" name="pickup_point" value="">

        <!-- Сводка заказа -->
        <div class="order-summary">
            <h2>Ваш заказ</h2>
            <div class="products-grid">
                @php
                $totalPrice = 0;
                @endphp

                @foreach (session('cart', []) as $item)
                @php
                $product = \App\Models\Product::find($item['product_id']);
                @endphp

                @if ($product && $product->photos->isNotEmpty())
                <div class="card">
                    <a href="{{ route('product', $product->id) }}">
                        <img src="{{ asset($product->photos->first()->photo_url) }}" alt="{{ $product->title }}">
                    </a>
                    <p>{{ $product->title }}</p>
                    <p>{{ $product->price }} ₽</p>
                    <p>Размер: {{ $item['size'] }}</p>

                    @php
                    $totalPrice += $product->price;
                    @endphp
                </div>
                @endif
                @endforeach
            </div>

            <div class="cart-summary">
                <p>Итого к оплате: <strong id="total-price">{{ $totalPrice }} ₽</strong></p>
                <input type="text" id="promo-code" placeholder="Введите промокод">
                <button class="btn btn-primary" id="apply-promo">Применить промокод</button>
                <p id="discount-message"></p> <!-- Сообщения об ошибке или успехе -->
            </div>

        </div>

        <!-- Кнопка отправки формы -->
        <button type="submit" class="btn btn-primary">Оформить заказ</button>
    </form>
</div>

<script type="text/javascript">
    ymaps.ready(init);

    function init() {
        var myMap = new ymaps.Map("map", {
            center: [54.74, 55.96], // Центр карты (Уфа)
            zoom: 9
        });

        // Асинхронная загрузка данных о пунктах выдачи
        fetch('{{ route('get.delivery.points') }}')
            .then(response => response.json())
            .then(points => {
                points.forEach(point => {
                    if (point.latitude && point.longitude) {
                        var placemark = new ymaps.Placemark([point.latitude, point.longitude], {
                            balloonContent: `<div>${point.name}</div><button class="choose-point-btn" onclick="choosePickupPoint('${point.name}', this)">Выбрать пункт</button>` // Кнопка "Выбрать пункт"
                        });
                        myMap.geoObjects.add(placemark);
                    }
                });
            })
            .catch(error => {
                console.error('Ошибка при загрузке пунктов выдачи:', error);
            });
    }

    function choosePickupPoint(pointName, button) {
        const buttons = document.querySelectorAll('.choose-point-btn');
        buttons.forEach(btn => btn.style.backgroundColor = ''); // Сбрасываем цвет для всех кнопок
        button.style.backgroundColor = 'chartreuse'; // Делаем выбранную кнопку зеленой
        document.getElementById('selected-point').innerText = `Выбран пункт: ${pointName}`;
        document.getElementById('selected-point-id').value = pointName; // Сохраняем имя выбранного пункта
    }

    function toggleDeliveryMethod(method) {
        if (method === 'pickup') {
            document.getElementById('map-container').style.display = 'block';
            document.getElementById('address-container').style.display = 'none'; // Скрываем адрес
        } else {
            document.getElementById('map-container').style.display = 'none';
            document.getElementById('address-container').style.display = 'block'; // Показываем адрес
        }
    }


    document.getElementById('apply-promo').addEventListener('click', function() {
    const promoCode = document.getElementById('promo-code').value;
    const totalPriceElement = document.getElementById('total-price');
    const discountMessage = document.getElementById('discount-message');
    let totalPrice = parseFloat("{{ $totalPrice }}"); // Начальная цена

    // Переменная для отслеживания, применён ли промокод
    let promoApplied = false;

    if (promoApplied) {
        discountMessage.innerHTML = 'Вы уже применили промокод';
        return;
    }

    if (promoCode) {
        fetch('{{ route('apply.promo') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Добавляем CSRF токен
            },
            body: JSON.stringify({
                promo_code: promoCode
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const discount = data.discount; // Получаем скидку
                const discountedPrice = totalPrice - (totalPrice * discount / 100);
                totalPriceElement.innerHTML = `${discountedPrice.toFixed(2)} ₽`; // Обновляем цену
                discountMessage.innerHTML = `Промокод применён. Скидка ${discount}%`;
                promoApplied = true; // Отмечаем, что промокод применён
            } else {
                discountMessage.innerHTML = 'Неверный промокод';
            }
        })
        .catch(error => {
            console.error('Ошибка:', error);
            discountMessage.innerHTML = 'Произошла ошибка. Попробуйте снова.';
        });
    } else {
        discountMessage.innerHTML = 'Введите промокод';
    }
});
</script>

<x-footer></x-footer>