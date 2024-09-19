<?php

require __DIR__ . '/vendor/autoload.php';

require_once "config.php";
require_once "db.php";
require_once ROOT . "./libs/resize-and-crop.php";
require_once ROOT . "./libs/functions.php";

$_SESSION['errors'] = array();
$_SESSION['success'] = array();

session_start();

require(ROOT . "modules/settings/settings.php");
require(ROOT . "modules/admin-panel/admin-panel.php");
require(ROOT . "modules/cart/usercart.php");

/* ..........................................

РОУТЕР // ROUTE - МАРШРУТ

............................................. */

$uriModule = getModuleName();
$uriGet = getUriGet();
$uriGetParam = getUriGetParam();

// Роутер
switch ($uriModule) {
    case '':
        require(ROOT . "modules/main/index.php");
        break;

    // ::::::::::::::::::: USERS :::::::::::::::::::

    case 'login':
        require ROOT . "modules/login/login.php";
        break;

    case 'registration':
        require ROOT . "modules/login/registration.php";
        break;

    case 'logout':
        require ROOT . "modules/login/logout.php";
        break;

    case 'lost-password':
        require ROOT . "modules/login/lost-password.php";
        break;

    case 'set-new-password':
        require ROOT . "modules/login/set-new-password.php";
        break;

    case 'profile':
        require ROOT . "modules/profile/profile.php";
        break;

    case 'profile-edit':
        require ROOT . "modules/profile/edit.php";
        break;

    case 'profile-order':
        require ROOT . "modules/profile/profile-order.php";
        break;

    // ::::::::::::::::::: OTHERS :::::::::::::::::::

    case 'about':
        require ROOT . "modules/about/index.php";
        break;

    // ::::::::::::::::::: BLOG :::::::::::::::::::

    case 'blog':
        // require ROOT . "modules/blog/index.php";

        if (isset($uriGet) && $uriGet === 'cat' && !empty($uriGetParam)) {
            require ROOT . "modules/blog/categories.php";
        } elseif (isset($uriGet)) {
            require ROOT . "modules/blog/single-post.php";
        } else {
            require ROOT . "modules/blog/all.php";
        }

        break;

    case 'add-comment':
        require ROOT . "modules/blog/add-comment.php";
        break;

    // ::::::::::::::::::: SHOP :::::::::::::::::::

    case 'shop':

        if (isset($uriGet)) {
            require ROOT . "modules/shop/product.php";
        } else {
            require ROOT . "modules/shop/catalog.php";
        }

        break;

    // ::::::::::::::::::: CART :::::::::::::::::::

    case 'cart':
        require ROOT . "modules/cart/cart.php";
        break;

    case 'addtocart':
        require ROOT . "modules/cart/addtocart.php";
        break;

    case 'removefromcart':
        require ROOT . "modules/cart/remove.php";
        break;

    // ::::::::::::::::::: ORDERS :::::::::::::::::::

    case 'neworder':
        require ROOT . "modules/orders/new.php";
        break;

    case 'ordercreated':
        require ROOT . "modules/orders/created.php";
        break;

    case 'orderselectpayment':
        require ROOT . "modules/orders/selectpayment.php";
        break;

    // ::::::::::::::::::: PAYMENTS :::::::::::::::::::

    case 'paymentyookassa':
        require ROOT . "modules/payments/yookassa.php";
        break;

    // ::::::::::::::::::: OTHER :::::::::::::::::::

    case 'contacts':
        require ROOT . "modules/contacts/index.php";
        break;

    default:
        require ROOT . "modules/main/index.php";
        break;
}