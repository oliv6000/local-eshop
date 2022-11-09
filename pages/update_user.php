<!DOCTYPE html>
<head>
    <title>EW - Update information</title>
    <link rel="stylesheet" href="/../styling/user_account.css">
</head>
<html lang="en">
<?php
    include '../head.php';
    if (Isset($_SESSION['id']) == false) {
        header("location: ../pages/login.php");
    }

    include '../middleware/all_users.php';
    $userData = getUser($_SESSION['id']);
?>

<body>

    <div class="container">
        <div class="content">
            <div class="items">
                <?php if($_GET['change'] == "name") { ?> 
                    <h2>Name change</h2><br>
                    <h3>Current: <?php echo "{$_POST['value']}"; ?></h3>
                    <form action="/../controllers/user.php/?change=<?php echo"{$_GET['change']}"; ?>" method="post">
                        <input name="name" placeholder="New name"><br>
                        <button type="submit">Change</button>
                    </form>
                <?php } ?>

                <?php if($_GET['change'] == "email") { ?> 
                    <h2>Email change</h2><br>
                    <p>Fill in your new mail, and a verification code will be sent to your current.</p>
                    <h3>Current: <?php echo "{$_POST['value']}"; ?></h3>
                    <form action="/../controllers/user.php/?change=<?php echo"{$_GET['change']}"; ?>" method="post">
                        <input name="new_mail" type="email" placeholder="New email"><br>
                        <input type="hidden" name="mail" value="<?php echo "{$_POST['value']}"; ?>">
                        <button type="submit">Send code</button>
                    </form>
                
                <?php } ?>

                <?php if($_GET['change'] == "email-verify") { ?> 
                    <h2>Verify email change</h2><br>
                    <p>To verify the email change, please fill the input field with the code from your mail.</p>
                    <form action="/../controllers/user.php/?change=<?php echo"{$_GET['change']}"; ?>" method="post">
                        <input name="code" placeholder="verification code"><br>
                        <?php 
                        if(isset($_GET['error'])) {
                            if(($_GET['error']) == "incorrect") {
                                echo '<p style="color:red;font-size: 13px;">Code did not match</p>';
                            }
                            else if (($_GET['error']) == "not_a_number") {
                                echo '<p style="color:red;font-size: 13px;">Code was not a number</p>';
                            }
                            }?>
                        <button type="submit">verify</button>
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>
    
</body>
</html>
        