<?php
$user = get_user_name($_SESSION['name']);

if($user['prava'] === '0'){
    $_SESSION['error'] = $_SESSION['name']. ', у Вас нет доступа. ';
    header("Location: index");
    exit;
}

headerFUN('description', 'keywords', 'Регистрация');
?>

<div class="modal__body authoriz__modal">

    <div class="modal-card tab authoriz__block">

        <?php include_once 'lib/message.php'; ?>
        <div class="form_block_img">
            <img src="/img/0.jpg" alt="foto" class="form_img">
        </div>
        <div class="authoriz__header">
            <button class="tab-header authoriz__tab _active" data-tab-header="sign-up">Регистрация</button>

        </div>
        <div class="tab-body authoriz__body _show" data-tab-body="sign-up">

            <div class="authoriz__form">

                <form action="regFunc" method="POST">
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
                        <input class="input_text" name="email" type="email">
                    </div>


                    <div class="input authoriz__form__input">
                        <div class="input__header">
                            <label for="password">Придумайте пароль:</label>
                        </div>
                        <input class="input_text" name="password" type="password">
                    </div>
                    <button type="submit" class="btn authoriz-btn">Продолжить</button>
                </form>

            </div>
        </div>
    </div>
</div>
