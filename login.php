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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the user input
    $admin_name = $_POST["admin_name"];
    $password = $_POST["password"];

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("SELECT * FROM admins WHERE admin_name = ? AND password = ?");
    $stmt->bind_param("ss", $admin_name, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    // Check if login is successful
    if ($result->num_rows > 0) {
        // Redirect to index.php upon successful login
        header("Location: index.php");
        exit;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gym Management</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Gym Management</h1>
        <div class="login-box">
            <h2>Admin Login</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <label for="admin_name">Admin Name</label>
                <input type="text" id="admin_name" name="admin_name" placeholder="Enter UserName" required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter Password" required>

                <input type="submit" value="Login">
            </form>
        </div>
    </div>
</body>
</html>
