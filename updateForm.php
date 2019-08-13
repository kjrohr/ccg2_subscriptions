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


// Close connection
unset($pdo);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body>
<?php
include "header.php";
?>
<form action="update.php" method="post">
    <p>
        <label for="firstName">First Name: </label>
        <input type="text" name="first_name" id="firstName" value="<?php echo $user['first_name'] ?>" placeholder="Do not leave blank" required autofocus>
    </p>
    <p>
        <label for="lastName">Last Name: </label>
        <input type="text" name="last_name" id="lastName" value="<?php echo $user['last_name'] ?>" placeholder="Do not leave blank" required>
    </p>
    <p>
        <label for="subStartDate">Subscription Start Date: </label>
        <input type="text" name="sub_start_date" id="subStartDate" value="<?php echo $user['sub_start_date'] ?>" placeholder="YYYY-MM-DD"required>
    </p>
    <p>
        <label for="subEndDate">Subscription End Date: </label>
        <input type="text" name="sub_end_date" id="subEndDate" value="<?php echo $user['sub_end_date'] ?>" placeholder="YYYY-MM-DD" required>
    </p>
    <input type="hidden" name="customer_id" value="<?php echo $customer_id ?>" >
    <input type="submit" value="Submit">

</form>



<script src="js/main.js"></script>
</body>
</html>