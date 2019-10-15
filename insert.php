<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
try{
    $pdo = new PDO("mysql:host=localhost;dbname=ccg2", "root", "root");
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    die("ERROR: Could not connect. " . $e->getMessage());
}
 
// Attempt insert query execution
try{
    // Create prepared statement
    $sql = "INSERT INTO subscriptions (first_name, last_name, sub_start_date, sub_end_date, created_at) VALUES (:first_name, :last_name, now(), DATE_ADD(NOW(), interval 30 day), now())";
    $stmt = $pdo->prepare($sql);
    
    // Bind parameters to statement
    $stmt->bindParam(':first_name', $_REQUEST['first_name']);
    $stmt->bindParam(':last_name', $_REQUEST['last_name']);

    
    // Execute the prepared statement
    $stmt->execute();
    echo "Records inserted successfully.";
} catch(PDOException $e){
    die("ERROR: Could not able to execute $sql. " . $e->getMessage());
}
 
// Close connection
unset($pdo);

header("Location: index.php");
?>