<?php
session_start();
include('../dbcon.php');
if(isset($_POST['register_btn']))
{
    $id = $_POST['id'];
    $userName = $_POST['username'];
    $Email= $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if($password === $confirmPassword)
    {
        $query = "INSERT INTO users(user_id,user_name,email,password) 
            VALUES('$id','$userName','$Email','$password')";
        $query_run = mysqli_query($conn, $query);
        
        if($query_run)
        {
            $_SESSION['success'] = "Admin prifile added";
            header('location:register.php');

        }
        else
        {
            $_SESSION['status'] = "Admin prifile added";
            header('location:register.php');
        }

    }
    else
    {
        $_SESSION['status'] = "password and confirm password doesn't match";
        header('location:register.php');
    }

}



?>