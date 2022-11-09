<?php

require_once('db_connection.php');

// Create a product
if (isset($_GET['task']) && $_GET['task'] == "create_product") {
    session_start();
    createProduct($_POST['name'], (double)$_POST['price'], $_POST['description']);
}

// Update product info
if (isset($_GET['task']) && $_GET['task'] == "update_product") {
    session_start();
    updateProduct((int)$_POST['id'], $_POST['name'], (double)$_POST['price'], $_POST['description']);
}

// archive product with id
if (isset($_GET['archive_id'])) {
    session_start();
    archiveProduct((int)$_GET['archive_id']);
}

// unarchive product with id
if (isset($_GET['unarchive_id'])) {
    session_start();
    unarchiveProduct((int)$_GET['unarchive_id']);
}

// Redirect if not an administrator nor a worker
if ($_SESSION['role'] != 'administrator' && $_SESSION['role'] != 'worker') {
    header("location: ../pages/home.php");
}



function createProduct($name, $price, $description) {
    insertQuery("INSERT INTO products (name, price, description) VALUES ('$name', $price, '$description')");
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

function updateProduct($id, $name, $price, $description) {
    updateQuery("UPDATE products SET name='{$name}', price=$price, description='{$description}' WHERE id={$id}");
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

function getProducts() {
    $products = selectQuery("SELECT * FROM products WHERE archived=0");
    return $products;
}

function getProductFields() {
    $fields = selectQuery("SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='local-eshop' AND `TABLE_NAME`='products'");
    return $fields;
}

function getArchivedProducts() {
    $archivedProducts = selectQuery("SELECT * FROM products WHERE archived=1");
    return $archivedProducts;
}

function archiveProduct($id) {
    updateQuery("UPDATE products SET archived=1 WHERE id={$id}");
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

function unarchiveProduct($id) {
    updateQuery("UPDATE products SET archived=0 WHERE id={$id}");
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}


?>