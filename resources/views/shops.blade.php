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
<div class="shops_container">
    <h1 class="shopsh1">Список магазинов</h1>
    <div class="shops">
        <div class="shops_cart">
            <img src="/img/shops/ecat.png" alt="Екатеринбург">
            <div class="shops_ecat_info">
                <h2>Адрес точки г. Екатеринбург:</h2>
                <p>ТРЦ «Гринвич»</p>
                <p>Универмаг «Hi-Light”</p>
                <p>ул. 8 марта, 46</p>
                <p>С 10.00-22.00 ежедневно </p>
            </div>
        </div>

        <div class="shops_cart">
            <img src="/img/shops/mosc.png" alt="Москва">
            <div class="shops_mosc_info">
                <h2>Адрес точки г. Москва:</h2>
                <p>ТЦ Метрополис</p>
                <p>Универмаг «Artfiera”</p>
                <p>Ленинградское ш., 16Ac4 2 этаж</p>
                <p>С 10.00-23.00 ежедневно</p>
            </div>
        </div>

        <div class="shops_cart">
            <img src="/img/shops/ufa.png" alt="Уфа">
            <div class="shops_ufa_info">
                <h2>Адрес точки г. Уфа:</h2>
                <p>Универмаг «Фабрика»</p>
                <p>ул. Чернышевского, 88</p>
                <p>2 этаж</p>
                <p>С 10.00-22.00 ежедневно</p>
            </div>
        </div>
    </div>

</div>
<x-footer></x-footer>