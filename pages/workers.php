<!DOCTYPE html>
<head>
    <title>EW - Workers overview</title>
    <link rel="stylesheet" href="/../styling/workers.css">
</head>
<html lang="en">
<?php
include '../head.php';
include_once '../classes/users.class.php';

if ($_SESSION['role'] != 'administrator') {
    header("location: ../pages/home.php");
}

$workers = (new Users())->getWorkers();

?>

<body>
   <h1>This is an overview over all workers</h1>
   
   <table style="width:650px" class="yo">
        <tr>
            <th>id</th>
            <th>name</th>
            <th>email</th>
            <th>phone</th>
            <th>address</th>
            <th>demote</th>
        </tr>
        <tr>
            <form action="../controllers/users.controller.php/?method=create_worker" method="post">
                <td>Nan</td>
                <td><input type="text" name="name" placeholder="Full name"></td>
                <td><input type="email" name="email" placeholder="Email"></td>
                <td><input type="number" name="phone" placeholder="Phone number"></td>
                <td><input type="text" name="address" placeholder="Full address ex. (trosroad 17, 7620 Lemvig)"></td>
                <td><button>Create</button></td>
            </form>
        </tr>
        <?php if(count($workers) > 0){ ?>
            <?php for ($i=0; $i < count($workers) ; $i++) { ?>
                <tr>
                    <?php
                        echo "<td>{$workers[$i]['id']}</td>";
                        echo "<td>{$workers[$i]['name']}</td>";
                        echo "<td>{$workers[$i]['email']}</td>";
                        echo "<td>{$workers[$i]['phone']}</td>";
                        echo "<td>{$workers[$i]['address']}</td>";
                    ?>
                    <form action="../controllers/users.controller.php/?method=demote" method="post">
                        <input name="id" type="hidden" value="<?php echo $workers[$i]['id'] ?>">
                        <td><button class="delete" type="submit">demote</button></td>
                    </form>
                </tr>
            <?php } ?>
        <?php } ?>
    </table> 


</body>
</html>
