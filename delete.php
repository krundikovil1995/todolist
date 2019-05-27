<?php
require_once('configs/config.php');
session_start();
$user_id = $_SESSION['id'];
$del = $_POST['del'];
$number = explode(' ', $del);
$id = $number[2];

$mysql = new mysqli($db['host'], $db['name'], $db['pass'], $db['db']);
$sql = "DELETE FROM `todo` WHERE `id` = '$id'";
$mysql->query($sql);
