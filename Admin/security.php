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

$session_timeout = 300; // Set to 5 minutes

// Check session timeout
if (isset($_SESSION['last_active'])) {
    $inactive = time() - $_SESSION['last_active'];
    if ($inactive > $session_timeout) {
        // Session has expired
        session_unset();
        session_destroy();
        header("Location: ./login.php"); // Ensure this path is correct
        exit();
    }
}

// Update session activity timestamp
$_SESSION['last_active'] = time();

// Check if the user is authenticated
if (!isset($_SESSION['usertype'])) {
    $_SESSION['status'] = "Please Login to Access User Dashboard!";
    header("Location: login.php");
    exit();
}

?>