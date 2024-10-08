<?php
include('security.php');

if(isset($_POST['login_btn']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    $login_query = "SELECT * FROM  users WHERE email = '$email' AND password = '$password' LIMIT 1";
    $login_query_run = mysqli_query($conn,$login_query);

    if(mysqli_fetch_array($login_query_run))
    {
        $_SESSION['username'] = $email;
        header('location:index.php');

    }
    else
    {
        $_SESSION['username'] = "invalid email / password";
        header('location:login.php');
    }
}



?>