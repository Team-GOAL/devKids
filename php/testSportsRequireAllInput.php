<?php
require 'db-setup.php'; // construct the database

//Succeeded in browser.
// Zoe's IDE has something wrong with the configuration of the server pathway.
// So Zoe can run this code on browser, but can not run it from the IDE, which will be fixed soon.

//No validation. Assume the user would enter both suburb and activity.

global $suburb;
global $sports;

$suburbErr = $sportsErr = $emptyErr = "";
$suburb = $sports = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $suburb =  strtoupper($_POST["suburb"]);
        $sports = $_POST["sports"];
        if (!preg_match("/^[a-zA-Z ]*$/", $suburb)) {
            $suburbErr = "Only letters and white space allowed";
        }
        if (!preg_match("/^[a-zA-Z ]*$/", $suburb)) {
            $sportsErr = "Only letters and white space allowed";
        }
}

//$sql = "select * from sports where sports.SuburbTown like ? and sports.SportsPlayed like ?";
$sql = "select * from sports where sports.SuburbTown like '$suburb' and sports.SportsPlayed like '$sports'";

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

?>