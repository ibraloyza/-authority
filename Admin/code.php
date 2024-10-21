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
    $verify_token = md5(rand());


    $usertype = $_POST['usertype'];

    // $usertypeQuery="INSERT INTO roles (role_name) VALUES ('student')";

    // $usertypeQuery_run = mysqli_query($conn,$usertypeQuery);


    if (empty($id) || empty($userName) || empty($Email) || empty($phone) || empty($password) || empty($confirmPassword)) {
        $_SESSION['status'] = "All fields are required";
        header("Location: register.php");
        exit();
    }

    if ($password !== $confirmPassword) {
        $_SESSION['status'] = "Passwords do not match";
        header("Location: register.php");
        exit();
    }

    $check_email_query = "SELECT email FROM admin WHERE email = '$Email'";
    $result_check_email = mysqli_query($conn, $check_email_query);
    if (mysqli_num_rows($result_check_email) > 0) {
        $_SESSION['status'] = "Email address already exists";
        header("Location: register.php");
        exit();
    }

    // Hash the password before saving it
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

 
    // Set `role_id` for 'student' based on roles table
    $role_query = "SELECT id FROM roles WHERE role_name = 'Admin'";
    $role_result = mysqli_query($conn, $role_query);
    $role = mysqli_fetch_assoc($role_result);
    $role_id = $role['id'];   




    $query = "INSERT INTO admin (id, name, email, phone ,password, verify_token, role_id) 
    VALUES ('$id','$userName', '$Email', '$phone', '$hashed_password', '$verify_token', '$role_id')";
    $result_query = mysqli_query($conn, $query);

    if ($result_query) {
    $_SESSION['status'] = "Registration Successful! Please verify your Email Address.";
    header("Location: register.php");
    exit();
    } else {
    $_SESSION['status'] = "Registration Failed";
    header("Location: register.php");
    exit();
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
        $update_query = "UPDATE admin SET name = '$userName', phone = '$edit_phone', email = '$Email', role_id = '$edit_userType' WHERE id = '$id'";
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

    $del_query= "DELETE FROM admin  WHERE id  = '$id'";
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