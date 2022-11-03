<?php
require_once('db_connection.php');
session_start();

if ($_SESSION['role'] != 'administrator' && $_SESSION['role'] != 'worker') {
    header("location: ../pages/home.php");
}

deleteQuery("DELETE FROM users WHERE id='{$_GET["id"]}'");
header("location: ../pages/customers.php");
?>