<?php
session_start();
if (isset($_SESSION['user'])) {
    header("Location: http://localhost:8080/test/todolist/list.php");
} ?>

<!DOCTYPE HTML>
<html>
<head>
    <title>My todo list</title>
    <META CHARSET="UTF-8">
    <link href="styles/style.css" rel="stylesheet">
</head>
<body>
<h2 class="title">My toDO list</h2>
<div id="result"></div>
<div class="signin">

    <form id="signin" method="post">
        <fieldset>
            <legend> Sign In</legend>
            <input type="text" id="name" name="name" placeholder="Name:"/></br>
            <input type="text" id="email" name="email" placeholder="Email:"/></br>
            <input type="password" id="key" name="key" placeholder="Key:"/></br>
            <input type="submit" value="Sign In" class="submit">
        </fieldset>
    </form>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="scripts/script.js" type="text/javascript"></script>
</body>
</html>
