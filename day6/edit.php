<?php
include 'config.php';

//getting the id from url
$id = $_GET['id'];

//running the query to show the available records of the selected student
$stmt = $conn->prepare("SELECT * FROM student_tbl WHERE id = ?");
$stmt->execute([$id]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $age = $_POST['age'];

    //query for updation
    $update = $conn->prepare("UPDATE student_tbl set name=?, email=?, age=? WHERE id = ?");
  
    //passing the values of the placeholders
    $update->execute([$name, $email, $age, $id]);

    echo "<script>
    alert('Record updation successful');
    window.location.href= 'index.php';
    </script>";
}
?>

<!--forms for data edition along with the already existing values-->
<h2>Edit Student</h2>
<form method="post">
    Name: <input type="text" name="name" value="<?=$student['name']?>"><br><br>
    Email: <input type="text" name="email" value="<?=$student['email']?>"><br><br>
    Age: <input type="number" name="age" value="<?=$student['age']?>"><br><br>
    <button type="submit">Update</button>
</form>