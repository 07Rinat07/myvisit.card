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


<main>
    <div class="container">
        <div class="order-registration">

            <div class="order-registration__title">
                <h1 class="heading">Оплата заказа №<?= $orderId ?></h1>
            </div>

            <table class="order-table">
                <tr>
                    <th>Дата создания</th>
                    <td><?php if ($order['timestamp']) echo rus_date("j F Y G:i", $order['timestamp']); ?></td>
                </tr>
                <tr>
                    <th>Общая стоимость</th>
                    <td><?= format_price($order['price']) ?> руб.</td>
                </tr>
            </table>

            <div class="order-registration__title">
                <h2 class="section-title">Способ оплаты</h2>
            </div>

            <div class="payment-methods">
                <a class="payment-yookassa" href="<?= HOST ?>paymentyookassa">
                    <img src="<?= HOST . './static/img/icons/YooKassa.svg' ?>" alt="Success">
                    <span>Оплатить через ЮКасса</span>
                </a>
            </div>

        </div>
    </div>
</main>