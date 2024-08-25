<?php

$product = R::load('products', $uriGet);
$pageTitle = $product->title;

// Комментарии
// $sqlQueryComments = 'SELECT comments.text, comments.user, comments.timestamp,
//                             users.name, users.surname, users.avatar_small
//                         FROM `comments` LEFT JOIN `users` ON comments.user = users.id
//                         WHERE comments.post = ?';
// $comments = R::getAll($sqlQueryComments, [$post['id']]);

// Вывод похожих постов
// $relatedPosts = get_related_posts($post['title']);

// Центральный шаблон для модуля
include ROOT . 'templates/_page-parts/_head.tpl';
include ROOT . 'templates/_parts/_header.tpl';
include ROOT . 'templates/shop/product.tpl';
include ROOT . 'templates/_parts/_footer.tpl';
include ROOT . 'templates/_page-parts/_foot.tpl';
