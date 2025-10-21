<?php
include 'config.php';

session_start();//session started 

//checking if the request method
if($_SERVER['REQUEST_METHOD']=='POST')
{
    $email = $_POST['email'];
    $password =$_POST['password'];

    //fetching all the data of the selected user
    $stmt =$conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    //verifying if the password on the db and form match
    if($user && password_verify($password,$user['password'])){
        $_SESSION['user'] =$user;
        header("location:dashboard.php");
        exit;
    }
    //message if the password doesn't match
    else{
        die("Invalid email or password!");
    }
}
?>

<form method="post" action="">
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="password" required><br><br>
    <button type="submit">Login</button>
</form>