<?php



echo "<pre>";
print_r($_SERVER);
echo "</pre>";



//host site
define('HOST', '//' . $_SERVER['HTTP_HOST'] .'/');

echo HOST;
