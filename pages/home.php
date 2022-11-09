<!DOCTYPE html>
<?php
include '../head.php';
include_once '../classes/products.class.php';
$productController = new Products();
$NoDiscountProducts = $productController->getNonDiscountProducts();
$discountedProducts = $productController->getDiscountedProducts();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="/../styling/home.css">
</head>
<body>
    <h1>This is the home page</h1>
    <div class="content">

    <div class="products">
        <h4>Products</h4>
        <table style="width:650px" class="productTable">
            <tr>
                <th>name</th>
                <th>price</th>
                <th>description</th>
                <th>Add to cart</th>
            </tr>
            <?php if(count($NoDiscountProducts) >= 0){ ?>
                <?php for ($i=0; $i < count($NoDiscountProducts) ; $i++) { ?>
                    <tr>
                        <td><?php echo $NoDiscountProducts[$i]['name']; ?></td>
                        <td><?php echo $NoDiscountProducts[$i]['price']; ?></td>
                        <td><?php echo $NoDiscountProducts[$i]['description']; ?></td>
                        <form action="/../controllers/product.controller.php/?method=add_to_cart" method="post">
                            <input type="hidden" name="id" value="<?php echo $NoDiscountProducts[$i]['id']; ?>">
                            <td><button style="background-color:lightgreen;">Add</button></td>
                        </form>
                    </tr>
                <?php } ?>
            <?php } ?>
        </table> 
    </div>

    <div class="on-sale-products">
    <h4>Products on sale</h4>
        <table style="width:650px" class="productTable">
            <tr>
                <th>name</th>
                <th>price</th>
                <th>sale percentage</th>
                <th>description</th>
                <th>Add to cart</th>
            </tr>
            <?php if(count($discountedProducts) >= 0){ ?>
                <?php for ($i=0; $i < count($discountedProducts) ; $i++) { ?>
                    <tr>
                        <td><?php echo $discountedProducts[$i]['name']; ?></td>
                        <td><?php echo $discountedProducts[$i]['price'] - ($discountedProducts[$i]['price'] * ($discountedProducts[$i]['discount_percentage'] / 100)) ; ?></td>
                        <td><?php echo $discountedProducts[$i]['discount_percentage'].'%'; ?></td>
                        <td><?php echo $discountedProducts[$i]['description']; ?></td>
                        <form action="/../controllers/product.controller.php/?method=add_to_cart" method="post">
                            <input type="hidden" name="id" value="<?php echo $discountedProducts[$i]['id']; ?>">
                            <td><button style="background-color:lightgreen;">Add</button></td>
                        </form>
                    </tr>
                <?php } ?>
            <?php } ?>
        </table> 
    </div>

    </div>
</body>
</html>