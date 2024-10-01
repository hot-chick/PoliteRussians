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

    .dropdown_catalog {
        cursor: pointer;
        color: black;
    }

    .cart-count {
        color: black;
    }
</style>
<div class="shops_container">
    <h1 class="shopsh1">Список магазинов</h1>
    <div id="map-container">
        <div id="map" style="width: 85%; height: 600px; margin: 0 auto;"></div>
        <div id="selected-point"></div>
    </div>
</div>
<script type="text/javascript">
    function initMap() {
        var myMap = new ymaps.Map("map", {
            center: [55.75, 37.57], // Центр карты (Москва)
            zoom: 5
        });

        // Добавляем точки
        var points = [{
                coords: [56.8290, 60.5988],
                name: 'Екатеринбург, ТРЦ «Гринвич» <br> Универмаг «Hi-Light” <br> ул. 8 марта, 46 <br> С 10.00-22.00 ежедневно'
            },
            {
                coords: [55.8225, 37.4967],
                name: 'Москва, ТЦ Метрополис <br> Универмаг «Artfiera” <br> Ленинградское ш., 16Ac4 2 этаж <br> С 10.00-23.00 ежедневно'
            },
            {
                coords: [54.7286, 55.9468],
                name: 'Уфа, Универмаг «Фабрика» <br>  ул. Чернышевского, 88 2 этаж <br> С 10.00-22.00 ежедневно'
            }
        ];

        points.forEach(function(point) {
            var placemark = new ymaps.Placemark(point.coords, {
                balloonContent: point.name
            });

            myMap.geoObjects.add(placemark);
        });
    }

    ymaps.ready(initMap);
</script>
<x-footer></x-footer>