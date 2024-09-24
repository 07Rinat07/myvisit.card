<?php

$pageTitle = "Результат оплаты заказа";

// YooKassa ID платежа
$paymentId = $_SESSION['payment']['yookassaid'];

// Получем статус платежа из Юкассы
use YooKassa\Client;

$client = new Client();
$client->setAuth(SHOP_ID, SECRET_KEY);

try {
    $payment = $client->getPaymentInfo($paymentId);
} catch (\Exception $e) {
    $response = $e;
}

// Обновить информацию о платеже в БД
$paymentDB = R::load('payments', $_SESSION['payment']['id']);
$paymentDB->status = $payment['status'];
R::store($paymentDB);

// Шаблоны
include ROOT . 'templates/_page-parts/_head.tpl';
include ROOT . 'templates/_parts/_header.tpl';
include ROOT . 'templates/payments/yookassareturn.tpl';
include ROOT . 'templates/_parts/_footer.tpl';
include ROOT . 'templates/_page-parts/_foot.tpl';

/*
Страница возврата
+ Страница возврата, шаблон
+ Получить статус платежа из Юкассы
+ Запись статуса оплаты в БД
- Шаблоны для статуса оплаты на странице возврата
*/