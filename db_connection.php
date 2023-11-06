<?php
    $host = "localhost:3306";
    $username = "root";
    $password = "";
    $database = "nirvana_db";

    $connection = mysqli_connect($host, $username, $password, $database);

    if(!$connection)
        die("ERROR: Connection Failed: ". mysqli_connect_error());
    // echo  "Connected Succesfully";
?>                              