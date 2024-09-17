<?php

if (isLoggedIn()) {

    // Получаем пользователя из БД
    $user = R::load('users', $_SESSION['logged_user']['id']);

    // Получаем корзину из БД
    $cart = json_decode($user->cart, true);

    // Удаляем товар из корзины
    unset($cart[$_GET['id']]);

    // Превращаем корзину в JSON строку,
    // и записываем ее в поле cart для текущего пользователя
    $user->cart = json_encode($cart);

    // Обновляем состояние корзины в сессии
    $_SESSION['cart'] = $cart;

    // Обновляем пользователя в БД
    R::store($user);

    // Сообщение о удалении товара
    $_SESSION['success'][] = ['title' => 'Товар был удален из корзины'];
}

if(!isLoggedIn()){
    if (isset($_COOKIE['cart'])) {
        // Получаем корзину из COOKIE
        $cart = json_decode($_COOKIE['cart'], true);
    } else {
        $cart = array();
    }

    // 3. Удаляем товар из корзины
    unset($cart[$_GET['id']]);

    // 4. Сохранить корзину в COOKIE
    setcookie("cart", json_encode($cart), time() + 60 * 60 * 24 * 30);

    // 5. Сообщение о удалении товара
    $_SESSION['success'][] = ['title' => 'Товар был удален'];

}


header("Location: " . HOST . "cart");
exit();
