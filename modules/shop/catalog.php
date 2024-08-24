<?php

$pageTitle = "Каталог товаров";

/*
$pagination = pagination(6, 'posts');

// Выводим все посты
$posts = R::find('posts', 'ORDER BY id DESC ' . $pagination['sql_pages_limit']);
*/

// Шаблоны
include ROOT . 'templates/_page-parts/_head.tpl';
include ROOT . 'templates/_parts/_header.tpl';
include ROOT . 'templates/shop/catalog.tpl';
include ROOT . 'templates/_parts/_footer.tpl';
include ROOT . 'templates/_page-parts/_foot.tpl';
