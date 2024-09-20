<?php

$product = R::load('products', $uriGet);
$pageTitle = $product->title;

// Вывод похожих товаров
$relatedProducts = get_related($product['title'], 'products', $product->id);

// Центральный шаблон для модуля
include ROOT . 'templates/_page-parts/_head.tpl';
include ROOT . 'templates/_parts/_header.tpl';
include ROOT . 'templates/shop/product.tpl';
include ROOT . 'templates/_parts/_footer.tpl';
include ROOT . 'templates/_page-parts/_foot.tpl';
