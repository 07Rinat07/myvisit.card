<?php

$pageTitle = "Контакты";
// $pageClass = "";

if (isset($_POST['submit'])) {

    if (empty($_POST['name'])) {
        $_SESSION['errors'][] = ['title' => 'Введите имя'];
    }

    if (empty($_POST['email'])) {
        $_SESSION['errors'][] = ['title' => 'Введите email'];
    }

    if (empty($_POST['message'])) {
        $_SESSION['errors'][] = ['title' => 'Введите сообщение'];
    }

    if (empty($_SESSION['errors'])) {
        $message = R::dispense('messages');
        $message->name = htmlentities($_POST['name']);
        $message->email = htmlentities($_POST['email']);
        $message->message = htmlentities($_POST['message']);
        $message->time = time();
        R::store($message);
        $_SESSION['success'][] = ['title' => 'Сообщение отправлено успешно'];
    }
}

$contacts = R::load('contacts', 1);

include ROOT . 'templates/_page-parts/_head.tpl';
include ROOT . 'templates/_parts/_header.tpl';

include ROOT . 'templates/contacts/contacts.tpl';

include ROOT . 'templates/_parts/_footer.tpl';
include ROOT . 'templates/_page-parts/_foot.tpl';
