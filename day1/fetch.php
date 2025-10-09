<?php
include 'config.php';  //including/embedding the file with configuration code

$result = $conn->query("Select * from backend_tbl");  //running a query using function

//defining an empty array
$student = [];

//fetching the result from the query in an associative array form
//associative array = key:value 
while($row = $result->fetch(PDO::FETCH_ASSOC))
{
    $student[] = $row;  //assigning the values into the array
}

//tells the browser that the content is in JSON format
//returns the result in jason format otherwise it returns in a plain text or HTML format
header('Content-Type: application/json');

//truns array into JSON format so that the client can easily read and process the data
echo json_encode($student);
?>