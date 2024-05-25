<?php

//$content = "Main page";

$page_name = "Главная страница";
$page_text = "Текст главной страницы. Lorem ipsum.........";

//Буферизация вывода
ob_start();
include ROOT . 'templates/main/main.tpl';
$content = ob_get_contents();
ob_end_clean();

include ROOT . 'templates/_parts/_header.tpl';
include ROOT . 'templates/template.tpl';
include ROOT . 'templates/_parts/_footer.tpl';

