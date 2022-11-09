<head>
    <link rel="stylesheet" href="/styling/navbar.css">
</head>
<body>
    <div class="navbar-container">

        <div class="navbar-item">
            <a href="/pages/home.php" class="fill-div navbar-item unselectable">Home</a>
        </div>

        <?php if(isset($_SESSION["id"])) { ?>

            <?php
            if(isset($_SESSION["role"]) && $_SESSION["role"] == "administrator" || $_SESSION["role"] == "worker") {
            ?>
                <div class="navbar-item">
                    <a href="/pages/customers.php" class="fill-div navbar-item unselectable">Customers</a>
                </div>
                <div class="navbar-item">
                    <a href="/pages/products.php" class="fill-div navbar-item unselectable">Products</a>
                </div>
            <?php } ?>

            <?php
            if(isset($_SESSION["role"]) && $_SESSION["role"] == "administrator") {
            ?>
                <div class="navbar-item">
                    <a href="/pages/workers.php" class="fill-div navbar-item unselectable">Workers</a>
                </div>
            <?php } ?>

            
            <?php
            $parsedID = (float)$_SESSION["id"];
            if($parsedID >= 0) {
                ?>
                <div class="navbar-item">
                    <a href="/pages/user_account.php" class="fill-div navbar-item unselectable">Account</a>
                </div>
                <?php if(!isset($_SESSION['cart'])) { ?>
                    <div class="navbar-item">
                        <a href="/pages/cart.php" class="fill-div navbar-item unselectable">Cart</a>
                    </div>
                <?php } else { ?>
                    <div class="navbar-item">
                        <a href="/pages/cart.php/?method=cart" class="fill-div navbar-item unselectable">Cart(<?php  echo count($_SESSION['cart']); ?>)</a>
                    </div>
                <?php } ?>
                <div class="navbar-item">
                    <a href="/../middleware/logout.php" class="fill-div navbar-item unselectable">Log out</a>
                </div>
                <?php } ?>
                
                
        <?php    
        } 
        else {
        ?>
            <div class="navbar-item">
                <a href="/pages/login.php" class="fill-div navbar-item unselectable">Login</a>
            </div>
        <?php } ?>
                
    </div>
    
</body>
</html>