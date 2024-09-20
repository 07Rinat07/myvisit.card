<a class="card-product" href="<?php echo HOST . "shop/{$product['id']}"; ?>">
    <div class="card-product__img">
        <img src="<?= HOST ?>usercontent/products/<?php echo empty($product['cover_small']) ? 'no-photo.jpg' : $product['cover_small']; ?>" alt="<?= $product['title'] ?>" />
    </div>
    <div class="card-product__title"><?= $product['title'] ?></div>
    <div class="card-product-row">
        <div class="card-product__price"> <span><?= format_price($product['price'])  ?> руб.</span></div>
        <div class="card-product__button">
            <div class="watch-button">Смотреть</div>
        </div>
    </div>
</a>