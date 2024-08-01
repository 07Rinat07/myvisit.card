<?php

$pageTitle = "Блог - все записи";

if ( isset($uriGet) ) {

    // Выводим отдельный пост
    $post = R::load('posts', $uriGet);

    // Центральный шаблон для модуля
    ob_start();
    include ROOT . 'templates/blog/single-post.tpl';
    $content = ob_get_contents();
    ob_end_clean();



} else {

    // Количество постов на странице
    $results_per_page = 1;

    // Определяем текущий номер запрашиваемой страницы
    if (!isset($_GET['page'])) {
        $page_number = 1;
    } else {
        $page_number = intval($_GET['page']); // 2-я страница пагинации
    }

    // Определяем с какого поста начать вывод
    $starting_limit_number = ($page_number - 1) * $results_per_page; // (2-1)*6 = 6

    // Считаем количество страниц пагинации
    $number_of_results = R::count('posts'); // 18
    $number_of_pages = ceil($number_of_results / $results_per_page); // 18 постов / 6 постов на страницу = 3 страницы

    // Делаем запрос в БД для получения постов
    $posts = R::find('posts', "ORDER BY id DESC LIMIT {$starting_limit_number}, {$results_per_page}");

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