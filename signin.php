<?php

require_once('configs/config.php');
$error = array();
session_start();

//Проверка введенных данных
if (empty ($_POST['name'])) {
    $error[] = 'Введите имя';
} else if (empty($_POST['email'])) {
    $error[] = 'Введите почту';
} else if (!preg_match('/^([A-Za-z0-9_-]+\.)*[A-Za-z0-9_-]+@[A-Za-z0-9_-]+(\.[A-Za-z0-9_-]+)*\.[a-z]{2,6}$/', $_POST['email'])) {
    $error[] = 'Некорректно введен email';
} else if (empty($_POST['key'])) {
    $error[] = 'Введите ключ';
} else {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $key = $_POST['key'];
}

//Если все данные введены корректно, проверяем наличие пользователя в бд
if (empty($error)) {
    $mysql = new mysqli($db['host'], $db['name'], $db['pass'], $db['db']);
    $sql = "SELECT*FROM user WHERE email = '$email'";
    $result = $mysql->query($sql);
    $rows = $result->fetch_assoc();

    $pass = $rows['key'];
    $sault = substr($pass, 32, 41);
    $saultkey = md5($key . $sault);

    //Если пользователь существует и пароли совпадают
    if ($pass == $saultkey . $sault) {
        $_SESSION['user'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['id'] = $rows['id'];

        //Если пользователя нет в бд, создаем запись в бд
    } else if (!empty($rows['email'])) {
        $error[] = 'Пользователь с таким Email уже существет';
    } else {
        require('functions.php');

        $sault = generateRandomString();
        $pass = md5($key . $sault);
        $pass = $pass . $sault;

        $sql = "INSERT INTO `user`(`name`, `email`, `key`) VALUES ('$name','$email','$pass')";
        $mysql->query($sql);
        $sql = "SELECT*FROM user WHERE email = '$email'";
        $result = $mysql->query($sql);
        $rows = $result->fetch_assoc();
        $_SESSION['user'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['id'] = $rows['id'];
        $res = [];
    }
}

if (!empty($error)) {
    $response = $error;
} else {
    $response = true;
}
echo json_encode($response);

