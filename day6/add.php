<?php
include 'config.php';  //including file

//parsing the value obtained through form
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $age = trim($_POST['age']);

    $stmt = $conn->prepare("INSERT INTO student_tbl(name, email, age) VALUES(?, ?, ?)");
    $stmt -> execute([$name, $email, $age]);

    //shows a pop up box with success msg before heading to index.php page
    echo "<script>
    alert('Student Added successfully!');
    
   window.location.href = 'index.php';
    
    </script>";
}
?>

<!--form for day collection-->
<h2>Add Student</h2>
<form action="" method="post">
    Name: <input type="text" name="name" required><br><br>
    Email: <input type="text" name="email" required><br><br>
    Age:  <input type="number" name="age" required><br><br>
    <button type="submit">Update</button>
</form>