<?php
//закрытие сессии
session_start();
$_SESSION = array();
session_destroy();