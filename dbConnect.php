<?php

    //for mac environment
    $server = "127.0.0.1";
    $username = "root";
    $password = "";         //  Your database password
    $dbName = "comp3334";   //  Your database name

    //for window environment
    // $server = "localhost";
    // $username = "root";
    // $password = "";         //  Your database password
    // $dbName = "comp3334";   //  Your database name


    $dbConnection = mysqli_connect($server,$username,$password,$dbName);

    if(!$dbConnection)
    {
        echo "Fail to connect to MySQL:".mysqli_connect_error();
        exit();
    }

    if(mysqli_connect("$server","$username","$password","$dbName"))
    {
       // echo "db Connect successfully!";
    }