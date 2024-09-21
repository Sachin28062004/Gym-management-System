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

// Initialize variables
$plan_name = $amount = $duration = "";
$plan_id = $_GET['id'] ?? null;

// Fetch the plan details from the database
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['plan_id'])) {
    $plan_id = $_POST['plan_id'];

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("SELECT * FROM plans WHERE id = ?");
    $stmt->bind_param("i", $plan_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $plan_name = $row["plan_name"];
        $amount = $row["amount"];
        $duration = $row["duration"];
    } else {
        echo "Plan not found.";
        exit;
    }

    $stmt->close();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $updated_plan = $_POST["plan_name"];
    $updated_amount = $_POST["amount"];
    $updated_duration = $_POST["duration"];
    $plan_id = $_POST['plan_id'];

    // Update the plan details in the database
    $stmt = $conn->prepare("UPDATE plans SET plan_name = ?, amount = ?, duration = ? WHERE id = ?");
    $stmt->bind_param("sdsi", $updated_plan, $updated_amount, $updated_duration, $plan_id);

    if ($stmt->execute()) {
        echo "Plan details updated successfully.";
        header("Location: plans.php");
        exit();
    } else {
        echo "Error updating plan details: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>


<!DOCTYPE html>
<html>
<head>
    <title>Gym Management - Edit Plan</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="style1.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Gym Management</h1>
            <nav>
                <ul>
                <li><button onclick="window.location.href='index.php';">Home</button></li>
                <li><button onclick="window.location.href='plans.php';">Our Plans</button></li>
                <li><button onclick="window.location.href='registration.php';">Registration</button></li>
                <li><button onclick="window.location.href='equipments.php';">Equipments</button></li>
                <li><button onclick="window.location.href='logout.php';">Logout</button></li>
                </ul>
            </nav>
        </header>

        <main>
            <h2>Edit Plan</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="hidden" name="plan_id" value="<?php echo $plan_id; ?>">

                <label>PLAN NAME:</label>
                <input type="text" name="plan_name" value="<?php echo $plan_name; ?>">

                <label>AMOUNT:</label>
                <input type="number" name="amount" value="<?php echo $amount; ?>">

                <label>DURATION:</label>
                <input type="text" name="duration" value="<?php echo $duration; ?>">

                <input type="submit" name="update" value="EDIT PLAN DETAILS" class="btn">
            </form>
        </main>

    </div>
</body>
</html>