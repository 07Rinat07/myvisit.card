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

    $order->timestamp = time();
    $order->status = 'new';
    $order->paid = false;

    if (isLoggedIn()) $order->user = $_SESSION['logged_user'];

    $order_cart = array();
    $total_price = 0;

    foreach ($cart as $key => $value) {
        $current_item = array();

        $current_item['id'] = $key;
        $current_item['amount'] = $value;

        $product = R::load('products', $key);
        $current_item['title'] = $product['title'];
        $current_item['price'] = $product['price'];

        $total_price = $total_price + ($product['price'] * $value);

        $order_cart[] = $current_item;
    }

    $order->price = $total_price;
    $order->cart = $order_cart;

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
