<?php
define('BASEURL','backend/day3/config.php');

try{
    $conn= new PDO("mysql:host=localhost;dbname=backend_db","root","");
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    die("Connection error ".$e->getMessage());
}

?>