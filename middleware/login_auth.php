<?php
require_once('db_connection.php');

session_start();
    $result = selectQuery("SELECT u.id, u.password, u.role FROM users AS u WHERE email = '{$_POST["mail"]}'");
    if($result == true) {
        $hashedPassword = hash('sha256', $_POST["pwrd"]);
        // $hashedPassword
        if ($result[0]["password"] == $_POST["pwrd"]) {
            $_SESSION["id"] = $result[0]["id"];
            $_SESSION["role"] = $result[0]["role"];
            header("location: ../pages/home.php");
        }
        else {
            header("location: ../pages/login.php/?error=wrong-password");
        }
    } 
    else {
        header("location: ../pages/login.php/?error=wrong-email");
    }


?>