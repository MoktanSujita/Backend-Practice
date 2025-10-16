<?php
include 'config.php';
//Use of the query function results in no need of execute function 
$stmt = $conn->query("SELECT * FROM backend_tbl");

//fetching the data as associative array
//fetch fetches only one(singular) data while,
//fetchAll gitves all the data present on the db 
$students = $stmt ->fetchAll(PDO::FETCH_ASSOC);

//tells the browser it's JSON
header('Content-Type:application/json');
//returns data as json
echo json_encode($students);
?>