<?php
headerFUN('description', 'keywords', 'title');
?>

<div class="modal__body authoriz__modal">

    <div class="modal-card tab authoriz__block">

        <?php include_once 'lib/message.php'; ?>

        <div class="authoriz__header">
            <button class="tab-header authoriz__tab _active" data-tab-header="sign-up">Восстановить доступ</button>

        </div>
        <div class="tab-body authoriz__body _show" data-tab-body="sign-up">

            <div class="authoriz__form">

                <form action="accessFunc" method="POST">
                    <div class="input authoriz__form__input">
                        <div class="input__header">
                            <label for="name">Введите ваш email</label>
                        </div>
                        <input name="email" type="text">
                    </div>

                    <button name="access" type="submit" class="btn authoriz-btn">Восстановить</button>

                </form>

            </div>
        </div>
    </div>
</div>

