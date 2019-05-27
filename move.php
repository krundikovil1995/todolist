<?php
require_once('configs/config.php');
session_start();
$user_id = $_SESSION['id'];
$move = $_POST['move'];

$textmove = explode(' ', $move);
$outid = $textmove[1];
$toid = $textmove[2];

$mysql = new mysqli($db['host'], $db['name'], $db['pass'], $db['db']);

$sql = "SELECT `task`, `date`, `user_id` FROM todo WHERE `id` = '$outid'";
$result = $mysql->query($sql);
$res = $result->fetch_assoc();
$taskFromTable = $res['task'];
$dateFromTable = $res['date'];
$userIdFromTable = $res['user_id'];

$sql = "DELETE FROM `todo` WHERE `id` = '$outid'";
$mysql->query($sql);

$sql = "INSERT INTO `todo` (`task`, `date`, `user_id`, `status_id`) VALUES ('$taskFromTable', '$dateFromTable', '$userIdFromTable', '$toid')";
$mysql->query($sql);