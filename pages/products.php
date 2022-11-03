<!DOCTYPE html>
<head>
    <title>EW - Products overview</title>
    <link rel="stylesheet" href="/../styling/products.css">
</head>
<html lang="en">
<?php
include '../head.php';
include '../middleware/products.php';

if ($_SESSION['role'] != 'administrator' || $_SESSION['role'] != 'worker') {
    //header("location: ../pages/home.php");
}

$products = getProducts();
$archived_products = getArchivedProducts();

?>

<body>
    <h1>This is an overview over all products</h1>
    <div class="content">

        <div class="products">
            <h4>Products</h4>
            <?php if(count($products) > 0){ ?>
                <table style="width:650px" class="yo">
                    <tr>
                        <?php
                        foreach ($products[0] as $key => $value) {
                            if($key == "archived") {break;}
                            echo '<th>'.$key.'</th>';
                        }
                        ?>
                        <th>update</th>
                        <th>archive</th>
                    </tr>

                    <form action="../middleware/products.php/?task=create_product" method="post">
                        <tr>
                            <td>Auto</td>
                            <td><input name="name" type="text" placeholder="name"></td>
                            <td><input name="price" type="number" step="0.01" placeholder="price"></td>
                            <td><input name="description" type="text" placeholder="description"></td>
                            <td><button type="submit" style="background-color: lightgreen;">Create</button></td>
                            <td>Nan</td>
                        </tr>
                    </form>

                    <?php for ($i=0; $i < count($products) ; $i++) { ?>
                        <tr>
                            <form action="../middleware/products.php/?task=update_product" method="post">
                                <?php foreach ($products[$i] as $key => $value) { if($key == "archived") {break;} if($key == "id") {echo "<td> $value </td>"; continue;} ?>
                                <td><input name="<?php echo $value; ?>" value="<?php echo $value; ?>"></td>
                                <?php } ?>
                                <td><button class="delete" type="submit">Update</button></td>
                            </form>
                                <form action="../middleware/products.php/?archive_id=<?php echo $products[$i]['id']?>" method="post">
                                    <td><button class="delete" type="submit">Archive</button></td>
                                </form>

                        </tr>
                    <?php } ?>
                </table> 
            <?php } ?>
        </div>
                
        <div class="archived-products">
            <h4>Archived products</h4>
            <?php if(count($archived_products) > 0){ ?>
                <table style="width:650px" class="yo">
                    <tr>
                        <?php
                        foreach ($archived_products[0] as $key => $value) {
                            echo '<th>'.$key.'</th>';
                        }
                        ?>
                        <th>Unarchive</th>
                        <th>Promote</th>
                    </tr>
                    <?php for ($i=0; $i < count($archived_products) ; $i++) { ?>
                    <tr>
                        <?php foreach ($archived_products[$i] as $key => $value) { ?>
                            <td><?php echo $value; ?></td>
                        <?php } ?>
                        <form action="../middleware/products.php/?unarchive_id=<?php echo $archived_products[$i]['id']?>" method="post">
                            <td><button class="delete" type="submit">Unarchive</button></td>
                        </form>
                        <form action="../middleware/promote_user.php/?user_id=<?php echo $archived_products[$i]['id']?>" method="post">
                            <td><button class="delete" type="submit">Make worker</button></td>
                        </form>
                        </tr>
                    <?php } ?>
                </table> 
            <?php } ?>
        </div>
    </div>
            
        </body>
        </html>
        