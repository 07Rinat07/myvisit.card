<section>
    <div class="page-product__section-title">
        <h2 class="section-title">Смотрите также</h2>
    </div>
    <div class="page-product__cards">

        <?php foreach ($relatedProducts as $product) : ?>
            <?php include ROOT . 'templates/shop/parts/_card.tpl' ?>
        <?php endforeach; ?>

    </div>
</section>