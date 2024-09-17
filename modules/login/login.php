<?php

$pageTitle = "Вход на сайт";
$pageClass = "authorization-page";

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

// 1. Проверка на отправку формы входа
if (isset($_POST['login'])) {

    // 2. Заполненность полей
    if ( trim($_POST['email']) == '' ) {
        $_SESSION['errors'][] = ['title' => 'Введите Email', 'desc' => '<p>Email обязателен для регистрации на сайте</p>'];
    } else if ( !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ){
        $_SESSION['errors'][] = ['title' => 'Введите корректный Email'];
    }

    if ( trim($_POST['password']) == '' ) {
        $_SESSION['errors'][] = ['title' => 'Введите пароль'];
    }

    // Если поля заполнены, ошибок нет
    if (empty($_SESSION['errors'])){
        // 3. Ищем нужного юзера в БД по email
        $user = R::findOne('users', 'email = ?', array($_POST['email']));

        if ( $user ) {
            // 4. Сравнение пароля
            if ( password_verify($_POST['password'], $user->password) ) {
                // Пароль верен!
                // Вход на сайт!
                // 5. Вход пользователя на сайт
                // $success[] = ['title' => 'Верный пароль!'];

                // Логин пользователя
                $_SESSION['logged_user'] = $user;
                $_SESSION['login'] = 1;
                $_SESSION['role'] = $user->role;
                $_SESSION['cart'] = json_decode($_SESSION['logged_user']['cart'], true);

                // Работа с корзиной: start

                // План действий:
                // 1. Достать корзину из БД
                // 2. Совместить ее с COOKIES если они есть
                // 3. Сохранить полученную корзину в БД
                // 4. Сохранить полученную корзину в SESSION
                // 5. Очищаем корзину в COOKIE

                $temp_cart = array();

                if ($user->cart) {
                    $temp_cart = json_decode($user->cart, true);
                }

                // Есть ли корзина COOKIE, то переносим ее данные в $temp_cart
                if (isset($_COOKIE['cart']) && !empty($_COOKIE['cart'])) {
                    $cookie_cart = json_decode($_COOKIE['cart'], true);

                    foreach ($cookie_cart as $key => $value) {
                        if (isset($temp_cart[$key])) {
                            $temp_cart[$key] += $value;
                        } else {
                            $temp_cart[$key] = $value;
                        }
                    }

                    // Очищаем корзину в COOKIE
                    setcookie("cart", "", time() - 3600);
                }

                // Сохраняем корзину в БД - JSON
                $user->cart = json_encode($temp_cart);

                // Обновляем пользователя в БД
                R::store($user);

                // ... и в СЕССИЮ - массив
                $_SESSION['cart'] = $temp_cart;

                // --- Работа с корзиной: end


                $_SESSION['success'][] = ['title' => 'Рады снова видеть вас! Вы успешно вошли на сайт'];

                header('Location: ' . HOST . "profile");
                exit();

            } else {
                // Пароль не верен
                $_SESSION['errors'][] = ['title' => 'Неверный пароль'];
            }
        } else {
            // Email не найден
            $_SESSION['errors'][] = ['title' => 'Неверный email'];

        }

    }

}

ob_start();
include ROOT . 'templates/login/form-login.tpl';
$content = ob_get_contents();
ob_end_clean();

include ROOT . 'templates/_page-parts/_head.tpl';
include ROOT . 'templates/login/login-page.tpl';
include ROOT . 'templates/_page-parts/_foot.tpl';
