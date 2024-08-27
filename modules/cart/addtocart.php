<?php

// Получаем пользователя из БД
$user = R::load('users', $_SESSION['logged_user']['id']);

// Формируем корзину в виде массива
$cart = [$_GET['id'] => 1];

// Превращаем корзину в JSON строку,
// и записываем ее в поле cart для текущего пользователя
$user->cart = json_encode($cart);

// Обновляем пользователя в БД
R::store($user);

header("Location: " . HOST . "shop/" . $_GET['id']);
exit();
