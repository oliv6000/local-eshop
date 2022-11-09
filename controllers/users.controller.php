<?php
include_once '../head.php';
include_once '../classes/db.class.php';
include_once '../classes/users.class.php';

$userController = new Users();

if (isset($_GET['method']) && $_GET['method'] == "demote" || $_GET['method'] == "promote" || $_GET['method'] == "create_worker") {
    if ($_SESSION['role'] != 'administrator') {
        header("location: ../pages/home.php");
    }
    
    if ($_GET['method'] == "create_worker") {
        $createWorker = $userController->createWorker($_POST['name'], $_POST['email'], $_POST['address'], $_POST['phone']);
        if($createWorker) {
            header("location: /../pages/workers.php");
        } else {
            $_SESSION['error'] = "Could_not_create_worker";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
    if ($_GET['method'] == "demote") {
        $userController->demoteUser($_POST['id']);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    if ($_GET['method'] == "promote") {
        $userController->promoteUser($_POST['id']);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}
    if ($_GET['method'] == "verify_info_code") {
        $verf_code = $userController->getVerifyCode($_SESSION['id'], $_POST['verf_code']);
        if ($verf_code) {
            unset($_SESSION['error']);
            $check = $userController->updateUserInfo($_POST['name'], $_POST['email'], $_POST['address'], $_POST['phone'], $_SESSION['id']);
            $userController->deleteVerifyCode($verf_code['id']);
            header("location: /../pages/user_account.php");
        } else {
            $_SESSION['error'] = "wrong_code";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
    if ($_GET['method'] == "verify_password") {
        $verf_code = $userController->getVerifyCode($_SESSION['id'], $_POST['verf_code']);
        if ($verf_code) {
            unset($_SESSION['error']);
            $check = $userController->updatePassword($_POST['new_password'], $_SESSION['id']);
            $userController->deleteVerifyCode($verf_code['id']);
            header("location: /../pages/user_account.php");
        } else {
            $_SESSION['error'] = "wrong_code";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
    if ($_GET['method'] == "verify_password_reset") {
        $user = $userController->getUserWithEmail($_POST['email']);
        $verf_code = $userController->getVerifyCode($_SESSION['id'], $_POST['verf_code']);
        if ($verf_code) {
            unset($_SESSION['error']);
            $check = $userController->updatePassword($_POST['new_password'], $_SESSION['id']);
            $userController->deleteVerifyCode($verf_code['id']);
            header("location: /../pages/user_account.php");
        } else {
            $_SESSION['error'] = "wrong_code";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
    if ($_GET['method'] == "create_user") {
        if ($_POST['password'] != $_POST['re_password']) {
            $_SESSION['error'] = "passwordNoMatch";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }else {
            unset($_SESSION['error']);
            $userController->createUser($_POST['name'], $_POST['email'], $_POST['address'], $_POST['phone'], $_POST['password']);
            header("location: /../pages/login.php");
        }
    }