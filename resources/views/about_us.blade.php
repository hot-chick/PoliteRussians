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

    .brand {
        display: flex;
        /* flex-wrap: wrap; */
        gap: 20px;
    }

    .brand h2 {
        text-align: left;
        /* color: white; */
        font-size: 24px;
    }

    .brand img {
        width: 100%;
        max-height: 70vh;
    }

    .about_us {
        width: 85%;
        /* background-color: black; */
        margin: 0 auto;
    }

    @media (max-width: 768px) {
        header {
            background-color: rgb(231, 231, 231);
            height: 80px;
        }

        .brand h2 {
            font-size: 20px;
        }

        .brand {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .brand img {
            width: 100%;
            height: auto;
        }

        .about_us {
            width: 85%;
            margin: 0 auto;
        }

        .seolinks{
            display: none;
        }
    }
</style>
<div class="seolinks">
    <a class="seolinks0" href="/">Главная </a>/ <a class="seolinks1" href="/about_us"> О нас</a>
</div>
<div class="about_us">

    <h1 style="font-size: 36px;">О бренде</h1>

    <div class="brand">
        <img src="/img/about_us.png" alt="about_us">
        <h2>Так случилось, что вместе с рождением мы получаем не только имя, но и национальность. Мы рождаемся
            башкирами, татарами, русскими, бурятами, украинцами, белорусами, чеченцами, чувашами, 196 национальностей в
            России, и каждый из нас уважает традиции и корни своего народа. Но весь мир называет всех нас русскими. Мы
            не возражаем, мы Вежливая нация.
            Вежливые русские – люди разных национальностей, но с одним сердцем, ибо у нас общая история и достижения.
        </h2>
    </div>

</div>

<x-footer></x-footer>
