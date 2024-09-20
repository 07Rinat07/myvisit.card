<main>
	<div class="container">

		<section class="page-product">

			<?php include ROOT . "templates/components/errors.tpl"; ?>
			<?php include ROOT . "templates/components/success.tpl"; ?>

			<div class="page-product__row">
				<div class="page-product__col">
					<div class="page-product__img">
						<img src="<?= HOST; ?>usercontent/products/<?= $product->cover; ?>" alt="<?= $product->title; ?>" />
					</div>
				</div>
				<div class="page-product__col">
					<div class="page-product__title">
						<h2 class="section-title"><?= $product->title; ?></h2>
					</div>
					<div class="page-product__price"><?= format_price($product['price']); ?> руб.</div>
					<a class="page-product__button primary-button" href="<?= HOST ?>addtocart?id=<?= $product->id; ?>">
						В корзину
					</a>
					<div class="page-product-text">
						<?= $product->content; ?>
					</div>
				</div>
			</div>

		</section>

		<?php
		if (count($relatedProducts) > 0) {
			include ROOT . "templates/shop/parts/_related.tpl";
		}
		?>


	</div>
</main>