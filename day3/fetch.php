<?php
include 'config.php';

$stmt = $conn->query("SELECT * FROM backend_db");

$student= [];

while($row = $result->fetch(PDO::FETCH_ASSOC)){
    $student[]= $row;
}

header('Content-Type:application/json');

echo "json_encode($student)";
?>