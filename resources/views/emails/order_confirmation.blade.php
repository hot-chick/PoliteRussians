<h1>Подтверждение заказа</h1>

<p>Здравствуйте, {{ $orderData['name'] }} {{ $orderData['lastname'] }}.</p>
<p>Ваш заказ успешно оформлен. Вот детали вашего заказа:</p>

<ul>
    <li>Имя: {{ $orderData['name'] }}</li>
    <li>Фамилия: {{ $orderData['lastname'] }}</li>
    <li>Email: {{ $orderData['email'] }}</li>
    <li>Телефон: {{ $orderData['phone'] }}</li>
    <li>Адрес: {{ $orderData['address'] ?? 'Самовывоз' }}</li>
    <li>Способ доставки: {{ $orderData['delivery'] == 'courier' ? 'Курьер' : 'Самовывоз' }}</li>
    <li>Способ оплаты: {{ $orderData['payment'] }}</li>
    <li>Пункт самовывоза: {{ $orderData['pickup_point'] ?? 'Не указан' }}</li>
    <li>Сумма заказа: {{ $orderData['totalPrice'] }} ₽</li>
    @if ($orderData['discount'])
    <li>Скидка: {{ $orderData['discount'] }}%</li>
    @endif
</ul>

<h2>Товары в заказе:</h2>
<ul>
    @if (!empty($orderData['products']) && is_array($orderData['products']))
    @foreach ($orderData['products'] as $product)
    <p>Товар: {{ $product['description'] }}</p>
    <p>Цена: {{ $product['amount']['value'] }} {{ $product['amount']['currency'] }}</p>
    <p>Количество: {{ $product['quantity'] }}</p>
    @endforeach
    @else
    <li>Нет товаров в заказе.</li>
    @endif
</ul>

<p>Спасибо за ваш заказ!</p>