<div class="admin-page__content-form">

    <form class="admin-form" method="POST" action="<?= HOST ?>admin/shop-delete?id=<?= $product['id'] ?>">

        <?php include ROOT . 'admin/templates/components/errors.tpl'; ?>
        <?php include ROOT . 'admin/templates/components/success.tpl'; ?>

        <div class="admin-form__item">
            <h2 class="heading">Удалить товар</h2>
        </div>
        <div class="admin-form__item">
            <p><strong>Вы действительно хотите удалить товар?</strong></p>
            <p><strong>id:</strong>
                <?= $product['id'] ?>
            </p>
            <p><strong>Название:</strong>
                <?= $product['title'] ?>
            </p>
        </div>

        <div class="admin-form__item buttons">
            <button name="submit" class="primary-button primary-button--red" type="submit">Удалить</button>
            <a class="secondary-button" href="<?= HOST ?>admin/blog">Отмена</a>
        </div>
    </form>
</div>