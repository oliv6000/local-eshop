<?php
require_once('db_connection.php');

function getCustomers() {
    $customers = selectQuery("SELECT id, name, email, phone, address FROM users WHERE role='customer'");
    return $customers;
}

function getWorkers() {
    $customers = selectQuery("SELECT id, name, email, phone, address FROM users WHERE role='worker'");
    return $customers;
}

?>