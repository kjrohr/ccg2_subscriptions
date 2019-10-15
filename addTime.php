<?php
$customer_id = $_REQUEST['customer_id'];
$choice = $_REQUEST['choice'];
$correctDate = $_REQUEST['correctDate'];

try{
    $pdo = new PDO("mysql:host=localhost;dbname=ccg2", "root", "root");
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    die("ERROR: Could not connect. " . $e->getMessage());
}
 
if ($choice == "Yes"){
// Attempt insert query execution
try{
    // Create prepared statement
    //$sql = "DELETE FROM subscriptions where customer_id=:id";
    $sql = "UPDATE subscriptions SET sub_end_date=DATE_ADD(:correctDate, INTERVAL 30 DAY) WHERE customer_id=:id";
    $stmt = $pdo->prepare($sql);
    
    // Bind parameters to statement
    $stmt->bindParam(':id', $customer_id);
    $stmt->bindParam(':correctDate', $correctDate);
    
    // Execute the prepared statement
    $stmt->execute();
    echo "Records updated successfully.";
} catch(PDOException $e){
    die("ERROR: Could not able to execute $sql. " . $e->getMessage());
}
}

// Close connection
unset($pdo);

header("Location: index.php");
?>