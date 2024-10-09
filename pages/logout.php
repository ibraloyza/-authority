<?php 
session_start(); 

unset($_SESSION['authenticated']);

$_SESSION['status'] = "You Logged Out Successfully";


header("Location: ./login.php");

exit();
?>
