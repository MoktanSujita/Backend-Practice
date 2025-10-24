<?php

include 'config.php';

//checking if the form is filled or not
if($_SERVER['REQUEST_METHOD']==='POST'){
    $targetDir = "uploads/"; //folder name 

    //checking if the folder exists, if not make a new folder
    if(!is_dir($targetDir)){
        //mkdir->make new folder
        //$targetDir->folder name
        //0777-> permission 
        //true-> recursion
        mkdir($targetDir,0777,true);
    }

    //basename-> provides the file name (may contain full path)
    $filename = basename($_FILES["fileToUpload"]["name"]);
    $targetfile = $targetDir . $filename;

    //pathinfo-> provides the type of file
    $fileType = strtolower(pathinfo($targetfile,PATHINFO_EXTENSION));
    $allowedTypes = ['pdf', 'jpg', 'jpeg', 'png'];

    //only if the file is of the type that is allowed it is moved to the newly formed folder "uploads"
    if(in_array($fileType, $allowedTypes)){
        if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$targetfile)){
            $stmt = $conn->prepare("INSERT INTO uploads (filename, filepath) VALUES (?,?)");
            $stmt-> execute([$filename, $targetfile]);
            echo "<script>alert('File upload successful');</script>";

        }
        else{
            echo"<script>alert('Error Uploading file');</script>";
        }
    }
    else{
        echo"<script>alert('Invalid file type! Please upload PDF/JPG/PNG allowed.');</script>";
    }
}
?>

<form method="post" enctype="multipart/form-data">
    <label>Select File:</label>
    <input type ="file" name="fileToUpload" required>
    <button type="submit">Upload</button>
</form>