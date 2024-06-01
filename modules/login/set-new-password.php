<?php

$pageTitle = "Установить новый пароль";

// 1) Пришли по секретной ссылке с EMAIl
if (!empty($_GET['email']) && !empty($_GET['code'])) {

    // Найти юзера по email в БД
    $user = R::findOne('users', 'email = ?', array($_GET['email']));

    if (!$user) {
        header("Location: " . HOST . "lost-password");
    }
}



// Проверить Секретный код на верность

// Показать ошибку  email или код неверен

// 2) Если отправлена форма с новым паролем

// Найти по email в БД

// Проверить Секретный код на верность

// Смена пароля

// Сообщение об успехе и вход на сайт

// 3) Перенаправляем на loat-password




ob_start();
include ROOT . 'templates/login/set-new-password.tpl';
$content = ob_get_contents();
ob_end_clean();

include ROOT . 'templates/_page-parts/_head.tpl';
include ROOT . 'templates/login/login-page.tpl';
include ROOT . 'templates/_page-parts/_foot.tpl';