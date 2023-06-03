<header class="header">
    <div class="header__image-ibg">
        <picture>
            <source data-srcset="img/header/bg.webp" srcset="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=" type="image/webp"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=" data-src="img/header/bg.jpg" alt="Фон">
        </picture>
    </div>
    <div class="header__container-big">
        <a href="/" class="header__logo">
            <picture>
                <source srcset="img/logo.webp" type="image/webp"><img class="img-fluid img-main" src="img/logo.png" alt="База знаний">
            </picture>
        </a>
        <div data-da=".menu__body,767" class="header__form">
            <?php require_once('pages/assets/search.php') ?>
        </div>
        <div data-da=".menu__body,767" class="header__icons icons-header">
            <!-- <a href="/cabinet" class="icons-header__icon">
                <img class="img-fluid" src="img/header/user.png" alt="Иконка">
            </a> -->
            <!-- <a href="https://calculator-online.net/" target="_blank" class="icons-header__icon">
                <img class="img-fluid" src="img/header/1.svg" alt="Иконка">
            </a>
            <a href="https://www.gismeteo.lv/ru/" target="_blank" class="icons-header__icon">
                <img class="img-fluid" src="img/header/2.svg" alt="Иконка">
            </a>
            <a href="https://www.xe.com/" target="_blank" class="icons-header__icon">
                <picture>
                    <source srcset="img/header/3.webp" type="image/webp"><img class="img-fluid" src="img/header/3.png" alt="Иконка">
                </picture>
            </a>
            <a href="/php/unlogin.php" class="icons-header__icon">
                <img class="img-fluid" src="img/header/4.svg" alt="Иконка">
            </a> -->
        </div>
        <div class="header__menu menu">
            <nav class="menu__body">
                <div class="menu__image-ibg">
                    <picture>
                        <source data-srcset="img/header/bg.webp" srcset="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=" type="image/webp"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=" data-src="img/header/bg.jpg" alt="Фон">
                    </picture>
                </div>
            </nav>
        </div>
        <button type="button" class="menu__icon icon-menu"><span></span></button>
    </div>
</header>