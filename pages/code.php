<?php
session_start(); 
include '../dbcon.php';

use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception; 
require '../vendor/autoload.php';

function sendemail_verify($name, $email, $verify_token) {
    $mail = new PHPMailer(true); 
    $mail->isSMTP(); 
    $mail->Host = 'smtp.gmail.com'; 
    $mail->SMTPAuth = true; 
    $mail->Username = 'ibraahim3523@gmail.com'; 
    $mail->Password = 'fxkksgazxmaujeug'; 
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
    $mail->Port = 587; 

    $mail->setFrom('ibraahim3523@gmail.com', $name); 
    $mail->addAddress($email); 
    $mail->isHTML(true); 
    $mail->Subject = 'Email verification from WEB OF IT'; 
    $mail->Body = "
        <h2>You have Registered with WEB OF IT</h2>
        <h5>Verify your email address to login with the below given link</h5>
        <br /><br />
        <a href='http://localhost/user/pages//verify-email.php?token=$verify_token'>Click Me</a>
    "; 
    $mail->send(); 
}

if (isset($_POST['register_btn'])) { 
    function validate($data) {
        $data = trim($data); 
        $data = stripslashes($data); 
        $data = htmlspecialchars($data); 
        return $data;
    }

    $name = validate($_POST['name']);
    $phone_number = validate($_POST['phone']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $confirm_password = validate($_POST['confirm_password']);
    $verify_token = md5(rand());
    $usertype = validate($_POST['usertype']);

    $usertypeQuery="INSERT INTO roles (role_name) VALUES ('student')";

    $usertypeQuery_run = mysqli_query($conn,$usertypeQuery);



    if (empty($name) || empty($phone_number) || empty($email) || empty($password) || empty($confirm_password)) {
        $_SESSION['status'] = "All fields are required";
        header("Location: register.php");
        exit();
    }

    if ($password !== $confirm_password) {
        $_SESSION['status'] = "Passwords do not match";
        header("Location: register.php");
        exit();
    }


    $check_email_query = "SELECT email FROM Students WHERE email = '$email'";
    $result_check_email = mysqli_query($conn, $check_email_query);
    if (mysqli_num_rows($result_check_email) > 0) {
        $_SESSION['status'] = "Email address already exists";
        header("Location: register.php");
        exit();
    }

    // Hash the password before saving it
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Set `role_id` for 'student' based on roles table
    $role_query = "SELECT id FROM roles WHERE role_name = 'student'";
    $role_result = mysqli_query($conn, $role_query);
    $role = mysqli_fetch_assoc($role_result);
    $role_id = $role['id'];

    $query = "INSERT INTO Students(name, phone, email, password, verify_token, role_id) 
              VALUES ('$name', '$phone_number', '$email', '$hashed_password', '$verify_token', '$role_id')";
    $result_query = mysqli_query($conn, $query);

    if ($result_query) {
        sendemail_verify($name, $email, $verify_token);
        $_SESSION['status'] = "Registration Successful! Please verify your Email Address.";
        header("Location: register.php");
        exit();
    } else {
        $_SESSION['status'] = "Registration Failed";
        header("Location: register.php");
        exit();
    }
}
?>
