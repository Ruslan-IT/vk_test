<?php

headerFUN('description', 'keywords', 'Авторизация');
?>

<div class="modal__body authoriz__modal">

    <div class="modal-card tab authoriz__block">

        <?php include_once 'lib/message.php'; ?>

        <div class="form_block_img">
            <img src="/img/0.jpg" alt="foto" class="form_img">
        </div>
        <div class="authoriz__header">
            <button class="tab-header authoriz__tab _active" data-tab-header="sign-up">Вход</button>

        </div>
        <div class="tab-body authoriz__body _show" data-tab-body="sign-up">

            <div class="authoriz__form">

                <form action="authFunc" method="POST">
                    <div class="input authoriz__form__input">
                        <div class="input__header">
                            <label for="name">Имя</label>
                        </div>
                        <input class="input_text" name="name" type="text">
                    </div>
                    <div class="input authoriz__form__input">
                        <div class="input__header">
                            <label for="email">Email</label>
                        </div>
                        <input class="input_text" name="email" type="text">
                    </div>

                    <div class="input authoriz__form__input">
                        <div class="input__header">
                            <label for="password">Пароль:</label>
                        </div>
                        <input class="input_text" name="password" type="password">
                    </div>
                    <button type="submit" class="btn authoriz-btn">Войти</button>

                    <div class="input_link">
                        <a href="access">Забыли пароль?</a>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

