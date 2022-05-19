<?php
session_start();
include_once 'lib/config.php';
include_once 'lib/functions.php';


$url = $_SERVER['REQUEST_URI'];


if($_SERVER['REQUEST_URI'] == '/'){ //если пустой
    $page = 'index';
    $module = 'index';
}

else{
    $url_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); // разбиваем адрес на части
    $url_parts = explode('/', trim($url_path, '/'));// разбиваем на массив
    $page = array_shift($url_parts); // определяем имя
    $module = array_shift($url_parts); // определяем модуль

    if(!empty($module)){
        $param = array();
        for($i = 0; $i < count($url_parts); $i++){
            $param[$url_parts[$i]] = $url_parts[++$i];
        }
    }
}
    if ($page == 'index') include 'page/index.php';

    elseif ($page == 'reg') include 'page/reg.php';
    elseif ($page == 'auth') include 'page/auth.php';
    elseif ($page == 'access') include 'page/access.php';
    elseif ($page == 'changepassword') include 'page/changepassword.php';


    elseif ($page == 'regFunc') include 'lib/regFunc.php';
    elseif ($page == 'logout') include 'lib/logout.php';
    elseif ($page == 'authFunc') include 'lib/authFunc.php';
    elseif ($page == 'accessFunc') include 'lib/accessFunc.php';
    elseif ($page == 'updateProfile') include 'lib/updateProfile.php';
    elseif ($page == 'editavatar') include 'lib/editavatar.php';
    elseif ($page == 'postFunc') include 'lib/postFunc.php';
    elseif ($page == 'message') include 'lib/message.php';















