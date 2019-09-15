<?php
//Succeeded

require 'db-setup.php'; // construct the database

global $sql;

//$_POST['suburb']
//$_POST['sports']

$sports = "Soccer";
$suburb = strtoupper("Clayton");

//$sql = "select * from sports where sports.SuburbTown like ? and sports.SportsPlayed like ?";
$sql = "select * from sports where sports.SuburbTown = '$suburb'";

$result = mysqli_query($conn, $sql);
if (!$result) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo (json_encode($row));
    }
} else {
    echo $conn-> error;
}
$conn->close();