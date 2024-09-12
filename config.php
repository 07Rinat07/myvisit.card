<?php

//DB Settings
define('DB_HOST', 'localhost');
define('DB_NAME', 'myvisit.card');
define('DB_USER', 'dev');
define('DB_PASS', 'newpassword');


if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
    $protocol = "https://";
} else {
    $protocol = "http://";
}


//host site для ссылок в браузере
define('HOST', $protocol . $_SERVER['HTTP_HOST'] .'/');

// физич путь к корневой директории скрипта
define('ROOT', dirname(__FILE__) . '/');

//Дополнительная настройка-на хостинге незабудь в адрес внести свой домен
define('SITE_NAME', 'Сайт Digital Nomad');
define('SITE_EMAIL', 'info@myvisit.card');

