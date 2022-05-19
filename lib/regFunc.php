<?php
    if ($_POST['name'] && $_POST['password'] && $_POST['email']) {

        $name = htmlspecialchars($_POST['name']);
        $password = htmlspecialchars($_POST['password']);
        $email = htmlspecialchars($_POST['email']);

    }

        $user = get_user_name($name);
        $email1 = get_user_email($email);

        if (!empty($user)) {
            $_SESSION['error'] = 'Такой имя уже существует ';
            header("Location: reg");
            exit;
        }
        if (!empty($email1)) {
            $_SESSION['error'] = 'Такой email уже существует ';
            header("Location: reg");
            exit;
        }

        $add_user = add_user($name,$password, $email);

        if($add_user){
            $_SESSION['message'] = 'Аккаунт создан ';
            header("Location: index");
            exit;
        }




    $_SESSION['error'] = 'Не все поля были заполнены';
    header("Location: reg");
    exit;