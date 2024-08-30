<main>
    <div class="container">
        <section class="page-shopping-cart">
            <h1 class="page-shopping-cart__main-title">Корзина</h1>

            <?php include ROOT . "templates/components/errors.tpl"; ?>
            <?php include ROOT . "templates/components/success.tpl"; ?>
            
            <div class="page-shopping-cart__row-gray">
                <h2 class="page-shopping-cart__title">наименование</h2>
                <h2 class="page-shopping-cart__title">количество</h2>
                <h2 class="page-shopping-cart__title">стоимость</h2>
            </div>

            <?php foreach ($products as $product) : ?>
                <div class="page-shopping-cart__row">
                    <div class="page-shopping-cart__img">
                        <img src="<?= HOST ?>usercontent/products/<?= $product['cover_small']; ?>" alt="productName" />
                    </div>
                    <div class="page-shopping-cart__name">
                        <a href="<?= HOST; ?>shop/<?= $product['id']; ?>"><?= $product['title']; ?></a>
                    </div>
                    <div class="page-shopping-cart__id">
                        <?= $_SESSION['cart'][$product['id']] ?>
                    </div>
                    <div class="page-shopping-cart__money"><?= $product['price']; ?> руб.</div>
                    <div class="page-shopping-cart__delete">
                        <a href="<?= HOST; ?>removefromcart?id=<?= $product['id']; ?>"> <span class="leftright"></span><span class="rightleft"> </span></a>
                    </div>
                </div>
            <?php endforeach; ?>

            <div class="page-shopping-cart__row-down">
                <div class="page-shopping-cart__id"><?= $cartCount; ?> единицы</div>
                <div class="page-shopping-cart__money"><?= $cartTotalPrice; ?> руб.</div>
            </div><a class="page-shopping-cart__button" href="order-registration.html">Перейти к оформлению заказа</a>
        </section>
    </div>
</main>