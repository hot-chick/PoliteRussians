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

    .wishlist-count {
        color: black;
    }

    .cart-count {
        color: black;
    }

    
    .dropdown_catalog {
        cursor: pointer;
        color: black;
    }

    .checkout-success{
        width: 85%;
        margin: 0 auto;
    }
</style>
<div class="seolinks">
    <a class="seolinks0" href="/">Главная </a>/ <a class="seolinks1" href="/checkout-success"> Успешный заказ</a>
</div>
<div class="checkout-success">
    <h1>Спасибо за ваш заказ!</h1>
    <p>Ваш заказ был успешно оформлен. Мы свяжемся с вами в ближайшее время для подтверждения.</p>
    <a href="/" class="btn btn-primary">Вернуться на главную</a>
</div>


<x-footer></x-footer>