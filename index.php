<?php
require_once "config.php";

// ROUTE
$uri = $_SERVER["REQUEST_URI"];
$uri = rtrim($uri, "/");
$uri = filter_var($uri, FILTER_SANITIZE_URL);
$uri = substr($uri, 1);
$uri = explode('?', $uri);

print_r($uri);

switch ($uri[0]){
    case '':
        echo "Main page";
        break;
    case 'about':
        echo "About me";
        break;
    case 'blog':
        echo "Blog";
        break;
    case 'contacts':
        echo "Contact page";
        break;
    default:
        echo "Main or 404";
        break;
}