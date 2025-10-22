<?php
include 'config.php';

session_start();

//if user not logged in, redirect to login
if(!isset($_SESSION['user'])){
    header("location:login.php");
}

//if user already logged in 
echo "<h2>Welcome ".$_SESSION['user']['name']. "!</h2>";
echo "<a href ='logout.php'>Logout</a>";
?>