<?php
function headerFUN($description, $keywords, $title){
    echo " 
<!DOCTYPE html>
<html lang=\"ru\">
<head>
    <meta charset=\"UTF-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <meta name=\"description\" content=\"$description\" >
    <meta name=\"keywords\" content=\"$keywords\" >
    <title>$title</title>
    <!-- <link rel=\"shortcut icon\" href=\"img2/favicon.ico\" type=\"image/ico\"> -->
    <link rel=\"stylesheet\" href=\"css/style.css\">
</head>
";
}
//проверка логина на существование
function get_user_name($name)
{
    global $db;
    $sql = "SELECT * FROM users WHERE name=:name";
    $statement = $db->prepare($sql);
    $statement->execute(['name' => $name]);
    return $statement->fetch(PDO::FETCH_ASSOC);
}

function get_user_password($password)
{
    global $db;
    $sql = "SELECT * FROM users WHERE password=:password";
    $statement = $db->prepare($sql);
    $statement->execute(['password' => $password]);
    return $statement->fetch(PDO::FETCH_ASSOC);
}



function get_user_email($email)
{
    global $db;
    $sql = "SELECT * FROM users WHERE email=:email";
    $statement = $db->prepare($sql);
    $statement->execute(['email' => $email]);
    return $statement->fetch(PDO::FETCH_ASSOC);
}



