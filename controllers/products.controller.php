<?php
include_once '../head.php';
include_once '../classes/db.class.php';
include_once '../classes/products.class.php';

$productController = new Products();
if (isset($_GET['method']) && $_GET['method'] == "create" || $_GET['method'] == "update" || $_GET['method'] == "archive" || $_GET['method'] == "unarchive") {
    if ($_SESSION['role'] != 'administrator' && $_SESSION['role'] != 'worker') {
        header("location: /../pages/home.php");
        exit;
    }
    
    if ($_GET['method'] == "create") {
        if (empty(trim($_POST['product_name']))) {
            $_SESSION['error'] = "no_product_name";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
        $productCreated = $productController->createProduct($_POST['product_name'], $_POST['price'], $_POST['description']);
        if ($productCreated) {
            unset($_SESSION['error']);
            header("location: /../pages/products.php");
        } else {
            $_SESSION['error'] = "could_not_create";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }

    if ($_GET['method'] == "update") {
        if (!empty(trim($_POST['discount_percentage']))) {
            $productDiscounted = $productController->discountProduct($_POST['id'], trim($_POST['discount_percentage']));
            header("location: /../pages/products.php");
            exit;
        }

        if (empty(trim($_POST['name']))) {
            $_SESSION['error'] = "no_product_name";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
        
        $productUpdated = $productController->updateProductInfo($_POST['id'], $_POST['name'], $_POST['price'], $_POST['description']);
        if ($productUpdated) {
            unset($_SESSION['error']);
            header("location: /../pages/products.php");
        } else {
            $_SESSION['error'] = "could_not_update";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }

    if ($_GET['method'] == "archive") {
        $productArchived = $productController->archiveProduct($_POST['id']);
        if ($productArchived) {
            unset($_SESSION['error']);
            header("location: /../pages/products.php");
        } else {
            $_SESSION['error'] = "could_not_archive";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }

    if ($_GET['method'] == "unarchive") {
        $productUnarchived = $productController->unarchiveProduct($_POST['id']);
        if ($productUnarchived) {
            unset($_SESSION['error']);
            header("location: /../pages/products.php");
        } else {
            $_SESSION['error'] = "could_not_archive";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
}