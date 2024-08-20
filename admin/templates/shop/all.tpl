<div class="admin-page__content-form">
    <div class="admin-form" style="width: 900px;">

        <?php include ROOT . 'admin/templates/components/errors.tpl'; ?>
        <?php include ROOT . 'admin/templates/components/success.tpl'; ?>

        <div class="admin-form__item d-flex justify-content-between mb-20">
            <h2 class="heading">Магазин - все товары</h2>
            <a class="secondary-button" href="<?= HOST ?>admin/shop-new">Добавить товар</a>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php /* foreach ($posts as $post) : ?>
                    <tr>
                        <td><?= $post['id'] ?></td>
                        <td><a href="<?php echo HOST . "admin/"; ?>post-edit?id=<?= $post['id'] ?>"><?= $post['title'] ?></a></td>
                        <td>
                            <a href="<?php echo HOST . "admin/"; ?>post-delete?id=<?= $post['id'] ?>" class="icon-delete"></a>
                        </td>
                    </tr>
                <?php endforeach; */ ?>
            </tbody>
        </table>
    </div>
</div>