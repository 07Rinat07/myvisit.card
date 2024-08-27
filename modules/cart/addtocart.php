<?php

// Получаем пользователя из БД
$user = R::load('users', $_SESSION['logged_user']['id']);

// Получаем корзину из БД
$cart = json_decode($user->cart, true);

// Добавляем товар в корзину
if (isset($cart[$_GET['id']])) {
    // Если товар был в корзине, увеличиваем кол-во товара на 1
    $cart[$_GET['id']] = $cart[$_GET['id']] + 1;
} else {
    // Если товара не было в корзине, добавляем его в кол-ве 1 ед.
    $cart[$_GET['id']] = 1;
}

// Превращаем корзину в JSON строку,
// и записываем ее в поле cart для текущего пользователя
$user->cart = json_encode($cart);

// Обновляем пользователя в БД
R::store($user);

header("Location: " . HOST . "shop/" . $_GET['id']);
exit();
