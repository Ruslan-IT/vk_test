<?php
if(isset($_POST['editPost'])){
    $postImg= $_FILES['postImg'];

    if(isSecurity($postImg)) {
        loadPostImg($postImg, $_SESSION['name']);
    }
    else {
        $_SESSION['error'] = 'Ошибка при загрузки фото. <br>
        Проверьте расширение и файл не должен привышать 5mb.';
        header("Location: index");
        exit;
    }
    $_SESSION['message'] = 'Пост сохранен.';
    header("Location: index");
    exit;

}