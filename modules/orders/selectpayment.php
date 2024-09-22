<?php

$pageTitle = "Выбор способа оплаты заказа";

$orderId = $_GET['id'];

// Получить данные о заказе из базы
$order = R::load('orders', $orderId);

// Записать данные о заказе в сессиию
$_SESSION['order'] = array(
    'id' => $order['id'],
    'price' => $order['price'],
);

// Шаблоны
include ROOT . 'templates/_page-parts/_head.tpl';
include ROOT . 'templates/_parts/_header.tpl';
include ROOT . 'templates/orders/selectpayment.tpl';
include ROOT . 'templates/_parts/_footer.tpl';
include ROOT . 'templates/_page-parts/_foot.tpl';