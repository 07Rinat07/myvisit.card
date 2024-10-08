<?php

$pageTitle = "Результат оплаты заказа";

// Получаем статус платежа из Юкассы
use YooKassa\Client;

$client = new Client();
$client->setAuth(SHOP_ID, SECRET_KEY);

try {
    $payment = $client->getPaymentInfo($_SESSION['payment']['yookassaid']);
} catch (\Exception $e) {
    $response = $e;
}

// Обновить информацию о платеже в БД
$paymentDB = R::load('payments', $_SESSION['payment']['id']);
$paymentDB->status = $payment['status'];
R::store($paymentDB);

// Обновить информацию в заказе
$order = R::load('orders', $paymentDB['order_id']);

switch($payment['status']) {
    case 'pending':
        $order->status = 'pending';
        $order->paid = false;
        break;
    case 'waiting_for_capture':
        $order->status = 'waiting';
        $order->paid = false;
        break;
    case 'succeeded':
        $order->status = 'paid';
        $order->paid = true;
        break;
    case 'canceled':
        $order->status = 'canceled';
        $order->paid = false;
        break;
    default:
        break;
}

R::store($order);

// Обновление страницы в ожидании платежа
if ($payment['status'] === 'pending' || $payment['status'] === 'waiting_for_capture') {
    header("Refresh: 5");
}

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
+ Обновить информацию в заказе: оплачен/не оплачен
+ Шаблоны для статуса оплаты на странице возврата
*/