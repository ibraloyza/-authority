<?php
include('security.php');

if (isset($_POST['login_btn'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']); 
    
    // Query to check the email and password
    $login_query = "SELECT * FROM users WHERE email = '$email' AND password = '$password' LIMIT 1";
    $login_query_run = mysqli_query($conn, $login_query);
    
    if (mysqli_num_rows($login_query_run) > 0) {
        // Fetch the user data
        $row = mysqli_fetch_assoc($login_query_run);
        $usertype = $row['usertype'];
        
        // Use a switch statement to check the user type
        switch ($usertype) {
            case 'Admin':
                $_SESSION['username'] = $email;
                $_SESSION['usertype'] = $usertype;
                header('Location: index.php');  // Redirect Admin to dashboard
                break;
                
            case 'User':
                $_SESSION['username'] = $email;
                $_SESSION['usertype'] = $usertype;
                header('Location: index.php');  // Redirect User to user dashboard
                break;
                
            default:
                $_SESSION['status'] = "Invalid email / password";
                header('Location: login.php');
                break;
        }
    } else {
        $_SESSION['status'] = "Invalid email / password";
        header('Location: login.php');
    }
}



?>

