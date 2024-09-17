<main>
		<div class="container">
			<div class="order-registration">

				<div class="order-registration__title">
					<h2 class="section-title">Состав заказа</h2>
				</div>

				<table class="order-table">
					<thead>
						<tr>
							<th>ТОВАРЫ В ЗАКАЗЕ</th>
							<th>ТОВАРЫ В ЗАКАЗЕ</th>
							<th>стоимость</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<?php
									$i = 1;
									foreach ($products as $product) {
										if ($i !== count($products)) {
											echo $product['title'] . ', ';
										} else {
											echo $product['title'] . '.';
										}
										$i++;
									}
								?>
							</td>
							<td><?=$cartCount;?> шт.</td>
							<td><?=format_price($cartTotalPrice);?> руб.</td>
						</tr>
					</tbody>
				</table>

				<div class="order-registration__title">
					<h1 class="section-title">Оформить заказ</h1>
				</div>

				<form class="order-form" name="order-registration" action="<?=HOST?>neworder" method="POST">
					<div class="order-form__row">
						<label>
							<p class="order-form__name">Имя</p>

							<?php
								$value = null;
								if ( isset($_SESSION['logged_user']) && !empty($_SESSION['logged_user']['name'])){
									$value = 'value="' . $_SESSION['logged_user']['name'] . '"';
								}
							?>
							<input class="input-text" type="text" placeholder="Введите имя" id="form-title" name="name" <?=$value;?> />
						</label>

						<label>
							<?php
								$value = null;
								if ( isset($_SESSION['logged_user']) && !empty($_SESSION['logged_user']['surname'])){
									$value = 'value="' . $_SESSION['logged_user']['surname'] . '"';
								}
							?>
							<p class="order-form__name">Фамилия</p>
							<input class="input-text" type="text" placeholder="Введите фамилию" id="form-title" name="secondname" <?=$value;?> />
						</label>
					</div>

					<div class="order-form__row">
						<label>
							<?php
								$value = null;
								if ( isset($_SESSION['logged_user']) && !empty($_SESSION['logged_user']['email'])){
									$value = 'value="' . $_SESSION['logged_user']['email'] . '"';
								}
							?>
							<p class="order-form__name">Email</p>
							<input class="input-text" type="email" placeholder="Введите email" id="form-title" name="email" <?=$value;?> />
						</label>

						<label>
							<p class="order-form__name">Телефон</p>
								<input class="input-text" type="text" placeholder="Введите фамилию" id="form-title" name="phone" />
						</label>
					</div>

					<div class="order-form__row">
						<label>
							<p class="order-form__name">Адрес доставки</p>
							<textarea class="textarea" name="address" placeholder="Введите адрес доставки" title="Адрес доставки"></textarea>
						</label>
					</div>

					<div class="order-form__row order-form__row--justify-between">
						<button type="submit" name="submit" class="primary-button">Оформить заказ </button>
						<a class="secondary-button" href="./basket.html">Вернуться в корзину </a>
					</div>

				</form>

			</div>
		</div>
	</main>