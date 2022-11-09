<?php
require_once('../middleware/db_connection.php');
require_once('../middleware/mailer.php');
session_start();

if (isset($_GET['change']) && $_GET['change'] == "name") {
    updateQuery("UPDATE users SET name='{$_POST['name']}' WHERE id={$_SESSION['id']}");
    header("location: /../pages/user_account.php");
}

if (isset($_GET['change']) && $_GET['change'] == "email") {
    try {
        ob_start();
        $random = rand(11111,99999);
        include('../resources/mails/verification_code.php');
        $body = ob_get_clean();
        
        insertQuery("INSERT INTO verify_codes (user_id, code) VALUES ({$_SESSION['id']}, $random)");
        
        newMail($_POST['mail'], "Local_eshop - verification-code", $body);
        $_SESSION['new_mail'] = $_POST['new_mail'];
        header("location: /../pages/update_user.php/?change=email-verify");
    } catch (\Throwable $th) {
    }

}

if (isset($_GET['change']) && $_GET['change'] == "email-verify") {
    try {
        $verify = selectQuery("SELECT id FROM verify_codes WHERE code={$_POST['code']} AND user_id={$_SESSION['id']}");
        if($verify) {
            deleteQuery("DELETE FROM verify_codes WHERE id={$verify[0]['id']}");
            updateQuery("UPDATE users SET email='{$_SESSION['new_mail']}' WHERE id={$_SESSION['id']}");
            unset($_SESSION['new_mail']);
            header("location: /../pages/user_account.php");
        }
        else {
            header('Location: ' . $_SERVER['HTTP_REFERER']. '&error=incorrect');
        }
    } catch (\Throwable $th) {
        header('Location: ' . $_SERVER['HTTP_REFERER'] . '&error=not_a_number');
    }
}

if (isset($_GET['change']) && $_GET['change'] == "phone") {
}

if (isset($_GET['change']) && $_GET['change'] == "address") {
}

if (isset($_GET['change']) && $_GET['change'] == "password") {
}
?>