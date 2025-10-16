<?php 
include 'config.php';

//php://input reads the raw body of the HTTP request(not form or $_post)
//json_decode converts the raw JSON strings into associative array
$data = json_decode(file_get_contents("php://input"),true);

//checks if all the necessary fields are present on the db
if(isset($students['std_id']) && isset($students['name']) && isset($students['age'])){

    //preparing sql statement
    $stmt= $conn->prepare("INSERT INTO backend_tbl (id, name, age) VALUES (:id, :name, :age)");
  
    //passing values to the placeholders
    $stmt ->bindParam(':id',$students['std_id']);
    $stmt ->bindParam(':name',$students['name']);
    $stmt ->bindParam(':age',$students['age']);

    //execution of the query
    if($stmt -> execute()){
        echo json_encode(["message"=> "Student added successfully"]);
    }
    else{
        echo json_encode(["message"=>"Failed to add data"]);
    }
}

else{
    echo json_encode(["message" => "Invalid input"]);
}
?>