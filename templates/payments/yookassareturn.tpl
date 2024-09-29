<style>
    .loader-wrapper {
        display: flex;
        justify-content: center;
        padding: 0px 0 20px;
    }
</style>

<main>
    <div class="container">
        <div class="order-registration">

            <div class="order-registration__title">
                <h1 class="heading">Результат оплаты заказа №<?= $paymentDB['order_id']?></h1>
            </div>

            <div class="loader-wrapper">
                <img width="48" src="<?= HOST . './static/img/icons/done.svg' ?>" alt="Success">
            </div>
            <p style="text-align: center; color: #2caf85;">Вы сделали попытку платежа</p>

            <div style="text-align: center;">
                <a href="<?= HOST ?>shop">Вернуться в магазин</a>
            </div>

        </div>
    </div>
</main>