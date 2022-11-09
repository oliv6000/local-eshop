<!DOCTYPE html>
<?php
include '../head.php';
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Local-eshop | Cart</title>
    <link rel="stylesheet" href="/../styling/home.css">
</head>
<body>
    <h1>This is the cart page</h1>
    <div class="content">

    <div class="products">
        <h4>Products</h4>
        <table style="width:650px" class="productTable">
            <tr>
                <th>name</th>
                <th>price</th>
                <th>description</th>
                <th>Remove from cart</th>
            </tr>
            <?php if(isset($_SESSION['cart']) && count($_SESSION['cart']) >= 0){ ?>
                <?php for ($i=0; $i < count($_SESSION['cart']) ; $i++) { ?>
                    <tr>
                        <td><?php echo $_SESSION['cart'][$i]['name']; ?></td>
                        <td>
                            <?php 
                                if($_SESSION['cart'][$i]['discount_percentage'] != null) {
                                    echo $_SESSION['cart'][$i]['price'] - ($_SESSION['cart'][$i]['price'] * ($_SESSION['cart'][$i]['discount_percentage'] / 100));
                                } else {
                                    echo $_SESSION['cart'][$i]['price']; 
                                }
                            ?>
                        </td>
                        <td><?php echo $_SESSION['cart'][$i]['description']; ?></td>
                        <form action="/../controllers/product.controller.php/?method=remove_from_cart" method="post">
                            <input type="hidden" name="id" value="<?php echo $i; ?>">
                            <td><button style="background-color:lightgreen;">remove</button></td>
                        </form>
                    </tr>
                <?php } ?>
            <?php } ?>
        </table> 
    </div>

    <div class="on-sale-products">

    </div>

    </div>
</body>
</html>