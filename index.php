<?php
$host = 'localhost';
$db   = 'ccg2';
$user = 'root';
$pass = 'root';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

$stmt = $pdo->query('SELECT customer_id, first_name, last_name, sub_start_date, sub_end_date FROM subscriptions');


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <title>CCG2 Premium Subscriptions</title>
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body>
<?php
include "header.php";
?>
<form action="insert.php" method="post" name="addForm" id="addForm">
    <h2>Add new Subscriber</h2>
    <p>
        <label for="firstName">First Name: </label>
        <input type="text" name="first_name" id="firstName" placeholder="Do not leave blank" required autofocus>
    </p>
    <p>
        <label for="lastName">Last Name: </label>
        <input type="text" name="last_name" id="lastName" placeholder="Do not leave blank" required>
    </p>
    <input type="submit" value="Submit">

</form>
<hr />
<br />
    <table>
    <thead>
        <tr>
        <td>ID</td>
        <td>First Name</td>
        <td>Last Name</td>
        <td>Subscription Start</td>
        <td>Subscription End</td>
        <td>Status</td>
        <td colspan="3">Actions</td>
        </tr>
    </thead>
        <?php
            // ****** GENERATE CSV ******
            $file = fopen("output/backup.csv","w");
            fputcsv($file,array('first_name','last_name','sub_start_date','sub_end_date'));
        
            while ($row = $stmt->fetch()){
            ?>
            <tr class="row">
            <td><?php echo $row['customer_id'] ?></td>
            <td><?php echo $row['first_name'] ?></td>
            <td><?php echo $row['last_name'] ?></td>
            <td><?php echo $row['sub_start_date']  ?></td>
            <td><?php echo $row['sub_end_date']  ?></td>
            <?php 
            $now = date("Y-m-d");
            if ($now > $row['sub_end_date'])
            {
            ?>
            <td class="status">Expired</td>
            <?php
            }
            else
            {
                ?>
                <td>Active</td>
                <?php
            }
            
            echo "<td><form action='updateForm.php' method='post'><input type='hidden' name='id' value='". $row['customer_id'] ."' /><input id='" . $row['customer_id'] . "' type='submit' value='Update' /></form>";
            echo "<td><form action='deleteConfirm.php' method='post'><input type='hidden' name='id' value='". $row['customer_id'] ."' /><input id='" . $row['customer_id'] . "' type='submit' value='Delete' /></form>";
            echo "<td><form action='continueSub.php' method='post'><input type='hidden' name='id' value='". $row['customer_id'] ."' /><input id='" . $row['customer_id'] . "' type='submit' value='Add Time' /></form>";
            ?>
            </tr>
            <?php



            fputcsv($file, array($row['first_name'], $row['last_name'],$row['sub_start_date'],$row['sub_end_date']));
            }
            fclose($file);
            // ****** END GENERATE CSV ******
        ?>
        
    </table>



<script src="js/main.js"></script>
</body>
</html>