<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Lab_5b";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$matric = $_POST['matric'];
$passwordInput = $_POST['password'];

// Query the database for user
$sql = "SELECT * FROM users2 WHERE matric = ? AND password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $matric, $passwordInput);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Login success
    echo "<script>alert('Login successful!');</script>";
} else {
    // Login failure
    echo "<script>alert('Login failed! Please check your matric and password.');</script>";
}

// Close the connection
$stmt->close();
$conn->close();
?>