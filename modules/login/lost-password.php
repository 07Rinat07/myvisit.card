<?php

$pageTitle = "Восстановить пароль";

// TODO 1. Проверить отправку формы POST.
// TODO 2. Проверка на заполненный email // info@mail.com.
// TODO 3. Проверка существующего email.
// TODO 4. Cгенерировать секретный код для сброса пароля.
// TODO 5. Запомнить секретный код. Записать его в базу данных.
// TODO 6. Присылаем пользователю спец ссылку с секретным кодом для установки нового пароля.


ob_start();
include ROOT . 'templates/login/lost-password.tpl';
$content = ob_get_contents();
ob_end_clean();

include ROOT . 'templates/_page-parts/_head.tpl';
include ROOT . 'templates/login/login-page.tpl';
include ROOT . 'templates/_page-parts/_foot.tpl';

