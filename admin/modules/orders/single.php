<?php

// Get order
$order = R::load('orders', $_GET['id']);

// Get products from JSON format
$products = json_decode($order['cart'], true);

// Collect product ids
foreach ($products as $product) $ids[] = $product['id'];

// Get needed products from DB
$productsDB = R::findLike('products', ['id' => $ids]);

// Центральный шаблон для модуля
ob_start();
include ROOT . 'admin/templates/orders/single.tpl';
$content = ob_get_contents();
ob_end_clean();

// Шаблон страницы
include ROOT . 'admin/templates/template.tpl';
