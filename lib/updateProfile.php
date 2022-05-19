<?php
if(isset($_POST['edit'])){
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $date = htmlspecialchars($_POST['date']);

    //name - на данный момент
    $name_session = $_SESSION['name'];
    //email - на данный момент
    $email_session = $_SESSION['email'];

    /*
     * Проверить session name и введенные данные*
     * если данные те же то ничего не делать
     * если данные разные, то проверить а не существует ли уже такой name*
     * если, нет таких, то сохранить
     * иначе вывести сообщение о таком name
     *
     * */

    if($name_session != $name){
        $user = get_user_name($name);
        if (!empty($user)) {
            $_SESSION['error'] = 'Такой имя уже существует ';
            header("Location: index");
            exit;
        }else{
            $success = $db->prepare("UPDATE `users` SET name=? WHERE `name` = '$name_session'");
            $success->execute([$name]);
            $_SESSION['name'] = $name;
        }

    }
    if($email_session != $email){
        $email1 = get_user_email($email);
        if (!empty($email1)) {
            $_SESSION['error'] = 'Такой email уже существует ';
            header("Location: index");
            exit;
        }else{
            $success = $db->prepare("UPDATE `users` SET email=? WHERE `name` = '$name_session'");
            $success->execute([$email]);
            $_SESSION['email'] = $email;
        }
    }
    $_SESSION['message'] = 'Данные изменены. ';
    header("Location: index");
    exit;


}