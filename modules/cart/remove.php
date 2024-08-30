<?php

// Получаем пользователя из БД
$user = R::load('users', $_SESSION['logged_user']['id']);

// Получаем корзину из БД
$cart = json_decode($user->cart, true);

// Удаляем товар из корзины
unset($cart[$_GET['id']]);

// Превращаем корзину в JSON строку,
// и записываем ее в поле cart для текущего пользователя
$user->cart = json_encode($cart);

// Обновляем состояние корзины в сессии
$_SESSION['cart'] = $cart;

// Обновляем пользователя в БД
R::store($user);

// Сообщение о удалении товара
$_SESSION['success'][] = ['title' => 'Товар был удален из корзины'];

header("Location: " . HOST . "cart");
exit();
