<!DOCTYPE html>
<html>
<head>
    <title>Gym Management - Plans</title>
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
            <h2>Our Plans</h2>
            <table>
                <thead>
                    <tr>
                        <th>Plan Name</th>
                        <th>Amount(rs)</th>
                        <th>Duration(Months)</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
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

                    // Fetch all plans from the database
                    $sql = "SELECT id, plan_name, amount, duration FROM plans";
                    $result = $conn->query($sql);

                    // Display plans in a table
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["plan_name"] . "</td>";
                            echo "<td>" . $row["amount"] . "</td>";
                            echo "<td>" . $row["duration"] . "</td>";
                            echo "<td>";
                            echo "<form method='post' action='edit_plan.php'>";
                            echo "<input type='hidden' name='plan_id' value='" . $row["id"] . "'>";
                            echo "<input type='submit' name='Edit' value='Edit'>";
                            echo "</form>";
                            echo "<form method='post' action='delete.php'>";
                            echo "<input type='hidden' name='plan_id' value='" . $row["id"] . "'>";
                            echo "<input type='submit' name='Delete' value='Delete'>";
                            echo "</form>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No plans available</td></tr>";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>
            <form method="get" action="add_plan.php">
                <input type="submit" value="Add Plan">
            </form>
        </main>
    </div>
</body>
</html>
