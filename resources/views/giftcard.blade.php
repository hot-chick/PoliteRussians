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
    }

    .delivery {
        width: 80%;
        margin: 0 auto;
    }

    .dropdown_catalog {
        cursor: pointer;
        color: black;
    }
    .wishlist-count {
        color: black;
    }

    .cart-count {
        color: black;
    }
</style>
<div class="delivery">
    <div class="text">
        <ul>
            <strong>ПОДАРОЧНАЯ КАРТА</strong>
            <br>
            <br>
            <ul>
                <li>Мы предлагаем электронные подарочные карты. </li>
                <br>
                <li>Мы отправим письмо с секретным промокодом на подаренную сумму на указанный вами электронный адрес.
                </li>
                <br>
                <li>Картой можно воспользоваться на нашем официальном сайте</li><br>
                <li>Подарочная карта может быть использована для покупки любого товара нашего бренда.</li><br>
                <li>Доступные для приобретения номиналы подарочных карт: 5 000; 10 000; 15 000; 20 000 или 50 000
                    рублей. </li><br>
                <li>Стоимость подарочной карты может быть оплачена на сайте, удобным для вас способом. Карта не может
                    быть оплачена другой подарочной картой.</li><br>
                <li>Если сумма покупки превышает сумму баланса карты, покупатель может доплатить разницу.</li><br>
                <li>Товары, приобретенные на подарочную карту на нашем официальном сайте, подлежат обмену и возврату на
                    условиях и в порядке, установленных для любых покупок.
                    Подарочная карта не является именной.
                </li><br>
                <li>**Срок действия (использования) подарочной карты – в течение 1 года с даты приобретения. По
                    истечении срока действия карта является недействительной и не может использоваться для оплаты
                    Товаров на нашем сайте.</li>
            </ul>
        </ul>
    </div>
</div>


<x-footer></x-footer>
