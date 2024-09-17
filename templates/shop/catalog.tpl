<main>
    <div class="container">
        <section class="shop">
            <div class="text-center">
                <h2 class="section-title">Магазин</h2>
            </div>
            <div class="shop-cards">
                <?php
                foreach ($products as $product) {
                    include ROOT . "templates/shop/parts/_card.tpl";
                }
                ?>
            </div>
            <?php include ROOT . "templates/_parts/pagination/_pagination.tpl" ?>
        </section>
    </div>
</main>