<?php

$product = R::load('products', $_GET['id']);

if (isset($_POST['submit'])) {

    // Удаление обложки
    if (!empty($product['cover'])) {
        $coverFolderLocation = ROOT . 'usercontent/products/';
        unlink($coverFolderLocation . $product->cover);
        unlink($coverFolderLocation . $product->cover_small);
    }

    R::trash($product);
    $_SESSION['success'][] = ['title' => 'Товар был удален'];
    header('Location:' . HOST . 'admin/shop');
    exit();
}

// Центральный шаблон для модуля
ob_start();
include ROOT . 'admin/templates/shop/delete.tpl';
$content = ob_get_contents();
ob_end_clean();

// Шаблон страницы
include ROOT . 'admin/templates/template.tpl';
