<?php

use YooKassa\Client;

$client = new Client();
$client->setAuth(SHOP_ID, SECRET_KEY);

try {
    $payment = $client->createPayment(
        array(
            'amount' => array(
                'value' => $_SESSION['order']['price'],
                'currency' => 'RUB',
            ),
            'confirmation' => array(
                'type' => 'redirect',
                'return_url' => HOST . 'paymentyookassareturn',
            ),
            'capture' => true,
            'description' => 'Заказ №' . $_SESSION['order']['id'],
        ),
        uniqid('', true)
    );

    // получаем confirmationUrl для дальнейшего редиректа
    $confirmationUrl = $payment->getConfirmation()->getConfirmationUrl();

} catch (\Exception $e) {
    $response = $e;
}

// Создаем информацию о попытке платежа в БД
$paymentDB = R::dispense('payments');
$paymentDB->payment = $payment['id'];
$paymentDB->order_id = $_SESSION['order']['id'];
$paymentDB->price = $_SESSION['order']['price'];
$paymentDB->status = 'pending';
$paymentDB->timestamp = time();
$_SESSION['payment']['id'] = R::store($paymentDB);

// Редирект пользователя на форму оплаты
header('Location: ' . $confirmationUrl);
exit();