<?php
include 'config.php';

header('Content-Type: application/json');//tells the browser it's a json 

//checks if std_id is provided on the url or not
if(isset($_GET['std_id'])){
    $std_id = $_GET['std_id'];//assigning value parsed through url 

    try{
        //Preparing SQL query with placeholder
        $stmt = $conn-> prepare("SELECT * FROM backend_tbl WHERE std_id = :std_id");
        $stmt ->bindParam(':std_id',$std_id);
        $stmt ->execute();//executing the query

        $student = $stmt->fetch(PDO::FETCH_ASSOC);//fetching the data retrived from db in associative array form

        if($student){
            //displaying the result in form of json
            echo json_encode($student);
        }
        else{
            //else display a message
            echo json_encode(["message"=>"Student not found"]);
        }
    }
    catch(PDOException $e){
        echo json_encode(["message"=>$e->getMessage()]);
    }
}
else{
    echo json_encode(["message"=>"Student Id not provided"]);
}
?>