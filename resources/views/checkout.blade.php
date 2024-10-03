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

    .empty_cart {
        text-align: center;
    }
</style>
<div class="seolinks">
    <a class="seolinks0" href="/">Главная </a>/ <a class="seolinks1" href="/checkout"> Оформление заказа</a>
</div>
<div class="checkout">

    <h1>Оформление заказа</h1>

    @php
        $totalPrice = session('cart', []) ? array_sum(array_column(session('cart'), 'price')) : 0; // или любое другое вычисление
    @endphp

    @if (session('cart', []) == [])
        <div class="empty_cart">
            <p>Корзина пуста. Вы пока ничего не добавили в корзину.</p>
            <a href="/catalog" class="btn btn-primary">В каталог</a>
        </div>
    @else
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
                        <input type="text" id="lastname" name="lastname" placeholder="Фамилия" required>
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
                <br>
                <div class="third">
                    <div class="form-groupthird">
                        <input type="checkbox" id="checkboxloyal" name="checkboxloyal" required>
                        <p>Я соглашаюсь с <a href="/privacy_policy">политикой конфиденциальности</a> для регистрации.
                        </p>
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
                <input type="text" id="address" name="address" placeholder="Адрес доставки">
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
                        $totalPrice = 0; // Инициализация переменной
                        $cartItems = [];
                    @endphp

                    @foreach (session('cart', []) as $item)
                        @php
                            $cartItems[$item['product_id']]['count'] = isset($cartItems[$item['product_id']])
                                ? $cartItems[$item['product_id']]['count'] + 1
                                : 1;
                            $cartItems[$item['product_id']]['size'] = $item['size'];
                        @endphp
                    @endforeach

                    @foreach ($cartItems as $productId => $item)
                        @php
                            $product = \App\Models\Product::find($productId);
                            if ($product) {
                                $totalPrice += $product->price * $item['count'];
                            }
                        @endphp

                        @if ($product && $product->photos->isNotEmpty())
                            <div class="card">
                                <a href="{{ route('product', $product->id) }}">
                                    <img src="{{ asset($product->photos->first()->photo_url) }}" loading="lazy"
                                        alt="{{ $product->title }}">
                                </a>
                                <p>{{ $product->title }}</p>
                                <p>{{ $product->price }} ₽</p>
                                <p>Размер: {{ $item['size'] }}</p>
                                <p>Количество: {{ $item['count'] }}</p>
                                <button class="add-to-cart" data-product-id="{{ $product->id }}">Удалить</button>
                            </div>
                        @endif
                    @endforeach
                </div>

                <div class="cart-summary">
                    <p>Итого к оплате: <strong id="total-price">{{ $totalPrice }} ₽</strong></p>
                    <input type="text" id="promo-code" placeholder="Введите промокод">
                    <input type="hidden" id="discount-hidden" name="discount" value="0">
                    <button type="button" class="btn btn-primary" id="apply-promo">Применить промокод</button>
                </div>
            </div>
            <!-- Кнопка отправки формы -->
            <button type="submit" class="btn btn-primary" onclick="validateForm(event)">Оформить заказ</button>
        </form>
    @endif
</div>


<script type="text/javascript">
    ymaps.ready(initMap);

    function initMap() {
        var myMap = new ymaps.Map("map", {
            center: [54.74, 55.96],
            zoom: 9
        });
        // Загружаем пункты самовывоза
        loadPickupPoints(myMap);
    }

    function loadPickupPoints(map) {
        fetch('{{ route('get.delivery.points') }}')
            .then(response => response.json())
            .then(points => {
                points.forEach(point => {
                    if (point.latitude && point.longitude) {
                        var placemark = new ymaps.Placemark([point.latitude, point.longitude], {
                            balloonContent: `<div>${point.name}</div><button type="button" class="choose-point-btn" onclick="choosePickupPoint('${point.name}', this)">Выбрать пункт</button>`
                        });
                        map.geoObjects.add(placemark);
                    }
                });
            })
            .catch(error => {
                console.error('Ошибка при загрузке пунктов выдачи:', error);
            });
    }

    function choosePickupPoint(pointName, button) {
        // Отключаем стандартное поведение кнопки
        event.preventDefault();

        // Сбрасываем цвет для всех кнопок
        const buttons = document.querySelectorAll('.choose-point-btn');
        buttons.forEach(btn => btn.style.backgroundColor = '');

        // Меняем цвет выбранной кнопки на зеленый
        button.style.backgroundColor = 'chartreuse';

        // Обновляем информацию о выбранном пункте
        document.getElementById('selected-point').innerText = `Выбран пункт: ${pointName}`;

        // Сохраняем имя выбранного пункта в скрытое поле формы
        document.getElementById('selected-point-id').value = pointName;

        // Сохраняем выбранный пункт в глобальной переменной
        selectedPickupPoint = pointName;
    }

    document.getElementById('apply-promo').addEventListener('click', function() {
        const promoCode = document.getElementById('promo-code').value;
        const totalPriceElement = document.getElementById('total-price');
        const discountMessage = document.getElementById('discount-message');

        // Получаем значение из бэкенда
        let totalPrice = parseFloat("{{ $totalPrice }}");

        if (promoCode) {
            fetch('{{ route('apply.promo') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        promo_code: promoCode
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const discount = data.discount;
                        const discountedPrice = totalPrice - (totalPrice * discount / 100);
                        totalPriceElement.innerHTML = `${discountedPrice.toFixed(2)} ₽`;

                        // Обновляем скрытые поля с промокодом и скидкой
                        document.getElementById('promo-code-hidden').value = promoCode;
                        document.getElementById('total-price-hidden').value = discountedPrice.toFixed(2);
                        document.getElementById('discount-hidden').value = discount;

                        discountMessage.innerHTML = `Промокод применён. Скидка ${discount}%`;
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

    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-product-id');

            fetch('/cart/remove', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                            .getAttribute('content')
                    },
                    body: JSON.stringify({
                        product_id: productId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.reload(); // Перезагрузка страницы после удаления
                    } else {
                        console.error('Ошибка при удалении товара.');
                    }
                })
                .catch(error => console.error('Ошибка:', error));
        });
    });

    let selectedPickupPoint = null;

    function toggleDeliveryMethod(method) {
        if (method === 'courier') {
            document.getElementById('address-container').style.display = 'block';
            document.getElementById('map-container').style.display = 'none';
        } else if (method === 'pickup') {
            document.getElementById('address-container').style.display = 'none';
            document.getElementById('map-container').style.display = 'block';
        }
    }

    // Проверка перед отправкой формы
    function validateForm(event) {
        const deliveryMethod = document.querySelector('input[name="delivery"]:checked');
        const address = document.getElementById('address').value;

        if (!deliveryMethod) {
            event.preventDefault();
            alert('Пожалуйста, выберите способ доставки.');
            return;
        }

        if (deliveryMethod.value === 'courier' && !address) {
            event.preventDefault();
            alert('Пожалуйста, введите адрес доставки.');
            return;
        }

        if (deliveryMethod.value === 'pickup' && !selectedPickupPoint) {
            event.preventDefault();
            alert('Пожалуйста, выберите пункт самовывоза на карте.');
            return;
        }

        // Если всё в порядке, форма отправится
    }
</script>

<x-footer></x-footer>
