<?php

if (isset($_POST['postEdit'])) {

    // Проверка на заполненность - Заголовок
    if (trim($_POST['title']) == '') {
        $_SESSION['errors'][] = ['title' => 'Введите заголовок поста'];
    }

    // Проверка на заполненность - Содержимое
    if (trim($_POST['content']) == '') {
        $_SESSION['errors'][] = ['title' => 'Заполните содержимое поста'];
    }

    if (empty($_SESSION['errors'])) {

        $post = R::load('posts', $_GET['id']);
        $post->title = $_POST['title'];
        $post->content = $_POST['content'];
        $post->editTime = time();

        // Удаление обложки
        if (isset($_POST['delete-cover']) && $_POST['delete-cover'] == 'on') {

            // Удалить файлы обложки
            $coverFolderLocation = ROOT . 'usercontent/blog/';
            // echo $coverFolderLocation . $post->cover_small;
            // die();
            unlink($coverFolderLocation . $post->cover);
            unlink($coverFolderLocation . $post->cover_small);

            // Удалить записи в БД
            $post->cover = NULL;
            $post->cover_small = NULL;
        }

        // Если передано изображение - уменьшаем, сохраняем, записываем в БД
        $coverFileName = saveUploadedImg('cover', [600, 300], 12, 'blog', [1110, 460], [290, 230]);

        // Если новое изображение успешно загружено тогда удаляем старое
        if ($coverFileName) {
            // Удаляем старое изображение
            unlink(ROOT . 'usercontent/blog/' . $post->cover);
            unlink(ROOT . 'usercontent/blog/' . $post->coverSmall);
        }

        // Сохраняем имя файла в БД
        $post->cover = $coverFileName[0];
        $post->coverSmall = $coverFileName[1];

        R::store($post);
        $_SESSION['success'][] = ['title' => 'Пост успешно обновлен'];

    }



}

$post = R::load('posts', $_GET['id']);

// Центральный шаблон для модуля
ob_start();
include ROOT . 'admin/templates/blog/post-edit.tpl';
$content = ob_get_contents();
ob_end_clean();

// Шаблон страницы
include ROOT . 'admin/templates/template.tpl';
