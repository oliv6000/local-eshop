<!DOCTYPE html>
<head>
    <title>EW - Products overview</title>
    <link rel="stylesheet" href="/../styling/products.css">
</head>
<html lang="en">
<?php
    include '../head.php';

    if ($_SESSION['role'] != 'administrator' && $_SESSION['role'] != 'worker') {
        header("location: ../pages/home.php");
    }
    include_once '../classes/products.class.php';

    $productController = new Products();

    $products = $productController->getProducts();
    $archived_products = $productController->getArchivedProducts();
?>

<body>
    <h1>This is an overview over all products</h1>
    <div class="content">

        <div class="products">
            <h4>Products</h4>
            <?php if(count($products) >= 0){ ?>
                <table style="width:650px" class="productTable">
                    <tr>
                        <th>id</th>
                        <th>name</th>
                        <th>price</th>
                        <th>description</th>
                        <th>discount percentage</th>
                        <th>archive</th>
                        <th>update</th>
                    </tr>

                    <form action="../controllers/products.controller.php/?method=create" method="post">
                        <tr>
                            <p style="color:red;"><?php if(isset($_SESSION['error']) && $_SESSION['error'] == "no_product_name") { echo 'Product creation or update requires a name'; } ?></p>
                            <td>Auto</td>
                            <td><input name="product_name" type="text" placeholder="name"></td>
                            <td><input name="price" type="number" step="0.01" placeholder="price"></td>
                            <td><input class="limit" name="description" type="text" placeholder="description"></td>
                            <td>Nan</td>
                            <td>Nan</td>
                            <td><button type="submit" style="background-color: lightgreen;">Create</button></td>
                        </tr>
                    </form>

                    <?php for ($i=0; $i < count($products) ; $i++) { ?>
                        <tr>
                            <form action="../controllers/products.controller.php/?method=update" method="post">
                                <?php foreach ($products[$i] as $key => $value) { if($key == "archived") {continue;} if($key == "id") {echo "<td><input type='hidden' name='id' value='{$value}'> $value </td>"; continue;} ?>
                                    <td><input type ="<?php if($key == "price" || $key == "discount_percentage") {echo 'number';} else {echo 'text';} ?>" name="<?php echo $key; ?>" value="<?php echo $value; ?>"></td>
                                <?php } ?>
                                <td><button class="delete" type="submit">Update</button></td>
                            </form>
                            <form action="../controllers/products.controller.php/?method=archive" method="post">
                                <input type="hidden" name="id" value="<?php echo $products[$i]['id']?>">
                                <td><button class="delete" type="submit">Archive</button></td>
                            </form>
                        </tr>
                    <?php } ?>
                </table> 
            <?php } ?>
        </div>
                
        <div class="archived-products">
            <h4>Archived products</h4>
            <table style="width:650px" class="productTable">
                <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>price</th>
                    <th>description</th>
                    <th>discount percentage</th>
                    <th>Unarchive</th>
                </tr>
                <?php for ($i=0; $i < count($archived_products) ; $i++) { ?>
                <tr>
                    <form action="../controllers/products.controller.php/?method=unarchive" method="post">
                        <?php foreach ($archived_products[$i] as $key => $value) { if ($key=="archived") {continue;} if($key=="id"){echo"<input type='hidden' name='id' value='{$value}'>";}?>
                            <td><?php echo $value; ?></td>
                        <?php } ?>
                        <td><button class="delete" type="submit">Unarchive</button></td>
                    </form>
                    </tr>
                <?php } ?>
            </table> 
        </div>
    </div>
            
        </body>
        </html>
        