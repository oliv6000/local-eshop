<!DOCTYPE html>
<head>
    <title>EW - Login</title>
    <link rel="stylesheet" href="/../styling/login.css">
</head>
<html lang="en">
<?php
include '../head.php';
?>

<body>
            
    <div class="login-container">
        <div>
            <div class="login-head unselectable">
                <h1>Login</h1>    
            </div>
            <form action="/../middleware/login_auth.php" method="post">
                <div class="login-content">
                    <input type="email" placeholder="Email" name="mail">
                    <?php
                        if (Isset($_GET['error']) && $_GET['error'] == "wrong-email") {
                                echo '<p style="font-size:13px;margin-bottom:5px;color:red;">Email does not exist</p>';
                        }
                    ?>

                    <input type="password" placeholder="Password" name="pwrd">
                </div>
                    <?php
                        if (Isset($_GET['error']) && $_GET['error'] == "wrong-password") {
                                echo '<p style="font-size:13px;margin-bottom:5px;color:red;">Password does not match</p>';
                        }
                    ?>
                <div class="login-end">
                    <button class="login" type="submit">Login</button>
            </form>
                    <a href="/pages/forgot_password.php" class="forgot-link">Forgot password</a>
                </div>
            </div>
            <button onclick="location.href = 'create_user.php';" class="create_user" >Create a user</button>

    </div>

</body>
</html>
