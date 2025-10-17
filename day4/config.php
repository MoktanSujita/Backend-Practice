<?php

define('BASE_URL','localhost/backend/config.php');

try{
     $conn= new PDO ("mysql:host =localhost;dbname=backend_db","root","");
     $conn ->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

}
catch(PDOException $e){
    die("Error:" . $e->getMessage());

}
?>