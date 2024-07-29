<main class="page-profile">

    <!-- Если пользователь открывает profile и не залогинился -->
    <?php if (isset($userNotLoggedIn)) : ?>
        <div class="section">
            <div class="container">
                <div class="section__title">
                    <h2 class="heading mb-25">Профиль пользователя</h2>
                    <p>Чтобы посмотреть свой профиль
                        <a href="<?= HOST ?>login">войдите</a>
                        либо
                        <a href="<?= HOST ?>registration">зарегистрируйтесь</a>.</p>
                </div>
            </div>
        </div>
        <!-- Если пользователь с таким ID не существует -->
    <?php elseif ($user['id'] === 0) : ?>
        <div class="section">
            <div class="container">
                <div class="section__title">
                    <h2 class="heading mb-25">Такого пользователя не существует</h2>
                    <p><a href="<?= HOST ?>">Вернуться на главную</a>.</p>
                </div>
            </div>
        </div>
        <!-- Если пользователь НАЙДЕН -->
    <?php else : ?>
        <div class="section">
            <div class="container">
                <div class="section__title">
                    <h2 class="heading">Профиль пользователя </h2>
                </div>
                <div class="section__body">

                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <?php include ROOT . "templates/components/errors.tpl"; ?>
                            <?php include ROOT . "templates/components/success.tpl"; ?>
                        </div>
                    </div>

                    <?php if (empty($user->name)) : ?>

                        <!-- Профиль пуст -->
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="enter-or-reg">
                                    <div class="enter-or-reg__text">
                                        😐 Пустой профиль
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php else : ?>

                        <!-- Профиль заполнен -->
                        <div class="row justify-content-center">
                            <div class="col-md-2">

                                <div class="avatar-big">
                                    <img src="<?= HOST ?>static/img/section-about-me/img-01.jpg" alt="Аватарка" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="definition-list mb-20">

                                    <?php if (!empty($user->name)) : ?>
                                        <dl class="definition">
                                            <dt class="definition__term">имя и фамилия</dt>
                                            <dd class="definition__description"> <?= $user->name ?> <?= $user->surname ?></dd>
                                        </dl>
                                    <?php endif; ?>

                                    <?php if (!empty($user->country) || !empty($user->city)) : ?>
                                        <dl class="definition">
                                            <dt class="definition__term">

                                                <?php if (!empty($user->country)) : ?>
                                                    Страна
                                                <?php endif; ?>

                                                <?php if (!empty($user->country) && !empty($user->city)) : ?>
                                                    ,
                                                <?php endif; ?>

                                                <?php if (!empty($user->city)) : ?>
                                                    город
                                                <?php endif; ?>

                                            </dt>
                                            <dd class="definition__description">
                                                <?= $user->country ?>

                                                <?php if (!empty($user->country) && !empty($user->city)) : ?>
                                                    ,
                                                <?php endif; ?>

                                                <?= $user->city ?>
                                            </dd>
                                        </dl>
                                    <?php endif; ?>

                                </div>

                                <?php
                                if (isset($_SESSION['login']) && $_SESSION['login'] === 1) {
                                    // Если админ
                                    if ($_SESSION['logged_user']['role'] === 'admin') {
                                        echo "<a class=\"secondary-button\" href=\"" . HOST . "profile-edit/" . $user->id . "\">Редактировать</a>";
                                        // Если Юзер
                                    } else if ($_SESSION['logged_user']['role'] === 'user') {

                                        // Юзер открыл свой профиль
                                        if ($_SESSION['logged_user']['id'] === $user->id) {
                                            echo "<a class=\"secondary-button\" href=\"" . HOST . "profile-edit\">Редактировать</a>";
                                        }
                                    }
                                }
                                ?>





                            </div>
                        </div>

                    <?php endif; ?>

                </div>
            </div>
        </div>
        <div class="section bg-grey">
            <div class="container">
                <div class="section__title">
                    <h2 class="heading">Комментарии пользователя </h2>
                </div>
                <div class="section__body">
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <div class="comment">
                                <div class="comment__avatar"><a href="#">
                                        <div class="avatar-small">
                                            <img src="<?= HOST ?>static/img/avatars/avatart-rect.jpg" alt="Аватарка" />
                                        </div>
                                    </a>
                                </div>
                                <div class="comment__data">
                                    <div class="comment__user-info">
                                        <div class="comment__username">Джон До</div>
                                        <div class="comment__date">
                                            <img src="<?= HOST ?>static/img/favicons/clock.svg" alt="Дата публикации" />
                                            05 мая 2017 года 15:45</div>
                                    </div>
                                    <div class="comment__text">
                                        <p>Замечательный парк, обязательно отправлюсь туда этим летом.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="comment">
                                <div class="comment__avatar"><a href="#">
                                        <div class="avatar-small">
                                            <img src="<?= HOST ?>static/img/avatars/avatart-rect.jpg" alt="Аватарка" /></div>
                                    </a>
                                </div>
                                <div class="comment__data">
                                    <div class="comment__user-info">
                                        <div class="comment__username">Джон До</div>
                                        <div class="comment__date"><img src="<?= HOST ?>static/img/favicons/clock.svg" alt="Дата публикации" />05 мая 2017 года 15:45</div>
                                    </div>
                                    <div class="comment__text">
                                        <p>Замечательный парк, обязательно отправлюсь туда этим летом.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="comment">
                                <div class="comment__avatar"><a href="#">
                                        <div class="avatar-small"><img src="<?= HOST ?>static/img/avatars/avatart-rect.jpg" alt="Аватарка" /></div>
                                    </a>
                                </div>
                                <div class="comment__data">
                                    <div class="comment__user-info">
                                        <div class="comment__username">Джон До</div>
                                        <div class="comment__date"><img src="<?= HOST ?>static/img/favicons/clock.svg" alt="Дата публикации" />05 мая 2017 года 15:45</div>
                                    </div>
                                    <div class="comment__text">
                                        <p>Замечательный парк, обязательно отправлюсь туда этим летом.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

</main>