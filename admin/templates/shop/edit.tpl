<script src="<?php echo HOST; ?>libs/ckeditor/ckeditor.js"></script>

<div class="admin-page__content-form">

    <form enctype="multipart/form-data" class="admin-form" method="POST" action="<?= HOST ?>admin/shop-edit?id=<?= $product['id'] ?>">

        <?php include ROOT . 'admin/templates/components/errors.tpl'; ?>
        <?php include ROOT . 'admin/templates/components/success.tpl'; ?>

        <div class=" admin-form__item">
            <h2 class="heading">Редактировать товар</h2>
        </div>

        <div class="admin-form__item">
            <label class="input__label">
                Введите название товара
                <input name="title" class="input input--width-label" type="text" value="<?= $product['title'] ?>" />
            </label>
        </div>

        <div class="admin-form__item">
            <label class="input__label">
                Цена товара
                <input name="price" class="input input--width-label" type="text" value="<?= $product['price'] ?>" />
            </label>
        </div>

        <div class="admin-form__item">
            <label class="textarea__label mb-15" for="editor">Описание товара</label>
            <textarea name="content" class="textarea textarea--width-label" id="editor"><?= $product['content'] ?></textarea>

        </div>
        <div class="admin-form__item">
            <div class="block-upload">
                <div class="block-upload__description">
                    <div class="block-upload__title">Фотография товара:</div>
                    <p>Изображение jpg или png, рекомендуемая ширина 945px и больше, высота от 400px и более. Вес до 2Мб.</p>
                    <div class="block-upload__file-wrapper">
                        <input name="cover" class="file-button" type="file">
                    </div>
                </div>

                <?php if (!empty($product->cover)) :  ?>
                    <div class="block-upload__img mb-10">
                        <img src="<?= HOST ?>usercontent/products/<?= $product['cover_small'] ?>" alt="Загрузка картинки" />
                    </div>

                    <label class="checkbox__item">
                        <input class="checkbox__btn" type="checkbox" name="delete-cover"><span class="checkbox__label">Удалить обложку</span>
                    </label>
                <?php endif; ?>

            </div>

        </div>
        <div class="admin-form__item buttons">
            <button name="submit" class="primary-button" type="submit">Сохранить изменения</button>
            <a class="secondary-button" href="<?= HOST ?>admin/blog">Отмена</a>
        </div>
        <div class="admin-form__item"></div>
        <div class="admin-form__item"></div>
    </form>
</div>

<script>
    CKEDITOR.replace('editor', {
        filebrowserUploadMethod: 'form',
        filebrowserUploadUrl: '<?php echo HOST; ?>libs/ck-upload/upload.php'
    });
</script>