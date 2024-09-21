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

    .cart-count {
        color: black;
    }

    
    .dropdown_catalog {
        cursor: pointer;
        color: black;
    }
</style>
<div class="checkout-success">
    <h1>Спасибо за ваш заказ!</h1>
    <p>Ваш заказ был успешно оформлен. Мы свяжемся с вами в ближайшее время для подтверждения.</p>
    <a href="/" class="btn btn-primary">Вернуться на главную</a>
</div>


<x-footer></x-footer>