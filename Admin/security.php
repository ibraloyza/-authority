<?php 
session_start();
include('../dbcon.php');

if($conn)
{
    // echo "database connected";
}
else
{
    header('location:../dbcon.php');
}
if(!$_SESSION['username'])
{
    header('location:login.php');
}

?>