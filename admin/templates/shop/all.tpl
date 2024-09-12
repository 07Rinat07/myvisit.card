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
                <?php foreach ($products as $product) : ?>
                    <tr>
                        <td><?= $product['id'] ?></td>
                        <td>
                            <a href="<?php echo HOST . "admin/"; ?>shop-edit?id=<?= $product['id'] ?>">
                                <?= $product['title'] ?>
                            </a>
                        </td>
                        <td>
                            <a href="<?php echo HOST . "admin/"; ?>shop-delete?id=<?= $product['id'] ?>" class="icon-delete"></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>