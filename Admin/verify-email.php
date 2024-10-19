<?php 
session_start();
include '../dbcon.php';




// Check if the token is set in the GET request
if (isset($_GET['token'])) {
    $token = $_GET['token']; 

    // Query to check if the token exists in the database and retrieve the verification status
    $verify_query = "SELECT verify_token, verify_status FROM admin WHERE verify_token = '$token' LIMIT 1";

    // Execute the query
    $result_verify_query = mysqli_query($conn, $verify_query); 
   
    // Check if any rows are returned
    if (mysqli_num_rows($result_verify_query) > 0) {

        $row = mysqli_fetch_array($result_verify_query);
       
        // Check if the account is not yet verified
        if ($row['verify_status'] == "0") { 

            $clicked_toked = $row['verify_token']; 

            // Update query to set the verify_status to '1' (verified)
            $update_query = "UPDATE admin SET verify_status = '1' WHERE verify_token = '$clicked_toked' LIMIT 1";
            
            // Execute the update query
            $result_update_query = mysqli_query($conn, $update_query); 
            
            // Check if the update query was successful
            if ($result_update_query) { 
                
                // Set a session status message indicating success
                $_SESSION['status'] = "Your Account has been verified Successfully.!"; 
                
                // Redirect to the login page
                header("Location: ./login.php"); 
                exit(0); 
            } else {

                $_SESSION['status'] = "Verification Failed.!"; 
                header("Location: login.php"); 
                exit(0); 
            }
        } else { 
            // Set a session status message indicating the email is already verified
            $_SESSION['status'] = "Email Already Verified. Please Login"; 
            // Redirect to the login page
            header("Location: ./login.php");
            exit(0); 
        }
    } else {
        // Set a session status message indicating the token does not exist
        $_SESSION['status'] = "This Token does not Exists"; 
        header("Location: login.php");
    }
} else { 
    // Set a session status message indicating the action is not allowed
    $_SESSION['status'] = "Not Allowed"; 
    header("Location: login.php"); 
} 
?>
