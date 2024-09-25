<footer class="site-footer">
    <style>
        a {
            font-family: "Manrope", serif;
            font-weight: normal;
        }

        @media (max-width: 768px) {
            .footer-column button {
                height: fit-content;
            }

            .footer-column p {
                width: 100%;
            }
        }
    </style>

    <div class="footer-container">
        <div class="footer-column">
            <h4>Каталог</h4>
            <ul>
                <li><a href="/catalog">Смотреть все</a></li>
            </ul>
        </div>
        <div class="footer-column">
            <h4>Покупателям</h4>
            <ul>
                <li><a href="/delivery">Доставка</a></li>
                <li><a href="/giftcard">Подарочная карта</a></li>
            </ul>
        </div>
        <div class="footer-column">
            <h4>О компании</h4>
            <ul>
                <li><a href="/about_us">О нас</a></li>
                <li><a href="/contacts">Контакты</a></li>
                <li><a href="/shops">Магазины</a></li>
            </ul>
        </div>
        <div class="footer-column">
            <form class="sendaway" action="{{ route('subscribe') }}" method="POST">
                @csrf
                <input placeholder="E-mail" type="email" name="email" required>
                <button type="submit">Подписаться на наши новости</button>
            </form>
            <p>Нажимая кнопку «подписаться», вы даёте согласие на рекламную рассылку и обработку персональных данных в
                соответствии с правилами.</p>
        </div>
    </div>
    <div class="footer-bottom">
        <a href="/">Публичная оферта</a>
        <a href="/">Политика конфиденциальности</a>
        <a href="/">Пользовательское соглашение</a>
    </div>
    <div class="footer-bottom2">
        <p>&copy PoliteRussians все права защищены</p>
        <div class="socials">
            <a target="_blank" href="https://t.me/VRpolite"><img src="/img/icons_telegram.png" alt="telegram"></a>
            <a target="_blank" href="https://www.instagram.com/polite.russians.ru?igsh=MXVyNTFwZTBuM2ZmNA=="><img src="/img/icons_instagram.png" alt="instagram"></a>
        </div>
    </div>
</footer>
</body>


</html>