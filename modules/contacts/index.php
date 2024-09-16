<?php

$pageTitle = "Контакты";

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
        $message->status = 'new';

        // Проверяем наличие файла и его корректность
        if (isset($_FILES['file']['name']) && $_FILES['file']['tmp_name'] !== '') {
            $file = saveUploadedFile('file', 12, 'contact-form');
            if ($file !== false && is_array($file) && count($file) == 2) {
                $message->fileNameSrc = $file[0];
                $message->fileNameOriginal = $file[1];
            } else {
                $_SESSION['errors'][] = ['title' => 'Ошибка при загрузке файла'];
            }
        }

        // Сохраняем сообщение, только если ошибок не было
        if (empty($_SESSION['errors'])) {
            R::store($message);
            $_SESSION['success'][] = ['title' => 'Сообщение отправлено успешно'];
        }
    }
}

// Получаем массив с нужными настройками
$settingsContacts = R::find('settings', ' section LIKE ? ', ['contacts']);

// Формируем массив для вывода в шаблон
$contacts = [];
foreach ($settingsContacts as $value) {
    $contacts[$value['name']] = $value['value'];
}

include ROOT . 'templates/_page-parts/_head.tpl';
include ROOT . 'templates/_parts/_header.tpl';

include ROOT . 'templates/contacts/contacts.tpl';

include ROOT . 'templates/_parts/_footer.tpl';
include ROOT . 'templates/_page-parts/_foot.tpl';
?>
