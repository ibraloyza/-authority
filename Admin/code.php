<?php
// session_start();
include("security.php");
if(isset($_POST['register_btn']))
{
    $id = $_POST['id'];
    $userName = $_POST['username'];
    $Email= $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $usertype = $_POST['usertype'];

    
 

    if($password === $confirmPassword)
    {
        
        $query = "INSERT INTO students (student_id , name,	phone, email, password ) 
            VALUES('$id','$userName','$phone','$Email','$password')";
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
    $edit_userType = $_POST['Update_usertype'];
    $edit_phone = $_POST['Update_phone'];

    // Check if the role exists in the roles table
    $check_role_query = "SELECT id FROM roles WHERE id = '$edit_userType'";
    $check_role_result = mysqli_query($conn, $check_role_query);

    if (mysqli_num_rows($check_role_result) > 0) {

        // Proceed with the update if the role exists
        $update_query = "UPDATE students SET name = '$userName', phone = '$edit_phone', email = '$Email', password = '$password', role_id = '$edit_userType' WHERE student_id = '$id'";
        $update_query_run = mysqli_query($conn, $update_query);
    
        if ($update_query_run) 
        {
            $_SESSION['success'] = "Your data is updated";
            header('location:register.php');
            exit();
        } 
        else 
        {
            $_SESSION['status'] = "Your data is not updated";
            header('location:register.php');
            exit();
        }
    } 
    else 
    {
    $_SESSION['status'] = "Invalid role selected";
    header('location:register.php');
    exit();
    }

}
else 
{
$_SESSION['status'] = "Invalid role selected";
header('location:register.php');
exit();
}






// delete query 
if(isset($_POST['del_btn']))
{
    $id = $_POST['del_id'];

    $del_query= "DELETE FROM users  WHERE student_id  = '$id'";
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