<?php
include 'config.php';

header('Content-Type :application/json');

$stmt = $conn->query("SELECT * FROM students ORDER BY id DESC");

//fetching all the data in the form of associative array
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($students);
?>