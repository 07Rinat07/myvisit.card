<div class="admin-page__content-form">

    <form class="admin-form" method="POST" action="<?= HOST ?>admin/category-edit?id=<?= $cat['id'] ?>">

        <?php include ROOT . 'admin/templates/components/errors.tpl'; ?>
        <?php include ROOT . 'admin/templates/components/success.tpl'; ?>

        <div class="admin-form__item">
            <h2 class="heading">Сообщение <?= $message['id'] ?></h2>
        </div>


        <div class="admin-form__item">
            <label class="input__label mb-10">
                Время отправления
            </label>
            <p><?php echo rus_date("j.m.Y H:i", $message['time']); ?></p>
        </div>


        <div class="admin-form__item">
            <label class="input__label mb-10">
                Имя отправителя
            </label>
            <p><?= $message['name'] ?></p>
        </div>

        <div class="admin-form__item">
            <label class="input__label mb-10">
                Email отправителя
            </label>
            <p><?= $message['email'] ?></p>
        </div>

        <div class="admin-form__item">
            <label class="input__label mb-10">
                Текст сообщения
            </label>
            <?= $message['message'] ?>
        </div>

        <div class="admin-form__item">
            <label class="input__label mb-10">
                Прикреплённый файл
            </label>
            <p>photo.jpg</p>
        </div>

        <div class="admin-form__item buttons justify-content-between">
            <a class="secondary-button" href="<?= HOST ?>admin/messages">Вернуться назад</a>
            <button name="submit" class="primary-button primary-button--red" type="submit">Удалить</button>
        </div>
        <div class="admin-form__item"></div>
        <div class="admin-form__item"></div>
    </form>
</div>