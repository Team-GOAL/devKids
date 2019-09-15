<?php

require 'db-setup.php'; // construct the database

global $sql;
global $suburb;
global $sports;

$suburb = strtoupper($_POST['suburb']);
echo($suburb);
$sports = $_POST['sports'];
echo($sports);
////TODO be aware of the table name: preference.
///  Database name is not required in the sql query.


//When receiving 2 parameters of suburb and sports activity, search by suburb and sports activity.
if (!empty($_POST['suburb']) && !empty($_POST['sports'])){
    $sql = "select * from sports where sports.SuburbTown like '$suburb' and sports.SportsPlayed like '$sports'";
} elseif (!empty($_POST['suburb'])) {// If only suburb has inputs, search by suburb.
    $sql = "select * from sports where sports.SuburbTown like '$suburb'";
} elseif (!empty($_POST['sports'])) {// If only sports activity has inputs, search by activity
    $sql = "select * from sports where sports.SportsPlayed like '$sports'";
} else {// do nothing

}

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
    echo mysqli_error($conn);
}
$conn->close();
?>