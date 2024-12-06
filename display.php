<!DOCTYPE html>
<html>
<head>
<title>Lab 5b</title>
<style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        a {
            text-decoration: none;
        }

        a:visited {
            color: inherit;
            text-decoration: none;
        }

        .update {
            color: brown;
        }

        .delete {
            color: red;
            cursor: pointer;
        }
    </style>
</head>
<body>

<table>
  <tr>
    <th>Matric</th>
    <th>Name</th>
    <th>Level</th>
  </tr>
<?php
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

$sql = "SELECT * FROM users2";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["matric"] . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["level"] . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='3'>No data found</td></tr>";
}
$conn->close();
?>
</table>

</body>
</html>