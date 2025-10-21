<?php

//connecting to the file that contains db configuration code
include 'config.php';

//checking if the data are send
if($_SERVER['REQUEST_METHOD']=="POST"){

    //parsing the information obtained from form
    $name = trim($_POST['name']);
    $email =trim($_POST['email']);
    $password =trim($_POST['password']);

    //hash/encrypting the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    //query to insert into table/database
    $stmt = $conn->prepare("INSERT INTO users(name, email,password) VALUES (?,?,?");
    $stmt->execute([$name, $email, $hashedPassword]);

    //pop up for success message
    echo"<script>
    alert('Registration Successful');
    window.location.href = index.html;
    </script>" ;
}
?>

<!--frontend form for information collection--> 
<form method="post" action="">
    Name: <input type="text" name="name" placeholder="Enter your name" required><br><br>
    Email: <input type="email" name="email" placeholder="Email" required><br><br>
    Password: <input type="password" name="password" placeholder="Password" required><br><br>
    <button type="Submit">Register</button>
</form>