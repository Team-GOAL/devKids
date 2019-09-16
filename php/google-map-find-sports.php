<?php
require 'db-setup.php'; // construct the database
header('Content-type: application/json');

//Succeeded in browser.

//!!! No validation. Assume the user would enter both suburb and activity.
//TODO add validation.

global $suburb;
global $sports;


/*
 * Test data:
 * $_POST["suburb"] = "CLAYTON";
 * $_POST["sports"] = "Soccer";
 */

$suburb = strtoupper($_POST["suburb"]);
$sports = $_POST["sports"];

//$sql = "select * from sports where sports.SuburbTown like ? and sports.SportsPlayed like ?";
$sql = "select * from sports where sports.SuburbTown like '$suburb' and sports.SportsPlayed like '$sports'";

$result = mysqli_query($conn, $sql);
if (!$result) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}


class Location
{
    public $facilityName;
    public $lat;
    public $lng;
    public $sports;
    public $address;
    public $condition;
}

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $s = new Location();
        $s->facilityName = $row['FacilityName'];
        $s->lat = $row['Latitude'];
        $s->lng = $row['Longitude'];
        $s->sports = $row['SportsPlayed'];
        $s->condition = $row['FacilityCondition'];
        $arr[] = $s;
    }
    echo json_encode($arr[]);
} else {
    echo $conn->error;
}
$conn->close();

?>