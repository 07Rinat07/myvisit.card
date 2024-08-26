<main>
	<div class="container">
		<section class="page-product">
			<div class="page-product__col">
				<div class="page-product__img">
					<img src="<?= HOST; ?>usercontent/products/<?= $product->cover; ?>" alt="<?= $product->title; ?>" />
				</div>
			</div>
			<div class="page-product__col">
				<div class="page-product__title">
					<h2 class="section-title"><?= $product->title; ?></h2>
				</div>
				<div class="page-product__price"><?= $product->price; ?> руб.</div>
				<a class="page-product__button primary-button" href="page-shopping-card.html">В корзину</a>
				<div class="page-product-text">
					<?= $product->content; ?>
				</div>
			</div>
		</section>

		<?php include ROOT . "templates/shop/parts/_related.tpl"; ?>

	</div>
</main>