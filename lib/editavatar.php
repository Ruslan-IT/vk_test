<?php


if(isset($_POST['editavatar'])){
    $avatar = $_FILES['avatar'];
    if(isSecurity($avatar)) {
        loadAvatar($avatar, $_SESSION['name']);
    }
    else {
        $_SESSION['error'] = 'Ошибка при загрузки аватарки. <br>
        Проверьте расширение и файл не должен привышать 5mb.';
        header("Location: editavatar");
        exit;
    }
    $_SESSION['message'] = 'Аватар изменен.';
    header("Location: index");
    exit;

}
headerFUN('description', 'keywords', 'Редактирование аватарки');
?>

<div class="modal__body authoriz__modal">

    <div class="modal-card tab authoriz__block avatar">

        <?php include_once 'lib/message.php'; ?>

        <div class="form_block_img">
            <img src="/img/0.jpg" alt="foto" class="form_img">
        </div>
        <div class="authoriz__header">
            <button class="tab-header authoriz__tab _active" data-tab-header="sign-up">Изменить аватарку</button>

        </div>
        <div class="tab-body authoriz__body _show" data-tab-body="sign-up">

            <div class="authoriz__form">

                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="input authoriz__form__input input_file_block">

                        <input id="input_file" class="input_file" name="avatar" type="file" multiple>
                        <label for="input_file">
                             <img class="massage__img" src="/img/upload.png" title="Загрузить изображение" alt="загрузить">
                        </label>
                    </div>
                    <button type="submit" name="editavatar" class="btn authoriz-btn">Загрузить</button>
                </form>

            </div>
        </div>
    </div>
</div>

