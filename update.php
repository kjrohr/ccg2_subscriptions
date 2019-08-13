<?php

echo $_REQUEST['customer_id'];

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
    $sql = "UPDATE subscriptions SET first_name = :first_name, last_name = :last_name, sub_start_date = :sub_start_date, sub_end_date = :sub_end_date where customer_id = :id";
    $stmt = $pdo->prepare($sql);
    
    // Bind parameters to statement
    $stmt->bindParam(':first_name', $_REQUEST['first_name']);
    $stmt->bindParam(':last_name', $_REQUEST['last_name']);
    $stmt->bindParam(':sub_start_date', $_REQUEST['sub_start_date']);
    $stmt->bindParam(':sub_end_date', $_REQUEST['sub_end_date']);
    $stmt->bindParam(':id', $_REQUEST['customer_id']);
    
    // Execute the prepared statement
    $stmt->execute();
    echo "Records updated successfully.";
} catch(PDOException $e){
    die("ERROR: Could not able to execute $sql. " . $e->getMessage());
}
 
// Close connection
unset($pdo);

header("Location: index.php");
?>