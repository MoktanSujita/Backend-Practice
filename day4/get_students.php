<?php
include 'config.php';  

//tells the browser that it is JSON
header('Content-Type: application/json');

try{
    //running sql query to fetch all the data
     $stmt = $conn->query("SELECT * FROM backend_tbl");
     $students = $stmt->fetchAll(PDO::FETCH_ASSOC);

     //check if the data/records exist or not
     if(count($students)>0){
         
        echo json_encode($students); //returns json response
     }
     else{
        echo json_encode(["message"=>"No student records"]);
     }

}

catch(PDOException $e){
    echo json_encode(["error"=> $e->getMessage()]);
}
?>