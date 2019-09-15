<?php

//Add the file to construct the database
require 'db-setup.php';



//return top 5 suburbs with significant chinese population proporiton in a descending order
$subQuery = "(select distinct(Suburb), proportion from chinesepopulation where proportion > 0 LIMIT 10)";
$sql ="select * from $subQuery a order by proportion desc";

$result = mysqli_query($conn, $sql);

class ChinesePopulation{
    public $suburbs;
}

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $s=new ChinesePopulation();
        $s->suburbs=$row['Suburb'];
        $arr[]=$s;
    }
    echo json_encode($arr);
} else {
    echo mysqli_error($conn);
}

$conn->close();

?>