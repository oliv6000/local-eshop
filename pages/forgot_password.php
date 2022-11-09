<!DOCTYPE html>
<head>
    <title>EW - Forgot password</title>
    <link rel="stylesheet" href="/../styling/forgot_password.css">
</head>
<html lang="en">
<?php
    include '../head.php';

    include_once '../classes/users.class.php';
    include_once '../classes/mailing.class.php';

    $userController = new Users();
?>

<body>

    <div class="container">
        <div class="content">
            <div class="items">
                <?php if (!isset($_GET['method'])) {?>
                    <form action="/pages/forgot_password.php/?method=resetPassword" method="post">
                        <div class="change">
                            <h1>Forgot password</h1>
                        </div>
                        <div class="change">
                            <p>Email to to your account</p>
                        </div>
                        <?php if(isset($_SESSION['error']) && $_SESSION['error'] == "userNotFound") { ?>
                            <p style="color:red;">Could not find user with given mail</p>
                        <?php } ?>
                        <div class="change">
                            <input type="email" name="email" placeholder="Email">
                        </div>
                        <div class="change">
                            <button>update password</button>
                        </div>
                    </form>
                <?php } ?>

                <?php if (isset($_GET['method']) && $_GET['method'] == "resetPassword") { 
                    $user = $userController->getUserWithEmail($_POST['email']);
                    if (!$user) {$_SESSION['error'] = "userNotFound"; header('Location: ' . $_SERVER['HTTP_REFERER']); exit;} else {unset($_SESSION['error']);}
                    $password = $random = rand(1111111,9999999);
                    $userController->updatePassword($password, $user['id']);
                    $sentCode = (new Mail())->sendTempPass($password, $_POST['email']);
                ?>
                    <p>You have been sent a temporary password</p><br>
                    <p>login with the given password and go to account to change it.</p>
                    <form action="/pages/login.php">
                        <button>Go to login</button>
                    </form>
                <?php } ?>
                    
            </div>
        </div>
    </div>
    
</body>
</html>
        