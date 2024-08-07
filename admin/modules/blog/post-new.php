<?php

if (isset($_POST['postSubmit'])) {

    // Проверка на заполненность - Заголовок
    if (trim($_POST['title']) == '') {
        $_SESSION['errors'][] = ['title' => 'Введите заголовок поста'];
    }

    // Проверка на заполненность - Содержимое
    if (trim($_POST['content']) == '') {
        $_SESSION['errors'][] = ['title' => 'Заполните содержимое поста'];
    }

    if (empty($_SESSION['errors'])) {
        $post = R::dispense('posts');
        $post->title = $_POST['title'];
        $post->content = $_POST['content'];
        $post->timestamp = time();


        // Если передано изображение - уменьшаем, сохраняем, записываем в БД
        $coverFileName = saveUploadedImg('cover', [600, 300], 12, 'blog', [1110, 460], [290, 230]);

        // Сохраняем имя файла в БД
        $post->cover = $coverFileName[0];
        $post->coverSmall = $coverFileName[1];

        R::store($post);
        $_SESSION['success'][] = ['title' => 'Пост успешно добавлен'];
        header('Location: ' . HOST . 'admin/blog');
        exit();
    }

}

// Центральный шаблон для модуля
ob_start();
include ROOT . 'admin/templates/blog/post-new.tpl';
$content = ob_get_contents();
ob_end_clean();

// Шаблон страницы
include ROOT . 'admin/templates/template.tpl';
