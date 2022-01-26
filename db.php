<?php

//variables
$sName ="localhost";
$uName = "root";
$pass = "";
$db_name = "todo_app";

//connection
try {

    $conn = new PDO("mysql:host=$sName;dbname=$db_name", $uName, $pass);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "connected to db";   
}catch(PDOException $e){
    echo "Connection not working : ". $e->getMessage();
}

?>