<?php

$order = R::load('orders', $_GET['id']);

if (isset($_POST['submit'])) {
    R::trash($order);
    $_SESSION['success'][] = ['title' => 'Заказ был удален'];
    header('Location:' . HOST . 'admin/orders');
    exit();
}

// Центральный шаблон для модуля
ob_start();
include ROOT . 'admin/templates/orders/delete.tpl';
$content = ob_get_contents();
ob_end_clean();

// Шаблон страницы
include ROOT . 'admin/templates/template.tpl';
