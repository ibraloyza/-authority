<?php
// session_start();
include("security.php");

if ($_POST['teacher_reg_btn']) {
  
    $userName = $_POST['username'];
    $Email= $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $verify_token = md5(rand());
    $usertype = $_POST['usertype'];



    if ( empty($userName) || empty($Email) || empty($phone) || empty($password) || empty($confirmPassword)) {
        $_SESSION['status'] = "All fields are required";
        header("Location: register_teacher.php");
        exit();
    }

    if ($password !== $confirmPassword) {
        $_SESSION['status'] = "Passwords do not match";
        header("Location: register_teacher.php");
        exit();
    }

    $check_email_query = "SELECT email FROM  teachers WHERE email = '$Email'";
    $result_check_email = mysqli_query($conn, $check_email_query);
    if (mysqli_num_rows($result_check_email) > 0) {
        $_SESSION['status'] = "Email address already exists";
        header("Location: register_teacher.php");
        exit();
    }

        // Set `role_id` for 'student' based on roles table
        $role_query = "SELECT id FROM roles WHERE role_name = 'Teacher'";
        $role_result = mysqli_query($conn, $role_query);
        $role = mysqli_fetch_assoc($role_result);
        $role_id = $role['id']; 

    // Hash the password before saving it
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO teachers ( teacher_name, email, phone ,password, verify_token, role_id) 
    VALUES ('$userName', '$Email', '$phone', '$hashed_password', '$verify_token', '$role_id')";
    $result_query = mysqli_query($conn, $query);

    if ($result_query) {
        $_SESSION['status'] = "Registration Successful! Please verify your Email Address.";
        header("Location: register_teacher.php");
        exit();
        } else {
        $_SESSION['status'] = "Registration Failed";
        header("Location: register_teacher.php");
        exit();
        }
    



}


?>