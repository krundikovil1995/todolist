<?php

require_once('configs/config.php');
session_start();
$name = $_SESSION['user'];
$email = $_SESSION['email'];
$id = $_SESSION['id'];

$error = [];

//проверка введенных данных
if (empty($_POST['task'])) {
    $error[] = 'Введите task';
} else if (empty($_POST['status'])) {
    $error[] = 'Введите status';
} else if (empty($_POST['date'])) {
    $error = 'Введите date';
}

$task = $_POST['task'];
$status = $_POST['status'];
$date = $_POST['date'];

//создание таска в бд
if (empty($error)) {
    $mysql = new mysqli($db['host'], $db['name'], $db['pass'], $db['db']);
    $sql = "INSERT INTO `todo`(`task`,`date`,`user_id`,`status_id`) VALUES ('$task','$date','$id','$status')";
    $mysql->query($sql);
}

if (!empty($error)) {
    $response = $error;
} else {
    $response = true;
}
echo json_encode($response);