<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "backend_db";

define('BASE_URL','http://localhost/backend/config.php');  //defining a variable and it's value
try{
 $conn=new PDO("mysql:host=$servername;dbname=$database",$username,$password);
//By default PHP doesn't show any error even if it fails (connection with database or wrong query)
 $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
   die("Connection Failed " . $e->getMessage());//displays error message
}
?>