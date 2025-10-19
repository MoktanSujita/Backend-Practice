<?php
 include 'config.php'; //including the file

 //running a query
 $stmt = $conn->query("SELECT * FROM student_tbl");
 $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<h2>Student List</h2>
<a href="add.php">+ Add Student</a>
<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Age</th>
    </tr>

    <!--displaying the fetched data in form of a table-->
    <?php foreach($students as $student):?>
    <tr>
        <td><?=htmlspecialchars($student['id'])?></td>
        <td><?=htmlspecialchars($student['name'])?></td>
        <td><?=htmlspecialchars($student['name'])?></td>
        <td><?=htmlspecialchars($student['age'])?></td>
    <td>
        <a href="edit.php?id=<?=$student['id']?>">Edit</a>
        <a href="delete.php?id=<?=$student['id']?>" onclick ="return confirm('Are you sure')">Delete</a>
    </td>
    </tr>
    <?php endforeach; ?>
</table>