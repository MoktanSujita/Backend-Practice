<?php

include 'config.php';

header('Content-Type: application/json');
//if there is any value show it else blank
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$age = $_POST['age'] ?? '';

//if all the fields are filled
if($name && $email && $age){
    $stmt = $conn->prepare("INSERT INTO students (name, email, age) VALUES (?,?,?)");
    $stmt ->execute([$name, $email, $age]);

    //convert php array into JSON (sends and receives data between the server and client->browser/JS)
    echo json_encode(['status' => 'success', 'message' => 'Student added successfully']);
}else{
    echo json_encode(['status' => 'error' , 'message' => 'All the fields are required']);
}
?>