<?php

$pageTitle = "Заказ";
$pageClass = "profile-page";

// Если ID нет - выходим
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: " . HOST . 'profile');
    exit();
}

// Если не залогинен - выход
if (!isset($_SESSION['login']) || $_SESSION['login'] !== 1) {
    header("Location: " . HOST . 'profile');
    exit();
}

// Если есть ID - получаем данные заказа, проверяя что он действительно заказ того пользователя который залогинен
$order = R::load('orders', $_GET['id']);

// Проверка что заказ принадлежит пользователю
if ($order['user_id'] !== $_SESSION['logged_user']['id']) {
    header("Location: " . HOST . 'profile');
    exit();
}

// Get products from JSON format
$products = json_decode($order['cart'], true);

// Collect product ids
foreach ($products as $product) $ids[] = $product['id'];

// Get needed products from DB
$productsDB = R::findLike('products', ['id' => $ids]);

include ROOT . 'templates/_page-parts/_head.tpl';
include ROOT . 'templates/_parts/_header.tpl';

include ROOT . 'templates/profile/profile-order.tpl';

include ROOT . 'templates/_parts/_footer.tpl';
include ROOT . 'templates/_page-parts/_foot.tpl';
