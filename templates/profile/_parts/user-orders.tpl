<!-- Заказы пользователя -->
<div class="section bg-grey">
    <div class="container">
        <div class="section__title">
            <h2 class="heading">Мои заказы</h2>
        </div>
        <div class="section__body">
            <div class="row justify-content-center">
                <div class="col-md-10">

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Дата</th>
                                <th>Статус</th>
                                <th>Оплата</th>
                                <th>Стоимость</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orders as $order) : ?>
                                <?php include(ROOT . '/templates/profile/_parts/_order-small.tpl'); ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- // Комментарии пользователя -->