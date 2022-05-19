<?php
    if(isset($_POST['access'])){
        $email = $_POST['email'];
        $code = getPasswordOnemail($email);
        if(empty($code)){
            $_SESSION['error'] = 'Ошибка';
            header("Location: access");
            exit;
        }
        $link = "https://ru-landing.ru/changepassword?email=$email&code=$code";

        $from = "admin@beloved-home.ru";
        $subject = 'Recover password';
        $subject = '=?windows-1251?B?'.base64_encode($subject). '?=';
        $headeres = "From: $from\r\nReply-To: $from\r\nContent=type: text/html;  utf8\r\n";
        $message = "Ссылка на изменения пароля: $link";
        mail($email, $subject, $message, $headeres);

        $_SESSION['message'] = 'На указанный email отправлено письмо.';
        header("Location: index");
        exit;
    }