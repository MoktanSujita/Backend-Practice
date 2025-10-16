<?php
include 'config.php';
if($_SERVER['REQUEST_METHOD']=="POST"){
  $std_id = trim($_POST['std_id']);
  $name = trim($_POST['name']);
  $age = trim($_POST['age']);

  if(!empty($std_id) && !empty($name) && !empty($age)){
    $stmt = $conn->query("INSERT INTO backend_tbl (std_id,name,age) values (:id,:name,:age)");
    $stmt -> bindParam(':id',$std_id);
    $stmt -> bindParam(':name',$name);
    $stmt ->bindParam(':age',$age);
    $stmt ->execute();
    echo "<p style = 'color:green'Record addition successful!>";
  }
  else{
    echo "<p style = 'color:red' Record addition failure>";
  }
}

$stmt = $conn->query("SELECT * FROM backend_tbl ORDER BY ASC");
$stmt -> execute();
$student = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<html>
    <head>
        <title>
            Add Student
        </title>
        <meta charset="UTF-8">
    </head>
    <body>
        <form method="post" action="">
            <input type="number" name="std_id" placeholder="Enter the student id" required>
            <input type="text" name="name" placeholder="Enter the name" required>
            <input type ="number" name="age" placeholder="Enter age" required>
            <input type="submit" value="Submit">
        </form>
        <h3>Student List</h3>
        <table>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Age</th>
            </tr>
            <?php if(count($students)>0): ?>
            <?php foreach($students as $student):?>

            <tr>
                <td><?=htmlspecialchars($student['std_id'])?></td>
                <td><?=htmlspecialchars($student['name'])?></td>
                <td><?=htmlspecialchars($student['age'])?></td>

                <a href="delete_student.php?id=<?=$student['std_id']?>"class = "delete_button" onclick= "return confirm('Are you sure?')"> Delete</a>
                <a href="edit_student.php?id<?=$student['name']?>" class="button">Edit</a>
            </tr>
            <?php endforeach?>
                <?php else:?>
                  <tr><td rowspan="3">No records found</td><tr>
                <?php endif;?>
        </table>
    </body>
</html>