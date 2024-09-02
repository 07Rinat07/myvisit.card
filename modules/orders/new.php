<?php

$pageTitle = "Создать новый заказ";


if (isset($_POST['submit'])) {
    // Сохраняем заказ
    $order = R::dispense('orders');
    $order->name = $_POST['name'];
    $order->secondname = $_POST['secondname'];
    $order->email = $_POST['email'];
    $order->phone = $_POST['phone'];
    $order->address = $_POST['address'];
    $order->cart = json_encode($cart);

    if (isLoggedIn()) {
        $order->user = $_SESSION['logged_user'];
    }

    R::store($order);

    // Очищаем корзину
    if (isLoggedIn()) {
        $_SESSION['cart'] = array();
        $_SESSION['logged_user']->cart = '';
        R::store($_SESSION['logged_user']);
    } else {
        setcookie('cart', '', time() - 3600);
    }

    header("Location: " . HOST . 'ordercreated');
    exit();
}

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
