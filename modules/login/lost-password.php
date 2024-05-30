<?php

$pageTitle = "Восстановить пароль";

echo "<pre>";
print_r($_POST);
echo "</pre>";

// 1. Проверить отправку формы POST
if (isset($_POST['lost-password'])) {

    $_POST['email'] = trim($_POST['email']);

    // 2. Проверка на заполненный email // info@mail.com
    if (trim($_POST['email']) == '') {
        $errors[] = ['title' => 'Введите Email', 'desc' => '<p>Email обязателен для регистрации на сайте</p>'];
    } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = ['title' => 'Введите корректный Email'];
    }

    if (empty($errors)) {

        // 3. Проверка существующего email
        $user = R::findOne('users', 'email = ?', array($_POST['email']));

        if ($user) {
            // 4. Сгенерировать секретный код для сброса пароля

            // Генерируем секретный код
            function random_str($num = 30)
            {
                return substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $num);
            }
            $recovery_code = random_str();

            // 5. Запомнить секретный код. Записать его в БД.
            $user->recovery_code = $recovery_code;
            R::store($user);
        } else {
            $errors[] = ['title' => 'Неверный Email'];
        }
    }
}






// 6. Присылаем пользователю специальную ссылку с секретным кодом для установки нового пароля


ob_start();
include ROOT . 'templates/login/lost-password.tpl';
$content = ob_get_contents();
ob_end_clean();

include ROOT . 'templates/_page-parts/_head.tpl';
include ROOT . 'templates/login/login-page.tpl';
include ROOT . 'templates/_page-parts/_foot.tpl';