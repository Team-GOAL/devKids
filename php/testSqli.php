<?php

//Test succeeded.

$servername = "localhost";
$username = "root";
$password = "33333333";
$db = "kidsdatabase";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $db);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";


$stmt = $conn->query("select * from kidsdatabase.sports limit 1");

if ($stmt->num_rows > 0) {
    // output data of each row
    while($row = $stmt->fetch_assoc()) {
        echo (json_encode($row));
    }
} else {
    echo "0 results";
}
$conn->close();
?>