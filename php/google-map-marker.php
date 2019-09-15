<?php

function parseToXML($htmlStr)
{
    $xmlStr=str_replace('<','&lt;',$htmlStr);
    $xmlStr=str_replace('>','&gt;',$xmlStr);
    $xmlStr=str_replace('"','&quot;',$xmlStr);
    $xmlStr=str_replace("'",'&#39;',$xmlStr);
    $xmlStr=str_replace("&",'&amp;',$xmlStr);
    return $xmlStr;
}

require 'db-setup.php';

// Set the active MySQL database
$db_selected = mysqli_select_db($conn, $db);
if (!$db_selected) {
    die ('Can\'t use db : ' . mysqli_connect_error());
}

// Select rows in the sports table based on the user input
global $suburb;
global $sports;

//$suburb =  strtoupper($_POST["suburb"]);
//$sports = $_POST["sports"];

//TODO hard code now, change it later
$suburb = "CLAYTON";
$sports = "Soccer";

//$sql = "select * from sports where sports.SuburbTown like ? and sports.SportsPlayed like ?";
$sql = "select * from sports where sports.SuburbTown like '$suburb' and sports.SportsPlayed like '$sports'";

$result = mysqli_query($conn, $sql);

header("Content-type: text/xml");

// Start XML file, echo parent node
echo "<?xml version='1.0' ?>";
echo '<markers>';
$ind=0;
// Iterate through the rows, printing XML nodes for each
while ($row = @mysqli_fetch_assoc($result)){
    // Add to XML document node
    echo '<marker ';
    echo 'name="' . parseToXML($row['FacilityName']) . '" ';
    echo 'lat="' . $row['Latitude'] . '" ';
    echo 'lng="' . $row['Longitude'] . '" ';
    echo 'sports="' . parseToXML($row['SportsPlayed']) . '" ';
    echo 'condition="' . parseToXML($row['FacilityCondition']) . '" ';
    echo '/>';
    $ind = $ind + 1;
}

// End XML file
echo '</markers>';

?>

