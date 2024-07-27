<?php

function updateUserandGoToProfile($user){
    if (isset($_POST['updateProfile'])) {

        global $errors;

        // Проверить поля на заполненность
        if (trim($_POST['name']) === '') {
            $errors[] = ['title' => 'Введите имя'];
        }
        if (trim($_POST['surname']) === '') {
            $errors[] = ['title' => 'Введите фамилию'];
        }
        if (trim($_POST['email']) === '') {
            $errors[] = ['title' => 'Введите Email'];
        }

        // Обновить инфу в БД
        if (empty($errors)) {
            $user->name = htmlentities($_POST['name']);
            $user->surname = htmlentities($_POST['surname']);
            $user->email = htmlentities($_POST['email']);
            $user->city = htmlentities($_POST['city']);
            $user->country = htmlentities($_POST['country']);

            R::store($user);
            $_SESSION['logged_user'] = $user;

            header('Location: ' . HOST . 'profile');
            exit();

        }
    }
}

// Проверка на что что юзер залогинен
if ( isset($_SESSION['login']) && $_SESSION['login'] === 1) {
    // Юзер залогинен

    // Проверка на роль Юзера (пользователь или админ)
    if ($_SESSION['logged_user']['role'] === 'user') {
        // Это обычный пользователь
        $user = R::load('users', $_SESSION['logged_user']['id']);
        // Обновляем данные пользователя, после оптравки формы
        updateUserandGoToProfile($user);

    } else if ($_SESSION['logged_user']['role'] === 'admin' ) {
        // Это Администратор сайта

        // Делаем проверку на дополнительный параметр - ID пользователя для редактирования

        if (isset($uriArray[1])) {
            // Редактирование чужого профиля
            // Загружаем данные о профиле
            $user = R::load('users', intval($uriArray[1]));

            // Обновляем данные пользователя, после оптравки формы
            updateUserandGoToProfile($user);

        } else {
            // Редактирование своего профиля
            $user = R::load('users', $_SESSION['logged_user']['id']);

            // Обновляем данные пользователя, после оптравки формы
            updateUserandGoToProfile($user);

        }








    }

} else {
    header('Location: ' . HOST . 'login');
    exit();
}

// Запрос данных из БД по Юзеру


$pageTitle = "Профиль пользователя";

// ob_start();
// include ROOT . 'templates/about/about.tpl';
// $content = ob_get_contents();
// ob_end_clean();

include ROOT . 'templates/_page-parts/_head.tpl';
include ROOT . 'templates/_parts/_header.tpl';

include ROOT . 'templates/profile/profile-edit.tpl';

include ROOT . 'templates/_parts/_footer.tpl';
include ROOT . 'templates/_page-parts/_foot.tpl';
