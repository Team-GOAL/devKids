<?php
    $servername = "localhost";
    $username = "root";
    $password = "33333333";
    $db = "kidsdatabase";
// Create connection
    $conn = mysqli_connect($servername, $username, $password, $db);
// Check connection
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
    }
    //echo "Connected successfully";

?>
