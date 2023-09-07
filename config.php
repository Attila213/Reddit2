<?php


    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "reddit";

    // Create connection
    $conn = new mysqli($servername,$username, $password, $dbname);
    $conn -> set_charset("utf8");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: ". $conn->connect_error);
    }
?>