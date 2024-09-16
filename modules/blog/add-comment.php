<?php
session_start(); // Убедитесь, что сессии запущены

// Проверка на авторизацию пользователя
if (isset($_SESSION['login']) && $_SESSION['login'] === 1) {

    // Проверка на отправку формы
    if (isset($_POST['submit'])) {

        // Массив для хранения ошибок
        $_SESSION['errors'] = [];

        // Проверка на наличие ID поста
        if (!isset($_POST['id']) || empty(trim($_POST['id']))) {
            $_SESSION['errors'][] = ['title' => 'Отсутствует параметр id. Невозможно добавить комментарий'];
        }

        // Проверка на текст комментария
        if (!isset($_POST['comment']) || empty(trim($_POST['comment']))) {
            $_SESSION['errors'][] = ['title' => 'Комментарий не может быть пустым'];
        } elseif (mb_strlen(trim($_POST['comment'])) < 3) {
            $_SESSION['errors'][] = ['title' => 'Комментарий должен содержать не менее 3 символов'];
        }

        // Если ошибок нет, сохраняем комментарий
        if (empty($_SESSION['errors'])) {
            // Используем RedBean для создания нового комментария
            $comment = R::dispense('comments');
            $comment->text = trim($_POST['comment']); // Обрезаем лишние пробелы
            $comment->post = intval($_POST['id']); // Преобразуем ID в целое число для безопасности
            $comment->user = $_SESSION['logged_user']['id']; // ID пользователя из сессии
            $comment->timestamp = time(); // Текущая временная метка

            // Сохраняем комментарий в базе данных
            R::store($comment);

            // Перенаправляем пользователя обратно на страницу с комментариями
            header("Location: " . HOST . "blog/" . $_POST['id'] . '#comments');
            exit(); // Завершаем выполнение скрипта после редиректа
        } else {
            // Если есть ошибки, перенаправляем на форму с комментариями
            header("Location: " . HOST . "blog/" . $_POST['id'] . '#comments-form');
            exit();
        }
    }
} else {
    // Если пользователь не авторизован, перенаправляем на главную страницу
    header("Location: " . HOST);
    exit(); // Завершаем выполнение скрипта после редиректа
}
