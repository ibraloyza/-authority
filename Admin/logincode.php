<?php
session_start();
include('../dbcon.php');


if (isset($_POST['login_btn'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']); 
    
    // Query to check the email and password from the students table and join with the roles table to get the usertype (role_name)
    $login_query = "
        SELECT students.*, roles.role_name 
        FROM students 
        JOIN roles ON students.role_id = roles.id 
        WHERE students.email = '$email' AND students.password = '$password' 
        LIMIT 1";
    
    $login_query_run = mysqli_query($conn, $login_query);
    
    if (mysqli_num_rows($login_query_run) > 0) {
        // Fetch the user data
        $row = mysqli_fetch_assoc($login_query_run);
        $usertype = $row['role_name']; // Fetch the role_name from the roles table
        
        // Use a switch statement to check the user type
        switch ($usertype) {
            case 'Admin':
                $_SESSION['username'] = $email;
                $_SESSION['usertype'] = $usertype;
                header('Location: index.php');  // Redirect Admin to dashboard
                break;
                

            case 'Teacher':
                $_SESSION['username'] = $email;
                $_SESSION['usertype'] = $usertype;
                header('Location: index.php');  // Redirect User to user dashboard
                break;
            
            case 'student':
                $_SESSION['username'] = $email;
                $_SESSION['usertype'] = $usertype;
                header('Location: index.php');  // Redirect Student to student dashboard
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
