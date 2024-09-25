<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://api-maps.yandex.ru/2.1/?apikey=95d7b5bc-89bf-49b2-95ac-9e329e11ec37&lang=ru_RU" type="text/javascript"></script>
    <title>Карта</title>
</head>

<body>
    <div id="map" style="width: 100%; height: 400px"></div>
    <div id="selected-point"></div>
    <script type="text/javascript">
        ymaps.ready(init);

        function init() {
            var myMap = new ymaps.Map("map", {
                center: [54.74, 55.96], // Центр карты (Уфа)
                zoom: 9
            });

            // Получаем данные о пунктах выдачи из PHP
            const points = @json($points); // Передаем данные о точках в JavaScript

            points.forEach(point => {
                if (point.latitude && point.longitude) {
                    var placemark = new ymaps.Placemark([point.latitude, point.longitude], {
                        balloonContent: point.name // Контент балуна
                    });
                    myMap.geoObjects.add(placemark);
                    placemark.events.add('click', function() {
                        document.getElementById('selected-point').innerText = `Выбран пункт: ${point.name}`;
                    });
                }
            });
        }
    </script>
</body>

</html>