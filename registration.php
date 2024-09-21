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

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $mobile = $_POST["mobile"];
    $email = $_POST["email"];
    $age = $_POST["age"];
    $gender = $_POST["gender"];
    $plan_id = $_POST["plan_name"];

    // Insert the user data into the users table
    $sql = "INSERT INTO users (name, mobile, email, age, gender, plan_id) VALUES ('$name', '$mobile', '$email', $age, '$gender', $plan_id)";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
        // Redirect to index.php
        header("Location: registration.php");
        exit(); // Make sure to exit after redirecting
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
}

// Fetch plans from the database for the dropdown
$sql = "SELECT id, plan_name FROM plans"; // Assuming the column name for plan name is "plan_name"
$result = $conn->query($sql);

// Fetch members from the database
$sql = "SELECT name, mobile, email, age, gender, plan_id FROM users"; // Assuming the column names for duration and payment exist
$members_result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gym Management - Registration</title>
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
            <div class="registration-form">
                <h2>--USER REGISTRATION FOR GYM--</h2>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <label>NAME</label>
                    <input type="text" name="name" required>

                    <label>MOBILE</label>
                    <input type="text" name="mobile" required>

                    <label>Email</label>
                    <input type="email" name="email" required>

                    <label>AGE</label>
                    <input type="number" name="age" required>

                    <label>GENDER</label>
                    <div class="gender-radio">
                        <input type="radio" name="gender" value="male" id="male" required>
                        <label for="male">Male</label>
                        <input type="radio" name="gender" value="female" id="female" required>
                        <label for="female">Female</label>
                    </div>

                    <label>PLAN</label>
                    <select name="plan_name" required>
                        <option value="">Select Plan</option>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row["id"] . "'>" . $row["plan_name"] . "</option>";
                            }
                        }
                        ?>
                    </select>

                    <input type="submit" value="Register">
                </form>
            </div>

            <div class="members-list">
                <h2>Our Members...</h2>
                <table>
                    <tr>
                        <th>NAME</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>AGE</th>
                        <th>Duration</th>
                        <th>Payment</th>
                    </tr>
                    <?php
                    if ($members_result->num_rows > 0) {
                        while ($row = $members_result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["name"] . "</td>";
                            echo "<td>" . $row["mobile"] . "</td>";
                            echo "<td>" . $row["email"] . "</td>";
                            echo "<td>" . $row["age"] . "</td>";
                            echo "<td>" . $row["gender"] . "</td>"; // Assuming the column name for duration exists
                            echo "<td>" . $row["plan_id"] . "</td>"; // Assuming the column name for payment exists
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No members found.</td></tr>";
                    }
                    ?>
                </table>
            </div>
        </main>

    </div>
</body>
</html>
