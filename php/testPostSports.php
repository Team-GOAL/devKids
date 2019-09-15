<?php
require 'db-setup.php'; // construct the database


$suburbErr = $sportsErr = $emptyErr = "";
$suburb = $sports = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["suburb"]) && empty($_POST["sports"])) {
        $emptyErr = "You have not selected anything!";
    } elseif (empty($_POST["sports"])) { // if only suburb input exists
        $suburb = test_input($_POST["suburb"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $suburb)) {
            $suburbErr = "Only letters and white space allowed";
        }
    } elseif (empty($_POST["suburb"])) {   // if only sports input exists
        $sports = test_input($_POST["sports"]);
    } else {  // if both input exist
        $suburb = test_input($_POST["suburb"]);
        $sports = test_input($_POST["sports"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $suburb)) {
            $suburbErr = "Only letters and white space allowed";
        }
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>