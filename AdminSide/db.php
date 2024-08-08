<?php

    $server = 'localhost';
    $uname = 'root';
    $password = '';
    $database = 'flightdb';
    
    $con = mysqli_connect($server,$uname,$password,$database);
    if($con){
        // echo "Database connected successfully!!";
    }else{
        echo "Database connection failed---> ". mysqli_connect_error();
    }
?>