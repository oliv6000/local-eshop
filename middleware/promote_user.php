<?php

require_once('db_connection.php');
session_start();

if ($_SESSION['role'] != 'administrator') {
    header("location: /../pages/home.php");
}

updateQuery("UPDATE users SET role='worker' WHERE id='{$_GET["user_id"]}'");
header("location: /../pages/home.php");



?>