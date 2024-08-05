<?php

$pageTitle = "Блог - все записи";

if (isset($uriGet)) {

    // Если запрос постов из определенной катгории
    if ($uriGet === 'cat') {

        if (!empty($uriGetParam)) {

            $pagination = pagination(6, 'posts', [' cat = ? ', [4]]);
            $posts  = R::findLike('posts', ['cat' => [$uriGetParam]], 'ORDER BY id DESC ' . $pagination['sql_pages_limit'] );

            // Центральный шаблон для модуля
            ob_start();
            include ROOT . 'templates/blog/all-posts.tpl';
            $content = ob_get_contents();
            ob_end_clean();
        }

    } else {
        // Одиночный пост

        // Выводим отдельный пост
        // $post = R::load('posts', $uriGet);

        $sqlQuery = 'SELECT
                    posts.id, posts.title, posts.content,
                    posts.cover, posts.timestamp, posts.edit_time, posts.cat,
                    categories.cat_title
                FROM `posts`
                LEFT JOIN `categories` ON posts.cat = categories.id
                WHERE posts.id = ' . $uriGet . ' LIMIT 1';

        $post = R::getRow($sqlQuery);

        // Центральный шаблон для модуля
        ob_start();
        include ROOT . 'templates/blog/single-post.tpl';
        $content = ob_get_contents();
        ob_end_clean();

    } // END OF Одиночный пост

} else {

    $pagination = pagination(6, 'posts');

    // Выводим все посты
    $posts = R::find('posts', 'ORDER BY id DESC ' . $pagination['sql_pages_limit']);

    // Центральный шаблон для модуля
    ob_start();
    include ROOT . 'templates/blog/all-posts.tpl';
    $content = ob_get_contents();
    ob_end_clean();
}

// Центральный шаблон для модуля
include ROOT . 'templates/_page-parts/_head.tpl';
include ROOT . 'templates/_parts/_header.tpl';
include ROOT . 'templates/blog/index.tpl';
include ROOT . 'templates/_parts/_footer.tpl';
include ROOT . 'templates/_page-parts/_foot.tpl';
