<?php
session_start(); 
include '../config/dbconn.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; 


function send_reset_password($get_name, $get_email, $token) {
    $mail = new PHPMailer(true);
   
    $mail->isSMTP(); 
    $mail->Host = 'smtp.gmail.com'; 
    $mail->SMTPAuth = true; 
    $mail->Username = 'ibraahim3523@gmail.com'; 
    $mail->Password = 'fxkksgazxmaujeug'; 
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
    $mail->Port = 587; 

    $mail->setFrom('ibraahim3523@gmail.com', $get_name); 
    $mail->addAddress($get_email); 

    $mail->isHTML(true); 
    $mail->Subject = 'Password Reset Requested'; 
    $mail->Body    = "
    <h2>Hi $get_name,</h2>
    <p>We received a request to reset your password for your account on [WEB OF IT].</p>
    <p>To reset your password, click the link below:</p>
    <p><a href='http://localhost/Authentication/pages/password-change.php?token=$token&email=$get_email'>Reset Password</a></p>
    <p>If you have any questions or need further assistance, feel free to contact our support team.</p>
    <br />
    <p>Thank you,</p>
    <p>[WEB OF IT] Team</p>
    ";

    $mail->send(); 
}

// Check if the  reset password button is clicked

if (isset($_POST['reset_password'])) {
   
    // Function to sanitize and validate input data
    function validate($data) 
    {
        $data = trim($data); 
        $data = stripslashes($data); 
        $data = htmlspecialchars($data); 
        return $data;
    }

    // Sanitize the email input
    $email = validate($_POST['email_reset']); 
    
    // Generate a random token for password reset
    $token = md5(rand()); 

    // Query to check if the email exists in the database
    $check_email = "SELECT email FROM Students WHERE email = '$email' LIMIT 1";
    $result_check_email = mysqli_query($conn, $check_email);
    
    // Check if any rows are returned
    if (mysqli_num_rows($result_check_email) > 0) 
    {
        
        $row = mysqli_fetch_array($result_check_email);
        $get_name = $row['name'];
        $get_email = $row['email'];

        // Update the token in the database
        $update_token = "UPDATE Students SET verify_token = '$token' WHERE email = '$get_email' LIMIT 1";
        $result_update_token = mysqli_query($conn, $update_token);
        
        // Check if the update query was successful
        if ($result_update_token) 
        {
            
            // Send the password reset email
            send_reset_password($get_name, $get_email, $token);
            
            // Set a session status message indicating the email has been sent
            $_SESSION['status'] = "We send you an e-mailed a reset password ";
            header("Location: password-reset.php"); 
            exit(0);
        } 
        else 
        {
            // Set a session status message indicating an error
            $_SESSION['status'] = "Something went wrong. #1"; 
            header("Location: password-reset.php"); 
            exit(0);
        }
    } 
    else 
    {
        // Set a session status message indicating no email found
        $_SESSION['status'] = "No Email Found"; 
        header("Location: password-reset.php"); 
        exit(0);
    }
}


// Check if the  update password button is clicked
if (isset($_POST['password_change'])) 
{

    function validata($data) 
    {
        $data = trim($data); 
        $data = stripslashes($data); 
        $data = htmlspecialchars($data); 
        return $data;
    }
    
    // Sanitize the input fields
    $email = validata($_POST['email']);
    $new_password = validata($_POST['new_password']);
    $confirm_password = validata($_POST['confirm_password']);
    $token = validata($_POST['password_token']);
    
    // Check if the token is not empty
    if (!empty($token)) 
    {

        // Check if all required fields are empty
        if (!empty($email) && !empty($new_password) && !empty($confirm_password))
        {
            
            // Query to check if the token exists in the database
            $check_token = "SELECT verify_token FROM Students WHERE verify_token='$token' LIMIT 1";
            $result_check_token = mysqli_query($conn, $check_token);
            
            // Check if any rows are returned
            if (mysqli_num_rows($result_check_token) > 0) 
            {
                
                // Check if the new password and confirm password match
                if ($new_password === $confirm_password) 
                {
                    
                    // Update the password in the database
                    $update_password = "UPDATE Students SET password ='$new_password' , confirm_password ='$confirm_password'      WHERE verify_token='$token' LIMIT 1";
                    $result_update_password = mysqli_query($conn, $update_password);
                    
                    // Check if the update query was successful                    
                    if ($result_update_password) 
                    {
                        
                        // Generate a new token
                        $new_token = md5(rand()); 

                        // Update the token in the database
                        $update_to_new_token = "UPDATE Students SET verify_token ='$new_token' WHERE verify_token='$token' LIMIT 1";
                        $result_update_to_new_token = mysqli_query($conn, $update_to_new_token);
                        
                        // Set a session status message indicating the password has been updated
                        $_SESSION['status'] = "New Password Successfully Updated."; 
                        header("Location: login.php"); 
                        exit(0);
                    } 
                    else 
                    {

                        $_SESSION['status'] = "Did not update password. Something went wrong."; 
                        header("Location: password-change.php?token=$token&email=$email"); 
                        exit(0);
                    }
                } 
                else 
                {

                    $_SESSION['status'] = "Password and Confirm Password does not match"; 
                    header("Location: password-change.php?token=$token&email=$email"); 
                    exit(0);
                }
            }
            else 
            {

                $_SESSION['status'] = "you are already reset your password"; 
                header("Location: password-change.php?token=$token&email=$email"); 
                exit(0);
            }
        } 
        else 
        {

            $_SESSION['status'] = "All Fields are Mandatory"; 
            header("Location: password-change.php?token=$token&email=$email"); 
            exit(0);
        }
    } 
    else 
    {

        $_SESSION['status'] = "No Token Available"; 
        header("Location: password-change.php"); 
        exit(0);
    }
}
?>
