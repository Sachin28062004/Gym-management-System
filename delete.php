<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gym";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->query("SET FOREIGN_KEY_CHECKS = 0");


// Check if plan_id is set and not empty
if (isset($_POST['plan_id']) && !empty($_POST['plan_id'])) {
    $plan_id = $_POST['plan_id'];

    // Prepare and bind the SQL statement to delete the plan
    $stmt = $conn->prepare("DELETE FROM plans WHERE id = ?");
    $stmt->bind_param("i", $plan_id);

    // Execute the statement
    if ($stmt->execute()) {
        // If deletion is successful, redirect to plans.php
        header("Location: plans.php");
        exit();
    } else {
        // If there's an error, display an error message
        echo "Error deleting plan: " . $conn->error;
    }

    // Close the statement
    $stmt->close();
}
$conn->query("SET FOREIGN_KEY_CHECKS = 0");

// Close the database connection
$conn->close();
?>
