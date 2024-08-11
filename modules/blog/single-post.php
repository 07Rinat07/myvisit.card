<?php

$pageTitle = "Блог - все записи";

// Одиночный пост
// Выводим отдельный пост
// $post = R::load('posts', $uriGet);

$sqlQuery = 'SELECT
                    posts.id, posts.title, posts.content,
                    posts.cover, posts.timestamp, posts.edit_time, posts.cat,
                    categories.title AS cat_title
                FROM `posts`
                LEFT JOIN `categories` ON posts.cat = categories.id
                WHERE posts.id = ? LIMIT 1';

$post = R::getRow($sqlQuery, [$uriGet]);

// Кнопки Назад и Вперед
$postsId = R::getCol('SELECT id FROM posts');
foreach ($postsId as $index => $value) {
    if ($post['id'] == $value) {
        $nextId = array_key_exists($index + 1, $postsId) ? $postsId[$index + 1] : null;
        $prevId = array_key_exists($index - 1, $postsId) ? $postsId[$index - 1] : null;
    }
}

// Комментарии
$sqlQueryComments = 'SELECT comments.text, comments.user, comments.timestamp,
                            users.name, users.surname, users.avatar_small
                        FROM `comments` LEFT JOIN `users` ON comments.user = users.id WHERE comments.post = ?';
$comments = R::getAll($sqlQueryComments, [$post['id']]);

// Вывод похожих постов
$wordsArray = explode(' ', $post['title']);
$wordsArray = array_unique($wordsArray);

// Массив со стоп словами (предлоги, союзы, можно добавить другие "общие" слова)
$stopWords = ['и', 'на', 'в', 'а', 'под', 'если', 'за', '-', 'что', 'самом', 'деле', 'означает'];

// Новый обработанный массив
$newWordsArray = array();

foreach ($wordsArray as $word){

    // переводим в нижний регистр
    $word = mb_strtolower($word);

    // Удаляем кавычки и лишние символы
    $word = str_replace('"', "", $word);
    $word = str_replace("'", "", $word);
    $word = str_replace("»", "", $word);
    $word = str_replace("«", "", $word);
    $word = str_replace(",", "", $word);
    $word = str_replace(".", "", $word);

    // Проверяем наличие слова в стоп списке
    if ( !in_array($word, $stopWords) ) {

        // Обрезаем окончания
        if (mb_strlen($word) > 4) {
            $word = mb_substr($word, 0, -2);
        } else if (mb_strlen($word) > 3) {
            $word = mb_substr($word, 0, -1);
        }

        // Добавляем символ шаблона
        $word = '%' . $word . '%';

        // Добавляем слова в новый массив
        $newWordsArray[] = $word;
    }
}

// print_r($newWordsArray);

// SQL запрос который нужно сформировать
// $relatedPosts = R::getAll('SELECT * FROM `posts` WHERE title LIKE ? OR title LIKE ?', ['%Москва%', '%Ford%']);

$sqlQuery = 'SELECT * FROM `posts` WHERE ';

for ($i = 0; $i < count($newWordsArray); $i++) {
    if ($i + 1 == count($newWordsArray)) {
        // Последний цикл
        $sqlQuery .= 'title LIKE ?';
    } else {
        $sqlQuery .= 'title LIKE ? OR ';
    }
}

$sqlQuery .= ' order by RAND() LIMIT 3';

// echo $sqlQuery;
// die();

$relatedPosts = R::getAll($sqlQuery, $newWordsArray);

print_r($relatedPosts);
die();

// Центральный шаблон для модуля
ob_start();
include ROOT . 'templates/blog/single-post.tpl';
$content = ob_get_contents();
ob_end_clean();

// Центральный шаблон для модуля
include ROOT . 'templates/_page-parts/_head.tpl';
include ROOT . 'templates/_parts/_header.tpl';
include ROOT . 'templates/blog/index.tpl';
include ROOT . 'templates/_parts/_footer.tpl';
include ROOT . 'templates/_page-parts/_foot.tpl';
