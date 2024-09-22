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
                'return_url' => HOST . 'shop',
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

// Редирект пользователя на форму оплаты
header('Location: ' . $confirmationUrl);
exit();