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

    .delivery {
        width: 80%;
        margin: 0 auto;
    }

    ul {
        margin-bottom: 20px;
    }

    @media (max-width: 768px) {
        header {
            background-color: rgb(219, 219, 219);
            height: 80px;
        }
    }
</style>
<div class="delivery">
    <div class="text">
        <h4>Пожалуйста, внимательно ознакомьтесь с правилами перед использованием.</h4>
        <br>
        <ul>
            <strong>ОФОРМЛЕНИЕ ЗАКАЗА</strong>
            <ul>
                <li>1. Выбрать понравившиеся изделия, цвет, размер и добавить их в корзину</li>
                <li>2. Перейти в корзину, проверить состав заказа и перейти к оформлению заказа. Если у вас есть промокод на скидку или подарочный сертификат, на этом этапе вам нужно ввести значение в поле «Промокод»</li>
                <li>3. Заполнить все контактные данные, выбрать способы оплаты и доставки</li>
                <li>4. Оформить заказ, нажав на кнопку «Подтвердить заказ».</li>
                <li>5. После обработки/проверки заказа Вам придет сообщение на указанный эл адрес</li>
                <li>*При возникновении ошибки наш менеджер свяжется с вами для корректировки или уточнения данных.</li>
            </ul>
            <h2>ВАРИАНТЫ ОПЛАТЫ </h2>
            <br>
            <strong>ОНЛАЙН ОПЛАТА</strong>
            <ul>
                <li>Если вы хотите оплатить заказ онлайн, при оформлении покупки вам нужно выбрать вариант «онлайн–оплата». Виджет для оплаты появится автоматически сразу после оформления вами заказа. Если у вас возникли проблемы с оплатой, пожалуйста, свяжитесь с нами по телефону +7 (800) 301-73-07</li>
            </ul>

            <strong>ОПЛАТА ДОЛЯМИ</strong>
            <ul>
                <li>БЕЗ КОМИССИИ И ПРОЦЕНТОВ (сумма оплаты не превысит стоимость вашей покупки)</li>
                <li>При выборе варианта оплаты</li>
                <li>1.Сформируйте заказ в корзине</li>
                <li>2.выберите способ оплаты Долями</li>
                <li>3.укажите номер тел, ФИО, дату рождения и e-mail</li>
                <li>4.оплатите 25% от стоимости покупки</li>
                <li>5.оставшиеся 3 части спишутся автоматически с шагом в 2 недели</li>
                <h3>Оплата частями возможна только для покупателей из России. Сумма заказа, который вы планируете оплатить частями, не может превышать 30 000 рублей, а количество активных заказов не может быть более двух единовременно. Совершить новый заказ с оплатой через сервис «Долями» возможно только после того, как хотя бы один из активных заказов будет завершен.</h3>
            </ul>

            <strong>ОПЛАТА ПРИ ПОЛУЧЕНИИ </strong>
            <ul>
                <li>Если вы хотите оплатить заказ курьеру при получении или в одном из пунктов СДЭК, вам необходимо выбрать опцию «Оплата при получении». Оплата доступна банковской картой или наличными. Вы получите чек по электронной почте, номеру телефона указанных при оформлении или на руки от курьера после оплаты товара. </li>
            </ul>

            <strong>ВАРИАНТЫ ДОСТАВКИ</strong>
            <ul>
                <li>Доставка осуществляется компанией СДЭК. </li>
                <li>Варианты доставки:</li>
                <li>1. до двери курьером/до пункта выдачи СДЭК -бесплатно</li>
                <li>2. доставка с оплатой «при получении» -400р</li>
                <li>*за исключением адресов, удаленных от пункта выдачи</li>
                <li>Сроки доставки зависят от региона доставки. Минимальный срок доставки составляет 2-3 рабочих дня для Москвы.</li>
                <li>Как только ваш заказ будет передан курьерской службе, вы получите трек-номер для отслеживания его перемещений. </li>
            </ul>

            <strong>ДО ДВЕРИ</strong>
            <ul>
                <li>При оформлении заказа «до двери», укажите адрес желаемой доставки.</li>
                <li>Перед доставкой посылки с Вами свяжется курьер компании СДЭК для согласования даты и времени доставки. </li>
            </ul>

            <strong>ДО ПУНКТА ВЫДАЧИ</strong>
            <ul>
                <li>При оформлении доставки «до пункта выдачи», вам необходимо выбрать адрес удобного пункта выдачи для доставки заказа. </li>
                <li>Перейдите по ссылке «выбор пункта выдачи» и выберете нужный адрес.</li>
                <li>Вы получите уведомление о том, что заказ прибыл в выбранный вами пункт выдачи по смс</li>
            </ul>

            <strong>ДОСТАВКА С ПРИМЕРКОЙ и ОПЛАТОЙ ПРИ ПОЛУЧЕНИИ</strong>
            <ul>
                <li>Примерка возможна на ПВЗ СДЭК либо дома у получателя (при доставки курьером). Время ожидания курьера в этом случае составляет 15 минут. После примерки вы оплачиваете заказ/часть заказа удобным для вас способом (банковская карта или наличные). Если какое-либо изделие вам не подошло, вы можете сразу же вернуть его курьеру, не оплачивая его стоимость.</li>
                <li>Доставка с примеркой возможна при заказе до 3 позиций. Для примерки доступен только один неоплаченный заказ. Заказ возможен на сумму до 15000р</li>
            </ul>
        </ul>
    </div>
</div>

<x-footer></x-footer>