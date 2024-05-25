<?php
require_once "config.php";

// ROUTE

//Обработка запроса
$uri = $_SERVER["REQUEST_URI"];
$uri = rtrim($uri, "/");
$uri = filter_var($uri, FILTER_SANITIZE_URL);
$uri = substr($uri, 1);
$uri = explode('?', $uri);

//print_r($uri);

//Роутер
switch ($uri[0]){
    case '':
        require ROOT . "modules/main/index.php";
        break;
    case 'about':
        require ROOT . "modules/about/index.php";
        break;
    case 'blog':
        require ROOT . "modules/blog/index.php";
        break;
    case 'contacts':
        require ROOT . "modules/contacts/index.php";
        break;
    default:
        require ROOT . "modules/main/index.php";
        break;
}