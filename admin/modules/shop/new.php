<?php

if (isset($_POST['submit'])) {

    // Проверка на заполненность - Заголовок
    if (trim($_POST['title']) == '') {
        $_SESSION['errors'][] = ['title' => 'Введите название'];
    }

    // Проверка на заполненность - Заголовок
    if (trim($_POST['price']) == '') {
        $_SESSION['errors'][] = ['title' => 'Введите цену'];
    }

    // Проверка на заполненность - Содержимое
    if (trim($_POST['content']) == '') {
        $_SESSION['errors'][] = ['title' => 'Заполните описание'];
    }

    if (empty($_SESSION['errors'])) {
        $product = R::dispense('products');
        $product->title = $_POST['title'];
        $product->price = $_POST['price'];
        $product->content = $_POST['content'];
        $product->timestamp = time();

        // Если передано изображение - уменьшаем, сохраняем, записываем в БД
        if (isset($_FILES['cover']['name']) && $_FILES['cover']['tmp_name'] !== '') {
            // Обрабатываем картинку, сохраняем, и получаем имя файла
            $coverFileName = saveUploadedImgNoCrop('cover', [600, 300], 12, 'products', [540, 380], [290, 230]);

            // Сохраняем имя файла в БД
            $product->cover = $coverFileName[0];
            $product->coverSmall = $coverFileName[1];
        }

        R::store($product);
        $_SESSION['success'][] = ['title' => 'Товар успешно добавлен'];
        header('Location: ' . HOST . 'admin/shop');
        exit();
    }

}

// Центральный шаблон для модуля
ob_start();
include ROOT . 'admin/templates/shop/new.tpl';
$content = ob_get_contents();
ob_end_clean();

// Шаблон страницы
include ROOT . 'admin/templates/template.tpl';
