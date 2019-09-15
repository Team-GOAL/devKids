<?php

require 'db-setup.php';

header('Content-type: application/json');

//TODO check how to receive Ajax call from the client
global $sql;
global $tableName;
global $display;

$tableName = "preference";

global $gender;
global $age;
global $team;
global $individual;
global $indoor;
global $outdoor;

//$_POST["gender"] = "male";
//$_POST["teamIndividual"] = "team";
//$_POST["indoorOutdoor"] = "indoor";
//$_POST["age"] = 5;

//instantialize the value
$team = $individual = $indoor = $team = 0;

    $gender =  strtoupper($_POST["gender"]);
    echo($gender);
    $age= $_POST["age"];
    if (!empty($_POST["teamIndividual"])){
        if ($_POST["teamIndividual"] === "team"){
            $team = 1;
        }
        else{
            $individual = 1;
        }
    }
    if (!empty($_POST["indoorOutdoor"]))
    {
        if ($_POST["indoorOutdoor"] === "indoor"){
            $indoor = 1;
        }
        else{
            $outdoor = 1;
        }
    }




//TODO This failed. SQL is correct
// if team/individual and indoor/outdoor is not set
if (!isset($_POST["teamIndividual"])  && !isset($_POST["indoorOutdoor"])){
    echo($_POST["teamIndividual"]);
    //$sql = "select * from sports where sports.SuburbTown like ? and sports.SportsPlayed like ?";
    $sql = "select * from preference where Min_Age <= '$age' and Max_Age >= '$age' and Gender = '$gender'";
}

if (empty($_POST["teamIndividual"])){
    //$sql = "select * from sports where sports.SuburbTown like ? and sports.SportsPlayed like ?";
    $sql = "select * from preference where Min_Age <= '$age' and Max_Age >= '$age' and Gender = '$gender' and Indoor = '$indoor' and Outdoor = '$outdoor'";
}
if (empty($_POST["indoorOutdoor"])){
    //$sql = "select * from sports where sports.SuburbTown like ? and sports.SportsPlayed like ?";
    $sql = "select * from preference where Min_Age <= '$age' and Max_Age >= '$age' and Gender = '$gender' and Team_Sport = '$team' and Individual_Sport = '$individual'";
}
if (!empty($_POST["indoorOutdoor"]) && !empty($_POST["teamIndividual"])){
    $sql = "select * from preference where Min_Age <= '$age' and Max_Age >= '$age' and Gender = '$gender' and Indoor = '$indoor' and Outdoor = '$outdoor' and Team_Sport = '$team' and Individual_Sport = '$individual'";
}

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0){
    echo "Unfortunately, no were results found. Please modify your preference.";
}

//$arr = array();

class SportsObject{
    public $sportsActivity;
}

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $s=new SportsObject();
        $s->sportsActivity=$row['SportsPlayed'];
        $arr[]=$s;
    }
    echo json_encode($arr);
} else {
    echo mysqli_error($conn);
}

$conn->close();





?>