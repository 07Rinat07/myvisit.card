<?php


if (isset($_POST['submit'])) {

    // Проверка на заполненность - Заголовок
    if (trim($_POST['title']) == '') {
        $_SESSION['errors'][] = ['title' => 'Введите заголовок'];
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

        $product = R::load('products', $_GET['id']);
        $product->title = $_POST['title'];
        $product->price = $_POST['price'];
        $product->content = $_POST['content'];
        $product->editTime = time();

        // Удаление обложки
        if (isset($_POST['delete-cover']) && $_POST['delete-cover'] == 'on') {

            // Удалить файлы обложки
            $coverFolderLocation = ROOT . 'usercontent/products/';

            // Удалить файл с диска
            if (file_exists(ROOT . 'usercontent/products/' . $product->cover) && !empty($product->cover)) {
                unlink(ROOT . 'usercontent/products/' . $product->cover);
            }

            // Удалить файл с диска
            if (file_exists(ROOT . 'usercontent/products/' . $product->coverSmall) && !empty($product->cover)) {
                unlink(ROOT . 'usercontent/products/' . $product->coverSmall);
            }

            // Удалить запись в БД
            $product->cover = NULL;
            $product->cover_small = NULL;

        }

        // Если передано изображение - уменьшаем, сохраняем, записываем в БД
        if (isset($_FILES['cover']['name']) && $_FILES['cover']['tmp_name'] !== '') {
            // Обрабатываем картинку, сохраняем, и получаем имя файла
            $coverFileName = saveUploadedImgNoCrop('cover', [600, 300], 12, 'products', [540, 380], [290, 230]);

            // Если новое изображение успешно загружено тогда удаляем старое
            if ($coverFileName) {
                // Удаляем старое изображение
                if (file_exists(ROOT . 'usercontent/products/' . $product->cover) && !empty($product->cover)) {
                    unlink(ROOT . 'usercontent/products/' . $product->cover);
                }
                if (file_exists(ROOT . 'usercontent/products/' . $product->coverSmall)&& !empty($product->cover)) {
                    unlink(ROOT . 'usercontent/products/' . $product->coverSmall);
                }
            }

            // Сохраняем имя файла в БД
            $product->cover = $coverFileName[0];
            $product->coverSmall = $coverFileName[1];
        }

        R::store($product);
        $_SESSION['success'][] = ['title' => 'Продукт успешно обновлен'];
    }
}

$product = R::load('products', $_GET['id']);


// Центральный шаблон для модуля
ob_start();
include ROOT . 'admin/templates/shop/edit.tpl';
$content = ob_get_contents();
ob_end_clean();

// Шаблон страницы
include ROOT . 'admin/templates/template.tpl';
