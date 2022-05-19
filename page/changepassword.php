<?php


    $email = $_REQUEST['email'];
    $code = $_REQUEST['code'];

    $password = getPasswordOnemail($email);

    if($password !== $code){
        $_SESSION['error'] = 'Ошибка!';
        header("Location: auth");
        exit;
    }

    if(isset($_POST['changepassword'])){
        $name = get_user_email($email);
        $password = $_POST['password'];
        add_userUPDATE($name['name'], $password, $email);
        $_SESSION['message'] = 'Пароль изменен!';
        header("Location: index");
        exit;

    }
headerFUN('description', 'keywords', 'title');
?>

<div class="modal__body authoriz__modal">

    <div class="modal-card tab authoriz__block">

        <?php include_once 'lib/message.php'; ?>

        <div class="authoriz__header">
            <button class="tab-header authoriz__tab _active" data-tab-header="sign-up">Изменить пароль</button>

        </div>
        <div class="tab-body authoriz__body _show" data-tab-body="sign-up">

            <div class="authoriz__form">

                <form action="" method="POST">
                    <div class="input authoriz__form__input">
                        <div class="input__header">
                            <label for="name">Введите ваш пароль</label>
                        </div>
                        <input name="password" type="text">
                        <input name="email" type="hidden" value="<?= $email ?>">
                        <input name="code" type="hidden" value="<?= $code ?>">

                    </div>

                    <button name="changepassword" type="submit" class="btn authoriz-btn">Восстановить</button>

                </form>

            </div>
        </div>
    </div>
</div>

