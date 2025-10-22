<?php
session_start();
//destroys session data
session_destroy();
header("location:login.php");
exit;
?>