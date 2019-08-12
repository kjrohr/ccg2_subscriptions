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

$stmt = $pdo->query('SELECT first_name, last_name, sub_start_date, sub_end_date FROM subscriptions');


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CCG2 Premium Subscriptions</title>
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body>

<form action="insert.php" method="post">
    <p>
        <label for="firstName">First Name: </label>
        <input type="text" name="first_name" id="firstName">
    </p>
    <p>
        <label for="lastName">Last Name: </label>
        <input type="text" name="last_name" id="lastName">
    </p>
    <input type="submit" value="Submit">

</form>
<br />
    <table>
    <thead>
        <tr>
        <td>First Name</td>
        <td>Last Name</td>
        <td>Subscription Start</td>
        <td>Subscription End</td>
        <td>Status</td>
        </tr>
    </thead>
        <?php
        
            while ($row = $stmt->fetch()){
            ?>
            <tr class="row">
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
            ?>
            <?php
            }
        ?>
    </table>



<script src="js/main.js"></script>
</body>
</html>