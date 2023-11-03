<?php
    $host = "localhost:3307";
    $username = "root";
    $password = "admin";
    $database = "nirvana_db";

    $connection = mysqli_connect($host, $username, $password, $database);

    if(!$connection)
        die("ERROR: Connection Failed: ". mysqli_connect_error());
    // echo  "Connected Succesfully";
?>                              