<?php

$pageTitle = "Регистрация";

ob_start();
include ROOT . 'templates/login/form-registration.tpl';
$content = ob_get_contents();
ob_end_clean();

include ROOT . 'templates/_page-parts/_head.tpl';
include ROOT . 'templates/login/login-page.tpl';
include ROOT . 'templates/_page-parts/_foot.tpl';



