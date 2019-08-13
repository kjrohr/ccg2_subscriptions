<?php 
 $customer_id = $_POST['id'];
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
 
 $stmt = $pdo->prepare("SELECT * FROM subscriptions WHERE customer_id=:id");
 $stmt->execute(['id' => $customer_id]); 
 $user = $stmt->fetch();


 $first_name = $user['first_name'];
 $last_name = $user['last_name'];
 
// Close connection
unset($pdo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="css/styles.css" rel="stylesheet" />
    <title>Add Time to <?php echo $first_name. ' ' . $last_name ?>?</title>

</head>
<body>
<?php
include "header.php";
?>
    <h2>Do you want to add time to <?php echo $first_name . ' ' . $last_name ?>?</h2>

    <form action="addTime.php" method="post">
        <p>
            <input type="submit" name="choice" value="Yes">
        </p>
        <p>
            <input type="submit" name="choice" value="No">
        </p>
        <input type="hidden" name="customer_id" value="<?php echo $customer_id ?>">
    </form>
    <script src="js/main.js"></script>
</body>
</html>