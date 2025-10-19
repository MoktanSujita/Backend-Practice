<?php
include 'config.php';

//Getting the value of id
$id = $_GET['id'];

//query for deletion of a record
$stmt = $conn->prepare("DELETE FROM student_tbl WHERE id = ?");
$stmt -> execute([$id]);//parsing placeholder value

//success message pop up
echo"<script>
alert('Deletion complete');
window.location.href = 'index.php';
</script>";
?>