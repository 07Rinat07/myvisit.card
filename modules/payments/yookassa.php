<?php

use YooKassa\Client;

$client = new Client();
$client->setAuth(SHOP_ID, SECRET_KEY);

try {
    $response = $client->me();
} catch (\Exception $e) {
    $response = $e;
}

var_dump($response);

// Подключение к YooKassa через SDK. Получение информации о магазине

