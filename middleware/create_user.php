<?php
require_once('db_connection.php');
try {
    session_start();
    insertQuery("INSERT INTO users (name, email, password, phone, address) VALUES ('$_POST[name]', '$_POST[mail]', '$_POST[pwrd]', '$_POST[phone]', '$_POST[address]')");
    $result = selectQuery("SELECT u.id FROM users AS u WHERE email = '{$_POST["mail"]}'");
    $_SESSION['id'] = $result[0]["id"];
    header("location: ../pages/home.php");
} catch (\Throwable $th) {
    header("location: ../pages/create_user.php");
}

?>