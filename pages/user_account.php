<!DOCTYPE html>
<head>
    <title>EW - Account overview</title>
    <link rel="stylesheet" href="/../styling/user_account.css">
</head>
<html lang="en">
<?php
    include '../head.php';
    if (Isset($_SESSION['id']) == false) {
        header("location: ../pages/login.php");
    }

    include_once '../classes/users.class.php';
    include_once '../classes/mailing.class.php';

    $userData = (new Users())->getUser($_SESSION['id']);
?>

<body>

    <div class="container">
        <div class="content">
            <div class="items">
                <?php if (!isset($_GET['method'])) {?>
                    <div class="change">
                        <h3><?php echo $userData["name"]; ?></h3>
                    </div>
                    <div class="change">
                        <h3><?php echo $userData["email"]; ?></h3>
                    </div>
                    <div class="change">
                        <h3><?php echo $userData["phone"]; ?></h3>
                    </div>
                    <div class="change">
                        <h3><?php echo $userData["address"]; ?></h3><br>
                    </div>
                    <div class="buttons">
                        <form action="/pages/user_account.php/?method=updateInfo" method="post">
                            <button>update info</button>
                        </form>
                        <form action="/pages/user_account.php/?method=updatePassword" method="post">
                            <button>update password</button>
                        </form>
                    </div>
                <?php } ?>

                <?php if (isset($_GET['method']) && $_GET['method'] == "updateInfo") {?>
                    <form action="/pages/user_account.php" method="get">
                        <input type="hidden" name="method" value="verify_info">
                        Name: <input name="name" type="text" value="<?php echo $userData["name"]; ?>"><br>
                        Email: <input name="email" type="email" value="<?php echo $userData["email"]; ?>"><br>
                        Number: <input name="phone" type="number" value="<?php echo $userData["phone"]; ?>"><br>
                        Address: <input name="address" value="<?php echo $userData["address"]; ?>"><br>
                        <button class="submitButton">Update info</button>
                    </form>
                <?php } ?>
                <?php if (isset($_GET['method']) && $_GET['method'] == "verify_info") { ?>
                    <form action="/../controllers/users.controller.php/?method=verify_info_code" method="post">
                        <input type="hidden" name="name" value="<?php echo $_GET['name']; ?>">
                        <input type="hidden" name="email" value="<?php echo $_GET['email']; ?>">
                        <input type="hidden" name="phone" value="<?php echo $_GET['phone']; ?>">
                        <input type="hidden" name="address" value="<?php echo $_GET['address']; ?>">
                        <?php if(isset($_SESSION['error']) && $_SESSION['error'] == "wrong_code") {
                            echo '<p style="color:red;">Code does not match</p>';
                        } else {
                            $sentCode = (new Mail())->sendUpdateInfoVerfMail($userData["email"]);
                        }
                        
                        ?>
                        <p>An email has been sent to you with a verification code.</p><br>
                        <p>Fill in the input bellow with the code on your mail, to update your information.</p><br>
                        <input type="number" name="verf_code" placeholder="verification code">
                        <button class="submitButton">verify</button>
                    </form>
                <?php } ?>

                <?php if (isset($_GET['method']) && $_GET['method'] == "updatePassword") {?>
                    <form action="/pages/user_account.php/?method=verify_password" method="get">
                        <input type="hidden" name="method" value="verify_password">
                        New password: <input name="new_password" type="password"><br>
                        <?php if(isset($_SESSION['error']) && $_SESSION['error'] = "passwordNoMatch") {echo "<p style='color:red;'>Passwords did not match</p>";} ?>
                        Repeat password: <input name="re_password" type="password"><br>
                        <button class="submitButton">Update password</button>
                    </form>
                <?php } ?>

                <?php if (isset($_GET['method']) && $_GET['method'] == "verify_password") { 
                    if ($_GET['new_password'] != $_GET['re_password']) {$_SESSION['error'] = "passwordNoMatch"; header('Location: ' . $_SERVER['HTTP_REFERER']); exit;} else {unset($_SESSION['error']);}
                    ?>
                    <form action="/../controllers/users.controller.php/?method=verify_password" method="post">
                        <p>You have been sent a email with a verification code, to verify you asked for the change</p>
                        <input type="hidden" name="new_password" value="<?php echo $_GET['new_password']; ?>">
                        <?php if(isset($_SESSION['error']) && $_SESSION['error'] == "wrong_code") {
                            echo '<p style="color:red;">Code does not match</p>';
                        } else {
                            $sentCode = (new Mail())->sendUpdateInfoVerfMail($userData["email"]);
                        }
                        
                        ?>
                        <input type="number" name="verf_code" placeholder="verification code">
                        <button class="submitButton">verify</button>
                    </form>
                <?php } ?>
                
            </div>
        </div>
    </div>
    
</body>
</html>
        