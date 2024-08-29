<?php

$pageTitle = "Корзина товаров";

// Получаем товары которые соответствую товарам в корзине
$products = R::findLike('products', ['id' => array_keys($_SESSION['cart'])]);
// R::findLike('products', ['id' => ['5', '9']]);

// Общая стоимость товаров в корзине
$cartTotalPrice = 0;
foreach ($_SESSION['cart'] as $index => $item) {
    $cartTotalPrice += $products[$index]['price'] * $item;
}

// Шаблоны
include ROOT . 'templates/_page-parts/_head.tpl';
include ROOT . 'templates/_parts/_header.tpl';
include ROOT . 'templates/cart/cart.tpl';
include ROOT . 'templates/_parts/_footer.tpl';
include ROOT . 'templates/_page-parts/_foot.tpl';
