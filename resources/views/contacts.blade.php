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

<div class="contacts">
    <h1>Контактная информация</h1>
    <h3>Телефон: <a href="tel:88003017307">88003017307</a></h3>
    <h3>Почта: <a href="mailto:polite.russians.ru@yandex.ru">polite.russians.ru@yandex.ru</a></h3>
    <br>
    <h3>Реквизиты</h3>
    <p>ИП Аслямов Алексей Валерьевич</p>
    <p>ИНН 027605219202 </p>
    <p>ОГРНИП 317028000075498</p>
    <p>Юр.адрес: 450501, РБ, район Уфимский,
        д. Стуколкино, ул. Сосновая, д.9, кв.2</p>
    <p>расч. счет 40802810306000060443</p>
    <p>Башкирское отделение №8598</p>
    <p>ПАО Сбербанк</p>
    <p>Кор. счет 30101810300000000601</p>
    <p>БИК 048073601</p>
</div>


<x-footer></x-footer>