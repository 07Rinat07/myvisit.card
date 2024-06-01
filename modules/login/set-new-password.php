<?php

$pageTitle = "Установить новый пароль";

// TODO
// 1. Прошли по секретной ссылке с емейл
// 2. Найти по емейл в БД
// 3. Проверить секретный код на верность
// 4. Показать ошибку емейл или код неверен
//__________________________________________
// . Если отправлена форма с новым паролем
// . Найти по емейл в БД.
// . Проверить секретный код на верность
// . Смена пароля
// . Сообщение об успехе и вход на сайт
// . Перенаправление на lost-password




ob_start();
include ROOT . 'templates/login/set-new-password.tpl';
$content = ob_get_contents();
ob_end_clean();

include ROOT . 'templates/_page-parts/_head.tpl';
include ROOT . 'templates/login/login-page.tpl';
include ROOT . 'templates/_page-parts/_foot.tpl';