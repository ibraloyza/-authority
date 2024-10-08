<?php
// session_start();
include("../dbcon.php");
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


// update query

if(isset($_POST['update_btn']))
{
    $id = $_POST['edit_id'];
    $userName = $_POST['edit_username'];
    $Email = $_POST['edit_Email'];
    $password = $_POST['edit_password'];

    $update_query = "UPDATE users SET 	user_name = '$userName', email= '$Email', password= '$password' WHERE user_id = '$id'";
    $update_query_run =mysqli_query($conn,$update_query);

    if($update_query_run)
    {
        $_SESSION['success'] = "your data is updated";
        header('location:register.php');
        exit();
    }
    else
    {
        $_SESSION['status'] = "your data is not updated";
        header('location:register.php');
        exit();
    }
}


// delete query 
if(isset($_POST['del_btn']))
{
    $id = $_POST['del_id'];

    $del_query= "DELETE FROM users  WHERE user_id = '$id'";
    $del_query_run =mysqli_query($conn,$del_query);

    if($del_query_run)
    {
        $_SESSION['success'] = "your data it was daleted";
        header('location:register.php');
        exit();
    }
    else
    {
        $_SESSION['status'] = "your data it wasn't daleted";
        header('location:register.php');
        exit();
    }
}






?>