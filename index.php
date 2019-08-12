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
while ($row = $stmt->fetch())
{
    echo $row['first_name'] . "\n";
    echo $row['last_name'] . "\n";
    echo $row['sub_start_date'] . "\n";
    echo $row['sub_end_date'] . "\n";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CCG2 Premium Subscriptions</title>
</head>
<body>
    <table>
        <tr>
        <td>First Name</td>
        <td>Last Name</td>
        <td>Subscription Start</td>
        <td>Subscription End</td>
        </tr>

    </table>
</body>
</html>