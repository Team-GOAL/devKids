<?php

require 'db-setup.php';

//succeeded

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

//instantialize the value
$team = $individual = $indoor = $team = 0;

$_POST["teamIndividual"] = "team";
$_POST["indoorOutdoor"] = "indoor";

    $gender =  strtoupper("female");
    $age= 7;
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

if ($team === 1 &&  $indoor = 1){
    $sql = "select * from preference where Min_Age <= '$age' and Max_Age >= '$age' and Gender = '$gender' and Indoor = 1 and Team_Sport = 1";
}
elseif($team === 1 &&  $outdoor = 1){
    $sql = "select * from preference where Min_Age <= '$age' and Max_Age >= '$age' and Gender = '$gender' and Outdoor = 1 and Team_Sport = 1";
}
elseif($individual === 1 &&  $indoor = 1){
    $sql = "select * from preference where Min_Age <= '$age' and Max_Age >= '$age' and Gender = '$gender' and Indoor = 1 and Individual_Sport = 1";
}
elseif($individual === 1 &&  $outdoor = 1){
    $sql = "select * from preference where Min_Age <= '$age' and Max_Age >= '$age' and Gender = '$gender' and Outdoor = 1 and Individual_Sport = 1";
}
elseif($individual === 1){
    $sql = "select * from preference where Min_Age <= '$age' and Max_Age >= '$age' and Gender = '$gender' and Individual_Sport = 1";
}
elseif($team===1){
    $sql = "select * from preference where Min_Age <= '$age' and Max_Age >= '$age' and Gender = '$gender' and Outdoor = 1 and Team_Sport = 1";
}
elseif($indoor===1){
    $sql = "select * from preference where Min_Age <= '$age' and Max_Age >= '$age' and Gender = '$gender' and Indoor = 1";
}
elseif($outdoor===1){
    $sql = "select * from preference where Min_Age <= '$age' and Max_Age >= '$age' and Gender = '$gender' and Outdoor = 1";
}else{
    $sql = "select * from preference where Min_Age <= '$age' and Max_Age >= '$age' and Gender = '$gender'";
}

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0){
    echo "Unfortunately, no were results found. Please modify your preference.";
}

//$arr = array();

class Sports{
    public $sportsActivity;
}

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $s=new Sports();
        $s->sportsActivity=$row['SportsPlayed'];
        $arr[]=$s;
    }
    echo json_encode($arr);
} else {
    echo mysqli_error($conn);
}

$conn->close();





