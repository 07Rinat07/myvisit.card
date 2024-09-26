<?php

echo 'yookassanotifications.php';

// Записываем полученные данные в файл. Для отладки
$file = "yookassanotify.txt";
$res = date('[Y-m-d H:i:s] ') . PHP_EOL;
$res .=  "\r\n \r\n";
file_put_contents($file, $res, FILE_APPEND | LOCK_EX);