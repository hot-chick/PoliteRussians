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

    .delivery {
        width: 85%;
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

    .text{
        line-height: 1.5;
    }
</style>
<div class="delivery">
    <div class="text">
        <ul>
            <br>
            <strong>ПОДАРОЧНАЯ КАРТА</strong>
            <br>
            <br>
            <ul>
                <li>Мы предлагаем электронные подарочные карты. </li>
                <li>Мы отправим письмо с секретным промокодом на подаренную сумму на указанный вами электронный адрес.
                </li>
                <li>Картой можно воспользоваться на нашем официальном сайте</li>
                <li>Подарочная карта может быть использована для покупки любого товара нашего бренда.</li>
                <li>Доступные для приобретения номиналы подарочных карт: 5 000; 10 000; 15 000; 20 000 или 50 000
                    рублей. </li>
                <li>Стоимость подарочной карты может быть оплачена на сайте, удобным для вас способом. Карта не может
                    быть оплачена другой подарочной картой.</li>
                <li>Если сумма покупки превышает сумму баланса карты, покупатель может доплатить разницу.</li>
                <li>Товары, приобретенные на подарочную карту на нашем официальном сайте, подлежат обмену и возврату на
                    условиях и в порядке, установленных для любых покупок.
                    Подарочная карта не является именной.
                </li>
                <li>**Срок действия (использования) подарочной карты – в течение 1 года с даты приобретения. По
                    истечении срока действия карта является недействительной и не может использоваться для оплаты
                    Товаров на нашем сайте.</li>
            </ul>
        </ul>
    </div>
</div>


<x-footer></x-footer>
