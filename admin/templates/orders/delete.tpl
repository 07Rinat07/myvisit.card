<div class="admin-page__content-form">

    <form class="admin-form" method="POST" action="<?= HOST ?>admin/order-delete?id=<?= $order['id'] ?>">

        <?php include ROOT . 'admin/templates/components/errors.tpl'; ?>
        <?php include ROOT . 'admin/templates/components/success.tpl'; ?>

        <div class="admin-form__item">
            <h2 class="heading">Удалить заказ</h2>
        </div>
        <div class="admin-form__item">
            <p>Вы действительно хотите удалить заказ <strong>"<?= $order['id'] ?>"</strong>?</p>
        </div>
        <div class="admin-form__item buttons">
            <button name="submit" class="primary-button primary-button--red" type="submit">Удалить</button>
            <a class="secondary-button" href="<?= HOST ?>admin/orders">Отмена</a>
        </div>
        <div class="admin-form__item"></div>
        <div class="admin-form__item"></div>
    </form>
</div>