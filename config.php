<?php

//DB Settings
define('DB_HOST', 'localhost');
define('DB_NAME', 'myvisit.card');
define('DB_USER', 'dev');
define('DB_PASS', 'newpassword');


// YOOKASSA SETTINGS
define('SHOP_ID', '232314');
define('SECRET_KEY', 'test_NvYVqsG_bETsqB2gzw0No7i_Bl9sw8GZjHIRjB-SZmU');



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

