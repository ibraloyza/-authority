<?php 

include '../config/dbconn.php';

session_start(); 

use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception; 

require '../vendor/autoload.php'; 


function resend_email_verify($name, $email, $verify_token){

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
    $mail->Subject = 'Resend - Email verification from Huud Technology'; 
    $mail->Body    = "
    <h2>You have Registered with Huud Technology</h2> <!-- Salaan iyo farriin xaqiijin -->
    <h5>Verify your email address to login with the below given link</h5>
    <br /><br />
    <a href='http://localhost/Authentication/pages/verify-email.php?token=$verify_token'>Click Me</a>
    ";

    $mail->send();
    //echo 'Message has been sent'; 

}

// Check if the resend email button is clicked
if (isset($_POST['resend_email_btn'])){

    // Check if the email field is not empty
    if (!empty($_POST['email_resend'])) {

    // Check if the email field is not empty
        function data_email($data){
            $data = trim($data); 
            $data = stripslashes($data); 
            $data = htmlspecialchars($data);
            return $data;
        }

        // Sanitize the email input
        $result_email = data_email($_POST['email_resend']);
    
        $resed_check_email_query = "SELECT * FROM Students WHERE email='$result_email' LIMIT 1";
        $result_check_email_query = mysqli_query($conn, $resed_check_email_query); 

        if (mysqli_num_rows($result_check_email_query) > 0) {

            $row = mysqli_fetch_array($result_check_email_query); 

            if ($row['verify_status'] == "0") {

                $name = $row['name']; 
                $email = $row['email']; 
                $verify_token = $row['verify_token']; 

                resend_email_verify($name, $email, $verify_token); 
                
                $_SESSION['status'] = "Verification Email Link has been sent to your email address.!"; 

                header("Location: login.php"); 
                exit(0); 

            } else { 

                $_SESSION['status'] = "Email already verified. please Login."; 
                header("Location: login.php"); 
                exit(0); 

            }
        } else { 
            
            $_SESSION['status'] = "Email is not registered. Please Register Now";
            header("Location: register.php"); 
            exit(0); 
        }

    } else { 

        $_SESSION['status'] = "Please enter the field"; 
        header("Location: resend-email-verification.php"); 
        exit(0);

    }
}

?>
