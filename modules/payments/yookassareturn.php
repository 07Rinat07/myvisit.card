<?php

$pageTitle = "Результат оплаты заказа";


// Шаблоны
include ROOT . 'templates/_page-parts/_head.tpl';
include ROOT . 'templates/_parts/_header.tpl';
include ROOT . 'templates/payments/yookassareturn.tpl';
include ROOT . 'templates/_parts/_footer.tpl';
include ROOT . 'templates/_page-parts/_foot.tpl';



/*
Страница возврата
- Страница возврата, шаблон
- Проверка оплаты на странице возврата
- Запись в БД статуса оплаты на странице возврата
- Шаблоны для статуса оплаты на странице возврата
*/