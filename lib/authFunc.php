<?php
    if($_POST['name']  && $_POST['password'] && $_POST['email']) {

        $name = htmlspecialchars($_POST['name']);
        $password = htmlspecialchars($_POST['password']);
        $email = htmlspecialchars($_POST['email']);

        $login = login($name, $password, $email);

        if($login){
            $_SESSION['message'] = 'Приятной работы, '.$name;
            header("Location: index");
            exit;
        }
    }

    else{
        $_SESSION['error'] = 'Не все поля были заполнены';
        header("Location: auth");
        exit;
    }

