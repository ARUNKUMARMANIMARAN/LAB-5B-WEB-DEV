<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Lab_5b";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$matric = isset($_GET['matric']) ? trim($_GET['matric']) : '';

if ($matric) {
    $sql = "SELECT * FROM users2 WHERE matric = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $matric);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
    } else {
        echo "No user found.";
        exit();
    }
    $stmt->close();
} else {
    echo "Invalid request.";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
</head>
<body>
    <h1>Update User</h1>
    <form action="update.php" method="post">
        <label for="matric">Matric:</label>
        <input type="text" id="matric" name="matric" value="<?php echo htmlspecialchars($user['matric']); ?>" required><br>
        <!-- Hidden field to store the original matric -->
        <input type="hidden" name="original_matric" value="<?php echo htmlspecialchars($user['matric']); ?>">

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required><br>

        <label for="level">Level:</label>
        <input type="text" id="level" name="level" value="<?php echo htmlspecialchars($user['level']); ?>" required><br>

        <button type="submit">Update</button>
        <button type="button" onclick="window.location.href='display2.html'">Cancel</button>
    </form>
</body>
</html>