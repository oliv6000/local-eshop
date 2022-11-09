<?php
require_once('db_connection.php');

function getCustomers() {
    $customers = selectQuery("SELECT id, name, email, phone, address FROM users WHERE role='customer'");
    return $customers;
}

function getWorkers() {
    $workers = selectQuery("SELECT id, name, email, phone, address FROM users WHERE role='worker'");
    return $workers;
}

function getUser($id) {
    $conn = establish_db_connection();
    $sql = "SELECT name, email, phone, address FROM users WHERE id=?";

    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "Sql error";
    } else {
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = $result->fetch_all(MYSQLI_ASSOC);
        return $user;
    }
}

?>