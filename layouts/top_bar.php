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
            <a href="/cabinet" class="icons-header__icon">
                <img class="img-fluid" src="img/header/user.png" alt="Иконка">
            </a>
            <a id="calculator-toggle" class="icons-header__icon">
                <img class="img-fluid" src="img/header/1.svg" alt="Иконка">
            </a>
            <a id="wether-toggle" class="icons-header__icon">
                <img class="img-fluid" src="img/header/2.svg" alt="Иконка">
            </a>
            <a href="https://www.xe.com/" target="_blank" class="icons-header__icon">
                <picture>
                    <source srcset="img/header/3.webp" type="image/webp"><img class="img-fluid" src="img/header/3.png" alt="Иконка">
                </picture>
            </a>
            <a href="/php/unlogin.php" class="icons-header__icon">
                <img class="img-fluid" src="img/header/4.svg" alt="Иконка">
            </a>
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
<?php
require_once('pages/assets/calculator.php');
require_once('pages/assets/wether.php');
?>
<script>
    $(document).click(function(event) {
        if (!$(event.target).closest('#calculator-toggle, #calculator-wiget').length) {
            $('#calculator-wiget').hide();
        }
        if (!$(event.target).closest('#wether-toggle, #weather').length) {
            $('#weather').hide();
        }
        if (!$(event.target).closest('#currency-conventer-toggle, #oanda_ecc').length) {
            $('#oanda_ecc').hide();
        }
    });
    $("#calculator-toggle").click(function(e) {
        e.preventDefault();
        $("#calculator-wiget").toggle();
    });
    $("#wether-toggle").click(function(e) {
        e.preventDefault();
        $("#weather").toggle();
    });
</script>