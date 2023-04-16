<div id="popup-auth" aria-hidden="true" class="popup">
    <div class="popup__wrapper">
        <div class="popup__content">
            <button data-close type="button" class="popup__close _icon-exit"></button>
            <div class="popup__body">
                <h2 class="popup__title title title_s22">Авторизация</h2>
                <form id="auth_form" class="popup__form form-popup" action="./php/login.php" method="POST">
                    <div class="form-popup__inputs">
                        <div class="form-popup__item">
                            <input type="text" name="form-login" data-error="Неверный логин" placeholder="Логин" class="form-popup__input">
                        </div>
                        <div class="form-popup__item">
                            <input type="text" name="form-password" data-error="Неверный пароль" placeholder="Пароль" class="form-popup__input">
                            <button class="form-popup__btn _icon-arrow-right" type="submit"></button>
                        </div>
                    </div>
                    <div class="checkbox form-popup__checkbox">
                        <input id="c_1" data-error="Ошибка" class="checkbox__input" type="checkbox" value="1" name="form-remember">
                        <label for="c_1" class="checkbox__label">
                            <img src="img/icons/check.svg" alt="Запомнить меня">
                            <span class="checkbox__text">Запомнить меня</span>
                        </label>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>