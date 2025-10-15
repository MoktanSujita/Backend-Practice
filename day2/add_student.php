<?php
include 'config.php';
if($_SERVER["REQUEST_METHOD"]=="POST")  //method or type of HTTP request it is 
{
    //trim removes the whitespaces 
    $id = trim($_POST['id']);      //here $_POST is a global variable
    $name = trim($_POST['name']);
    $age = trim($_POST['age']);

    if(!empty($id) && !empty($name) && !empty($age))
    {
        //sends the sql command to the database and database verifies if the command is valid or not 
        $stmt = $conn->prepare("INSERT INTO backend_tbl(std_id, name, age) VALUES (:id, :name, :age )");
        //bindParam sends the value to the statement
        $stmt-> bindParam(':id', $id);
        $stmt-> bindParam(':name', $name);
        $stmt-> bindParam(':age', $age);
        //execute sql command
        $stmt-> execute();
        echo "<p style = 'color:green;'>Student record added successfully!</p>";

    }
    else{
        echo "<p style = 'color:red;'>All fields are required</p>";
    }
}

//Fetching the records
$stmt = $conn->prepare("SELECT * FROM backend_tbl ORDER BY std_id ASC");
$stmt->execute();
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
//---here conn and stmt are objects (of class PDO) and to access the methods we use ->---

?>

<!DOCTYPe html>
<html lang="en">
    <title>Add Student</title>
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        <h2>Add Student</h2>
        <form method="post" action="">
            <input type="text" name="name" placeholder="Enter Name" required>
            <input type="number" name="id" placeholder="Enter id" required>
            <input type= "number" name= "age" placeholder="Enter the age">
            <input type="submit" value="Add student">
        </form>
        <h3>Student list</h3>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Age</th>
            </tr>
            <?php if(count($students)>0):?>
                <?php foreach($students as $student):?>
                    <!-- "? =" is short for echo
                     student['id'] takes the value of id from the database row
                     htmlspecialchars()-> this function helps in the preservation of htmlproperties (for eg :bold)  -->
                    <tr>
                       <td><?=htmlspecialchars($student['std_id'])?></td>
                       <td><?=htmlspecialchars($student['name'])?></td>
                       <td><?=htmlspecialchars($student['age'])?></td>
                       <td>
                        <!-- the a tag creates a link to another page and the id= part fetches the value of the id -->
                           <a href="edit_student.php?id=<?=$student['std_id']?>" class="button">Edit</a>
                           <a href="delete_student.php?id=<?=$student['std_id']?>" class="delete button" onclick="retur confirm('Are you sure?')">Delete</a>
                       </td>
                    </tr>
                    <?php endforeach;?>
                <?php else:?>
                    <tr><td colspan="3">No records found</td></tr>
                <?php endif;?>
        </table>
    </body>
</html>