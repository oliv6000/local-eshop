<!DOCTYPE html>
<head>
    <title>EW - Login</title>
    <link rel="stylesheet" href="/../styling/create_user.css">
</head>
<html lang="en">
<?php
include '../head.php';
?>

<body>
            
    <div class="container">
        <div>
            <div class="head unselectable">
                <h1>Create user</h1>    
            </div>
            <form action="/../middleware/create_user.php" method="post">
                <div class="content">
                    <input type="text"     placeholder="Full name"                name="name">
                    <input type="number"   placeholder="phone number"             name="phone">
                    <input type="text"     placeholder="Home address with postal" name="address">
                    <input type="email"    placeholder="Email"                    name="mail">
                    <input type="password" placeholder="Password"                 name="pwrd">
                    <input type="password" placeholder="Re-enter password"        name="pwrd">
                </div>
                <div class="login-end">
                    <button class="login" type="submit">Create</button>
                </div>
            </form>
        </div>
    </div>

</body>
<script src="../scripts/create_user.js"></script> 
</html>
