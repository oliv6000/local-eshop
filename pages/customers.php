<!DOCTYPE html>
<head>
    <title>EW - Users overview</title>
    <link rel="stylesheet" href="/../styling/customers.css">
</head>
<html lang="en">
<?php
include '../head.php';
include '../middleware/all_users.php';

if ($_SESSION['role'] != 'administrator' && $_SESSION['role'] != 'worker') {
    header("location: ../pages/home.php");
}

$customers = getCustomers();

?>

<body>
   <h1>This is overview over all customers</h1>
   
    <?php if(count($customers) > 0){ ?>
        <table style="width:650px" class="yo">
            <tr>
                <?php
                    foreach ($customers[0] as $key => $value) {
                        echo '<th>'.$key.'</th>';
                    }
                ?>
                <th>Remove</th>
                <th>Promote</th>
            </tr>
            <?php for ($i=0; $i < count($customers) ; $i++) { ?>
                <tr>
                    <?php foreach ($customers[$i] as $key => $value) { ?>
                        <td><?php echo $value; ?></td>
                    <?php } ?>
                    <form action="../middleware/remove_user.php/?user_id=<?php echo $customers[$i]['id']?>" method="post">
                        <td><button class="delete" type="submit">Remove</button></td>
                    </form>
                    <form action="../middleware/promote_user.php/?user_id=<?php echo $customers[$i]['id']?>" method="post">
                        <td><button class="delete" type="submit">Make worker</button></td>
                    </form>
                </tr>
            <?php } ?>
        </table> 
    <?php } ?>


</body>
</html>
