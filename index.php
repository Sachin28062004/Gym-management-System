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

// Fetch plans from the database
$sql = "SELECT * FROM plans";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Gym Management</title>
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
        <section class="hero">
            <h1>Welcome to Our Gym</h1>
            <p>Experience the best fitness journey with our top-notch facilities and expert trainers.</p>
        </section>

        <section class="features">
            <h2>Our Features</h2>
            <ul>
                <li>State-of-the-art equipment</li>
                <li>Personalized training programs</li>
                <li>Diverse group classes</li>
                <li>Nutritional guidance</li>
                <li>Spa and relaxation area</li>
            </ul>
        </section>

        <section class="trainers">
            <h2>Meet Our Trainers</h2>
            <div class="trainer">
                <img src="images/trainer1.jpeg" alt="Trainer 1">
                <h3>CBum</h3>
                <p>Certified Personal Trainer</p>
                <p>Specializing in strength training and bodybuilding.</p>
                </div>
            <div class="trainer">
                <img src="images/trainer2.jpg" alt="Trainer 2">
                <h3>Sakat Gokhale</h3>
                <p>Yoga Instructor</p>
                <p>Expert in various yoga styles and meditation techniques.</p>
            </div>
        </section>

        <section class="about">
            <h2>About Our Gym</h2>
            <p>Our gym is dedicated to helping you achieve your fitness goals in a motivating and supportive environment. We offer a wide range of equipment, classes, and personalized training programs to cater to all fitness levels and preferences.</p>
            <p>Our experienced trainers are passionate about fitness and committed to helping you reach your full potential. Join us today and embark on a transformative fitness journey.</p>
        </section>
    </main>
    </div>
</body>
</html>