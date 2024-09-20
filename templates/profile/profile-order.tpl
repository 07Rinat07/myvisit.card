<main class="page-profile">

    <div class="section">
        <div class="section__title">
            <div class="container">
                <h2 class="heading">Заказ</h2>
            </div>
        </div>
        <div class="section__body">
            <style>
                .order-table,
                .order-table th,
                .order-table td {
                    border: 1px solid #e3e3e3;
                    border-collapse: collapse;
                }

                .order-table th,
                .order-table td {
                    padding: 10px;
                }
            </style>

            <div class="container">
                <table class="order-table">

                    <tr>
                        <th>Дата создания</th>
                        <td><?php if ($order['timestamp']) echo rus_date("j F Y G:i", $order['timestamp']); ?></td>
                    </tr>
                    <tr>
                        <th>Статус</th>
                        <td><?= $order['status'] ?></td>
                    </tr>
                    <tr>
                        <th>Оплата</th>
                        <td>
                            <?php
                            if ($order['paid']) {
                                echo "Оплачен";
                            } else {
                                echo "Не оплачен<br>";
                                echo "<a class='secondary-button'>Оплатить</a>";
                            }
                            ?>

                        </td>
                    </tr>
                    <tr>
                        <th>Общая стоимость</th>
                        <td><?= number_format($order['price'], 2, ',', ' ') ?> руб.</td>
                    </tr>
                    <tr>
                        <th>Имя Фамилия</th>
                        <td><?= $order['name'] ?> <?= $order['secondname'] ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?= $order['email'] ?></td>
                    </tr>
                </table>



                <table class="order-table">
                    <tr>
                        <th></th>
                        <th>Наименование</th>
                        <th>Стоимость за ед.</th>
                        <th>Количество</th>
                    </tr>

                    <?php foreach ($products as $product) : ?>
                        <tr>
                            
                            <?php $img_path = HOST . "usercontent/products/" . $productsDB[$product['id']]['cover_small']; ?>
                            <td><img width="100" src="<?= $img_path ?>" /></td>

                            <td>
                                <a href="<? echo HOST . 'shop/' . $product['id']; ?>">
                                    <?= $product['title'] ?>
                                </a>
                            </td>
                            <td>
                                <?= number_format($product['price'], 2, ',', ' ') ?> руб.
                            </td>
                            <td><?= $product['amount'] ?></td>
                        </tr>
                    <?php endforeach; ?>

                </table>

                <a href="<?= HOST . 'profile' ?>">Назад в профиль</a>

            </div>

        </div>
    </div>


</main>