//добавление нового user
function add_user($name, $password, $email)
{
    global $db;
    $date = time();
    $success = $db->prepare("INSERT INTO `users` (`name`, `password`, `email`, `avatar`, `prava`, `date`) 
            VALUE('$name', '$password', '$email', '0', '0', '$date')");
    $success->execute();
    $_SESSION['name'] = $name;
    $_SESSION['password'] = $password;
    $_SESSION['email'] = $email;
    return $success;
}

function add_userUPDATE($name, $password, $email)
{
    global $db;
    $date = time();
    $success = $db->prepare("UPDATE `users` SET name=?, password =?, email =?, prava =?, date =? WHERE `name` = '$name'");
    $success->execute([$name, $password, $email, '0', $date]);

    $_SESSION['name'] = $name;
    $_SESSION['password'] = $password;
    $_SESSION['email'] = $email;
    return $success;
}


//авторизация пользователя
function login($login, $password, $email)
{
    $user = get_user_name($login);
    if (empty($user)) {
        $_SESSION['error'] = 'Такого логина не существует';
        header("Location: auth");
        exit;
    }

    $email = get_user_email($email);
    if (empty($email)) {
        $_SESSION['error'] = 'Email введен не верно';
        header("Location: auth");
        exit;
    }

    if($email['password'] != $password){
        $_SESSION['error'] = 'Пароль введен не верно';
        header("Location: auth");
        exit;
    }

    if( $user['id'] === $email['id']){
        $_SESSION['name'] = $login;
        $_SESSION['password'] = $password;
        $_SESSION['email'] = $email['email'];
        return true;
    }else{
        $_SESSION['error'] = 'Ошибка!';
        header("Location: auth");
        exit;
    }
}

//Получить по email password
function getPasswordOnemail($email){
    global $db;
    $res = $db->query( "SELECT password FROM users WHERE `email` = '$email'" );
    return $res->fetch(PDO::FETCH_COLUMN);
}

//Получить данные по name
function getNameAll($name){
    global $db;
    $res = $db->query( "SELECT * FROM users WHERE `name` = '$name'" );
    return $res->fetch(PDO::FETCH_ASSOC);
}

//проверка на безопасность загрузки изображения
function isSecurity($avatar){
    $name = $avatar['name'];
    $type = $avatar['type'];
    $size = $avatar['size'];
    $blacklist = ['.php', '.phtml', '.php3', '.php4'];
    foreach ($blacklist as $item){
        if(preg_match("/$item\$/i", $name)) return false;
    }
    if(($type != "image/gif") && ($type != "image/png") && ($type != "image/jpg") && ($type != "image/jpeg")) return false;
    if($size > 5 * 1024 * 1024) return false;
    return true;
}
//загрузка
function loadAvatar($avatar, $login){
    $type = $avatar['type'];
    $uploaddir = 'img/avatars/';
    $name = md5(microtime()).".".substr($type, strlen("image/"));
    $uploadfile = $uploaddir.$name;
    if(move_uploaded_file($avatar['tmp_name'], $uploadfile)){
        setAvatar($login, $name);
        return true;
    }
    else return false;
}
//сохранить в базу
function  setAvatar($login, $name){
    global $db;
    $success = $db->prepare("UPDATE `users` SET avatar=? WHERE `name` = '$login'");
    $success->execute([$name]);
}

//загрузка фото поста
function loadPostImg($avatar, $login){
    $type = $avatar['type'];
    $uploaddir = 'img/post/';
    $name = md5(microtime()).".".substr($type, strlen("image/"));
    $uploadfile = $uploaddir.$name;
    if(move_uploaded_file($avatar['tmp_name'], $uploadfile)){
        setPostImg($login, $name);
        return true;
    }
    else return false;
}
//сохранить в базу фото поста
function setPostImg($login, $nameIMG){
    $date = time();
    $text = '';
    global $db;
    $success = $db->prepare("INSERT INTO post SET name=:name, text=:text, img=:img, date=:date");
    $params = [ 'name' => $login, 'text' => $text, 'img' => $nameIMG, 'date' => $date];
    $success->execute($params);
}

function get_post($name){
    global $db;
    $res = $db->query( "SELECT * FROM post WHERE `name`= '$name'");
    return $res->fetchAll(PDO::FETCH_ASSOC);
}
































//получить товары
function get_products($i){
    global $db;
    $res = $db->query( "SELECT * FROM products WHERE `section` = '$i'");
    return $res->fetchAll(PDO::FETCH_ASSOC);
}
//проверить на существование товара
function get_product($id){
    global $db;
    $stmt = $db->prepare("SELECT * FROM products WHERE id =? ");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

// добавление в корзину
function add_cart($product){

    if(isset($_SESSION['cart'][$product['id']])){
        $_SESSION['cart'][$product['id']]['gty'] += 1;
    }else{
        $_SESSION['cart'][$product['id']] = [
            'title' => $product['title'],
            'description' => $product['description'],
            'img' => $product['img'],
            'price' => $product['price'],
            'gty' => 1,
        ];
    }

    //итоговое количество товара
    if(!empty($_SESSION['cart.gty'])){ // если не пусто
        $_SESSION['cart.gty'] =  $_SESSION['cart.gty'] + 1 ;

    }else{
        $_SESSION['cart.gty'] =   + 1;
    }

    if(!empty($_SESSION['cart.sum'])){
        $_SESSION['cart.sum'] =  $_SESSION['cart.sum'] + $product['price'];
    } else{
        $_SESSION['cart.sum']  = $product['price'];
    }

}

function add_cart_minus($product){
    if($_SESSION['cart'][$product['id']]['gty'] <= 1)  {
        unset($_SESSION['cart'][$product['id']]);
    }
    if(isset($_SESSION['cart'][$product['id']])){
        $_SESSION['cart'][$product['id']]['gty'] -= 1;
    }else{
        unset($_SESSION['cart'][$product['id']]);
    }

    //итоговое количество товара
    if(!empty($_SESSION['cart.gty'])){ // если не пусто
        $_SESSION['cart.gty'] =  $_SESSION['cart.gty'] - 1 ;

    }else{
        $_SESSION['cart.gty'] =   - 1;
    }

    if(!empty($_SESSION['cart.sum'])){
        $_SESSION['cart.sum'] =  $_SESSION['cart.sum'] - $product['price'];
    } else{
        //$_SESSION['cart.sum']  = $product['price'];
    }
}
function add_cart_plus($product){

    if(($_SESSION['cart'][$product['id']])){
        $_SESSION['cart'][$product['id']]['gty'] += 1;
    }

    //итоговое количество товара
    if(!empty($_SESSION['cart.gty'])){ // если не пусто
        $_SESSION['cart.gty'] =  $_SESSION['cart.gty'] + 1 ;

    }else{
        $_SESSION['cart.gty'] =  + 1;
    }

    if(!empty($_SESSION['cart.sum'])){
        $_SESSION['cart.sum'] =  $_SESSION['cart.sum'] + $product['price'];
    }
}
function add_cart_deleteSumma($product){
    $_SESSION['cart.sum'] =  $_SESSION['cart.sum'] - ($_SESSION['cart'][$product['id']]['price'] * $_SESSION['cart'][$product['id']]['gty']);

    if(empty($_SESSION['cart'])) {
        unset($_SESSION['cart.sum']);
    }
}
function add_cart_deleteGty($product){
    //при удалении меняем количества товара.
    $_SESSION['cart.gty'] = $_SESSION['cart.gty'] - $_SESSION['cart'][$product['id']]['gty'];
    unset($_SESSION['cart'][$product['id']]);
    return $_SESSION['cart.gty'];
}
//добавить заказ
function add_order(){
    $name = $_SESSION['name'];
    $id_product = '';
    $title_product = '';
    $cart_sum = $_SESSION['cart.sum'];
    $cart_gty = $_SESSION['cart.gty'];
    $date = time();

    foreach($_SESSION['cart'] as $id => $item){
        if(!$id_product) $id_product .= "$id";
        else $id_product .= ",$id";

        if(!$title_product) $title_product .= "$item[title]-$item[gty]шт";
        else $title_product .= ",$item[title]-$item[gty]шт";
    }

    global $db;
    $success = $db->prepare("INSERT INTO `orders` (`name`, `id_product`, `title_product`, `cart_sum`, `cart_gty`, `date`) 
            VALUE('$name', '$id_product', '$title_product', '$cart_sum', '$cart_gty', '$date')");
    $success->execute();
    unset($_SESSION['cart']);
    unset($_SESSION['cart.gty']);
    unset($_SESSION['cart.sum']);
}

//получить товары
function get_orders(){
    global $db;
    $res = $db->query( "SELECT * FROM orders");
    return $res->fetchAll(PDO::FETCH_ASSOC);
}

function count_section(){
    global $db;
    $res = $db->query( "SELECT count(*) FROM section");
    return $res->fetchAll(PDO::FETCH_ASSOC);
}
function get_section(){
    global $db;
    $res = $db->query( "SELECT * FROM section");
    return $res->fetchAll(PDO::FETCH_ASSOC);
}
function get_sectionID($p){
    global $db;
    $res = $db->query( "SELECT section_id FROM section WHERE `id` = '$p'" );
    return $res->fetch(PDO::FETCH_COLUMN);
}

function  add_product($section_id, $title, $description, $img, $price) {
    global $db;
    $success = $db->prepare("INSERT INTO `products` (`section`, `title`, `description`, `img`, `price`) 
            VALUE('$section_id', '$title', '$description', '$img', '$price')");
    $success->execute();
    $_SESSION['message'] = 'Товар добавлен';

}
function  add_category($category) {
    global $db;
    $success = $db->prepare("INSERT INTO `section` (`section_id`) 
            VALUE('$category')");
    $success->execute();
    $_SESSION['message'] = 'Категория добавлена';
}

function accessName($name){
    global $db;
    $res = $db->query( "SELECT prava FROM users WHERE `name` = '$name'" );
    return $res->fetch(PDO::FETCH_COLUMN);
}