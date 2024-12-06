<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Lab_5b";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $original_matric = $_POST['original_matric'];
    $new_matric = $_POST['matric'];
    $name = $_POST['name'];
    $level = $_POST['level'];

    // Update the record with the new matric
    $sql = "UPDATE users2 SET matric = ?, name = ?, level = ? WHERE matric = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $new_matric, $name, $level, $original_matric);

    if ($stmt->execute()) {
        echo "<script>alert('User updated successfully!'); window.location.href='display2.html';</script>";
    } else {
        echo "Error updating user: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>