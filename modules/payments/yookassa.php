<?php

use YooKassa\Client;

$client = new Client();
$client->setAuth(SHOP_ID, SECRET_KEY);

try {
    $payment = $client->createPayment(
        array(
            'amount' => array(
                'value' => 350.0,
                'currency' => 'RUB',
            ),
            'confirmation' => array(
                'type' => 'redirect',
                'return_url' => HOST . 'shop',
            ),
            'capture' => true,
            'description' => 'Заказ №3',
        ),
        uniqid('', true)
    );

    $confirmationUrl = $payment->getConfirmation()->getConfirmationUrl();

} catch (\Exception $e) {
    $response = $e;
}

// Редирект пользователя на форму оплаты
header('Location: ' . $confirmationUrl);
exit();