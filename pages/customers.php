<!DOCTYPE html>
<head>
    <title>EW - Users overview</title>
    <link rel="stylesheet" href="/../styling/customers.css">
</head>
<html lang="en">
<?php
include '../head.php';
include_once '../classes/users.class.php';


if ($_SESSION['role'] != 'administrator' && $_SESSION['role'] != 'worker') {
    header("location: ../pages/home.php");
}

$customers = (new Users())->getCustomers();
?>

<body>
   <h1>This is overview over all customers</h1>
   
    <?php if(count($customers) > 0){ ?>
        <table style="width:650px" class="yo">
            <tr>
                <th>id</th>
                <th>name</th>
                <th>email</th>
                <th>phone</th>
                <th>address</th>
                <?php if($_SESSION['role'] == 'administrator') {echo '<th>promote</th>';} ?>
            </tr>
            <?php for ($i=0; $i < count($customers) ; $i++) { ?>
                <tr>
                    <td><?php echo $customers[$i]['id']; ?></td>
                    <td><?php echo $customers[$i]['name']; ?></td>
                    <td><?php echo $customers[$i]['email']; ?></td>
                    <td><?php echo $customers[$i]['phone']; ?></td>
                    <td><?php echo $customers[$i]['address']; ?></td>
                    <?php if($_SESSION['role'] == 'administrator') { ?>
                        <form action="../controllers/users.controller.php/?method=promote" method="post">
                            <input name="id" type="hidden" value="<?php echo $customers[$i]['id']?>">
                            <td><button class="delete" type="submit">promote</button></td>
                        </form>
                    <?php } ?>
                </tr>
            <?php } ?>
        </table> 
    <?php } ?>


</body>
</html>
