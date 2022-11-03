<!DOCTYPE html>
<head>
    <title>EW - Workers overview</title>
    <link rel="stylesheet" href="/../styling/workers.css">
</head>
<html lang="en">
<?php
include '../head.php';
include '../middleware/all_users.php';

if ($_SESSION['role'] != 'administrator') {
    header("location: ../pages/home.php");
}

$workers = getWorkers();

?>

<body>
   <h1>This is an overview over all workers</h1>
   
   <?php if(count($workers) > 0){ ?>
        <table style="width:650px" class="yo">
            <tr>
                <?php
                    foreach ($workers[0] as $key => $value) {
                        echo '<th>'.$key.'</th>';
                    }
                ?>
                <th>Remove</th>
            </tr>
            <?php for ($i=0; $i < count($workers) ; $i++) { ?>
                <tr>
                    <?php foreach ($workers[$i] as $key => $value) { ?>
                        <td><?php echo $value; ?></td>
                    <?php } ?>
                    <form action="../middleware/remove_user.php" method="post">
                        <input name="id" type="hidden" value="<?php echo $workers[$i]['id'] ?>">
                        <td><button class="delete" type="submit">Remove</button></td>
                    </form>
                </tr>
            <?php } ?>
        </table> 
    <?php } ?>


</body>
</html>
