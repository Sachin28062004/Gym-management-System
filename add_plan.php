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
    $plan_name = $_POST["plan_name"];
    $amount = $_POST["amount"];
    $duration = $_POST["duration"];

    // Insert the new plan into the database
    $sql = "INSERT INTO plans (plan_name, amount, duration) VALUES ('$plan_name', '$amount', '$duration')";

    if ($conn->query($sql) === TRUE) {
        echo "New plan added successfully!";
        // Redirect to plans.php after adding the plan
        header("Location:plans.php");
        exit(); // Make sure to exit after redirecting
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New Plan - Gym Management</title>
    
</head>
<style> 
/* General Styles */
body {
  font-family: 'Poppins', sans-serif;
  line-height: 1.6;
  color: #333;
  background-color: #f8f8f8;
  margin: 0;
  padding: 0;
}

/* Header */
header {
  background-color: #222;
  color: #fff;
  padding: 20px;
  text-align: center;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  position: sticky;
  top: 0;
  z-index: 100;
}

nav ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  display: flex;
  justify-content: center;
}

nav a {
  color: #fff;
  text-decoration: none;
  margin: 0 10px;
  font-weight: bold;
  transition: color 0.3s ease;
  padding: 10px;
  border-radius: 5px;
}

nav a:hover {
  color: #ff6347;
  background-color: rgba(255, 255, 255, 0.2);
}

/* Main Content */
main {
  max-width: 1200px;
  margin: 40px auto;
  padding: 30px;
  background-color: #fff;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  border-radius: 10px;
}

h2 {
  color: #ff6347;
  margin-bottom: 30px;
  text-align: center;
  text-transform: uppercase;
  letter-spacing: 2px;
}

/* Form */
form {
  margin-top: 30px;
  max-width: 500px;
  margin-left: auto;
  margin-right: auto;
  background-color: #f8f8f8;
  padding: 30px;
  border-radius: 10px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

input[type="text"],
input[type="number"] {
  padding: 12px;
  margin: 10px 0;
  border: 1px solid #ccc;
  border-radius: 4px;
  width: 100%;
  font-size: 16px;
  transition: border-color 0.3s ease;
}

input[type="text"]:focus,
input[type="number"]:focus {
  border-color: #ff6347;
  outline: none;
}

input[type="submit"] {
  background-color: #ff6347;
  color: #fff;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 16px;
  font-weight: bold;
  transition: background-color 0.3s ease;
}

input[type="submit"]:hover {
  background-color: #e65c40;
}

/* Footer */
footer {
  background-color: #222;
  color: #fff;
  text-align: center;
  padding: 20px;
  margin-top: 40px;
}

/* Responsive Styles */
@media (max-width: 768px) {
  header {
    padding: 10px;
  }

  nav ul {
    flex-direction: column;
    align-items: center;
  }

  nav a {
    margin: 5px 0;
  }

  main {
    padding: 20px;
  }

  form {
    padding: 20px;
  }
}
</style>
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
            <h2>Add New Plan</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <label for="plan_name">Plan Name:</label>
                <input type="text" id="plan_name" name="plan_name" required>

                <label for="amount">Amount:</label>
                <input type="text" id="amount" name="amount" required>

                <label for="duration">Duration:</label>
                <input type="text" id="duration" name="duration" required>

                <input type="submit" value="Add Plan">
            </form>
        </main>
    </div>
</body>
</html>
