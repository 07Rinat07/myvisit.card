<?php

try {
    $source = file_get_contents('php://input');
    $data = json_decode($source, true);

    // Записываем полученные данные в файл. Для отладки
    $file = "yookassanotify.txt";
    $res = date('[Y-m-d H:i:s] ') . PHP_EOL;
    $res .= $source . PHP_EOL . PHP_EOL;
    $res .=  "\r\n \r\n";
    file_put_contents($file, $res, FILE_APPEND | LOCK_EX);

    // Создание объекта для обработки полученной информации
    $factory = new \YooKassa\Model\Notification\NotificationFactory();
    $notificationObject = $factory->factory($data);
    $responseObject = $notificationObject->getObject();

    // Проверка подлинности ответа по списку доверенных IP адресов
    $client = new \YooKassa\Client();

    if (!$client->isNotificationIPTrusted($_SERVER['REMOTE_ADDR'])) {
        header('HTTP/1.1 400 Something went wrong');
        exit();
    }

    /*
    if ($notificationObject->getEvent() === \YooKassa\Model\Notification\NotificationEventType::PAYMENT_SUCCEEDED) {
        $someData = [
            'paymentId' => $responseObject->getId(),
            'paymentStatus' => $responseObject->getStatus(),
        ];
        // Специфичная логика
        // ...
    } elseif ($notificationObject->getEvent() === \YooKassa\Model\Notification\NotificationEventType::PAYMENT_WAITING_FOR_CAPTURE) {
        $someData = [
            'paymentId' => $responseObject->getId(),
            'paymentStatus' => $responseObject->getStatus(),
        ];
        // Специфичная логика
        // ...
    } elseif ($notificationObject->getEvent() === \YooKassa\Model\Notification\NotificationEventType::PAYMENT_CANCELED) {
        $someData = [
            'paymentId' => $responseObject->getId(),
            'paymentStatus' => $responseObject->getStatus(),
        ];
        // Специфичная логика
        // ...
    } elseif ($notificationObject->getEvent() === \YooKassa\Model\Notification\NotificationEventType::REFUND_SUCCEEDED) {
        $someData = [
            'refundId' => $responseObject->getId(),
            'refundStatus' => $responseObject->getStatus(),
            'paymentId' => $responseObject->getPaymentId(),
        ];
        // ...
        // Специфичная логика
    } else {
        header('HTTP/1.1 400 Something went wrong');
        exit();
    }
    */

} catch (Exception $e) {
    header('HTTP/1.1 400 Something went wrong');
    exit();
}