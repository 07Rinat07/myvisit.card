<?php

$pageTitle = "Создать новый заказ";

// Получаем товары которые соответствую товарам в корзине
if (!empty($cart)) {
    $products = R::findLike('products', ['id' => array_keys($cart)]);
    // R::findLike('products', ['id' => ['5', '9']]);
} else {
    $products = array();
}

// Общая стоимость товаров в корзине
$cartTotalPrice = 0;
foreach ($cart as $index => $item) {
    $cartTotalPrice += $products[$index]['price'] * $item;
}

// Шаблоны
include ROOT . 'templates/_page-parts/_head.tpl';
include ROOT . 'templates/_parts/_header.tpl';
include ROOT . 'templates/orders/new.tpl';
include ROOT . 'templates/_parts/_footer.tpl';
include ROOT . 'templates/_page-parts/_foot.tpl';
