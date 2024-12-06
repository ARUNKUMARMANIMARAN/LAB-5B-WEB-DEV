<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Lab_5b";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Connection failed: " . $conn->connect_error]));
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['matric']) && !empty(trim($_POST['matric']))) {
        $matric = trim($_POST['matric']);

        $sql = "DELETE FROM users2 WHERE matric = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("s", $matric);

            if ($stmt->execute()) {
                echo json_encode(["success" => true, "message" => "Record with Matric: $matric deleted successfully."]);
            } else {
                echo json_encode(["success" => false, "message" => "Error deleting record: " . $stmt->error]);
            }

            $stmt->close();
        } else {
            echo json_encode(["success" => false, "message" => "Failed to prepare SQL statement."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Invalid or missing Matric value."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}

$conn->close();
?>