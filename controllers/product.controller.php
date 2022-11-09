<?php
include_once '../head.php';
include_once '../classes/db.class.php';
include_once '../classes/products.class.php';

$productController = new Products();
if (isset($_GET['method'])) {
    if (!isset($_SESSION['id'])) {
        header("location: /../pages/login.php");
        exit;
    }
    
    if ($_GET['method'] == "add_to_cart") {
        if (isset($_SESSION['cart'])) {
            $amount = count($_SESSION['cart']);
            $_SESSION['cart'][$amount] = $productController->getProduct($_POST['id']);
            header("location: /../pages/home.php");
        } else {
            $_SESSION['cart'][0] = $productController->getProduct($_POST['id']);
            header("location: /../pages/home.php");
        }
    }

    if ($_GET['method'] == "remove_from_cart") {
        var_dump($_SESSION['cart']);
        echo '<br>'.$_POST['id'];
        $newCart = array();
        for ($i=0; $i < count($_SESSION['cart']); $i++) {
            if ($i == $_POST['id']) {
                continue;
            } 
            array_push($newCart, $_SESSION['cart'][$i]);
        }
        if(count($newCart) > 0) {
            $_SESSION['cart'] = $newCart;
        } else {
            unset($_SESSION['cart']);
        }
        header("location: /../pages/cart.php");
    }
    
}