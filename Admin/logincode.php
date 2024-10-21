<?php
session_start();
include('../dbcon.php');

if (isset($_POST['login_btn'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']); 



    
    
    // Query to check the email from the admin table and join with the roles table to get the usertype (role_name)
    $login_query_admin = "
        SELECT admin.*, roles.role_name 
        FROM admin 
        JOIN roles ON admin.role_id = roles.id 
        WHERE admin.email = '$email' 
        LIMIT 1";
    // Query to check the email from the teachers table and join with the roles table to get the usertype (role_name)
    $login_query_teacher = "
        SELECT teachers.*, roles.role_name 
        FROM teachers 
        JOIN roles ON teachers.role_id = roles.id 
        WHERE teachers.email = '$email' 
        LIMIT 1";
    // Query to check the email from the students table and join with the roles table to get the usertype (role_name)
    $login_query_student = "
        SELECT students.*, roles.role_name 
        FROM students 
        JOIN roles ON students.role_id = roles.id 
        WHERE students.email = '$email' 
        LIMIT 1";
    
    $login_query_admin_run = mysqli_query($conn, $login_query_admin);
    $login_query_teacher_run = mysqli_query($conn, $login_query_teacher);
    $login_query_student_run = mysqli_query($conn, $login_query_student);
    
    if (mysqli_num_rows($login_query_admin_run) > 0) 
    {
        // Fetch the user data
        $row = mysqli_fetch_assoc($login_query_admin_run);
        $hashed_password = $row['password']; // Fetch the hashed password from the database
        $usertype = $row['role_name']; // Fetch the role_name from the roles table

        
        
        // Verify the password entered by the user against the hashed password in the database
        if (password_verify($password, $hashed_password)) {
            // Password is correct, proceed to login
            switch ($usertype) {
                case 'Admin':
                    $_SESSION['username'] = $email;
                    $_SESSION['usertype'] = $usertype;
                    header('Location: index.php');  // Redirect Admin to dashboard
                    break;
                    
                case 'Student':
                    $_SESSION['username'] = $email;
                    $_SESSION['usertype'] = $usertype;
                    header('Location: index.php');  // Redirect Teacher to teacher dashboard
                    break;
                
                case 'Teacher':
                    $_SESSION['username'] = $email;
                    $_SESSION['usertype'] = $usertype;
                    header('Location: index.php');  // Redirect Student to student dashboard
                    break;
                    
                default:
                    $_SESSION['status'] = "Invalid email / password";
                    header('Location: login.php');
                    break;
            }
        }         
        else 
        {
            // $_SESSION['status'] = "Invalid email / password";
            header('Location: login.php');
        }
    }
    elseif(mysqli_num_rows($login_query_teacher_run) > 0 )
    {
        // Fetch the user data
        $row = mysqli_fetch_assoc($login_query_teacher_run);
        $hashed_password = $row['password']; // Fetch the hashed password from the database
        $usertype = $row['role_name']; // Fetch the role_name from the roles table
        
        // Verify the password entered by the user against the hashed password in the database
        if (password_verify($password, $hashed_password)) {
            // Password is correct, proceed to login
            switch ($usertype) {
                case 'Admin':
                    $_SESSION['username'] = $email;
                    $_SESSION['usertype'] = $usertype;
                    header('Location: index.php');  // Redirect Admin to dashboard
                    break;
                    
                case 'Student':
                    $_SESSION['username'] = $email;
                    $_SESSION['usertype'] = $usertype;
                    header('Location: index.php');  // Redirect Teacher to teacher dashboard
                    break;
                
                case 'Teacher':
                    $_SESSION['username'] = $email;
                    $_SESSION['usertype'] = $usertype;
                    header('Location: index.php');  // Redirect Student to student dashboard
                    break;
                    
                default:
                    // $_SESSION['status'] = "Invalid email / password";
                    header('Location: login.php');
                    break;
            }
        }         
        else 
        {
            // $_SESSION['status'] = "Invalid email / password";
            header('Location: login.php');
        }
    }
    elseif(mysqli_num_rows($login_query_student_run) > 0 )
    {
        // Fetch the user data
        $row = mysqli_fetch_assoc($login_query_student_run);
        $hashed_password = $row['password']; // Fetch the hashed password from the database
        $usertype = $row['role_name']; // Fetch the role_name from the roles table
        
        // Verify the password entered by the user against the hashed password in the database
        if (password_verify($password, $hashed_password)) {
            // Password is correct, proceed to login
            switch ($usertype) {
                case 'Admin':
                    $_SESSION['username'] = $email;
                    $_SESSION['usertype'] = $usertype;
                    header('Location: index.php');  // Redirect Admin to dashboard
                    break;
                    
                case 'Student':
                    $_SESSION['username'] = $email;
                    $_SESSION['usertype'] = $usertype;
                    header('Location: index.php');  // Redirect Teacher to teacher dashboard
                    break;
                
                case 'Teacher':
                    $_SESSION['username'] = $email;
                    $_SESSION['usertype'] = $usertype;
                    header('Location: index.php');  // Redirect Student to student dashboard
                    break;
                    
                default:
                    $_SESSION['status'] = "Invalid email / password";
                    header('Location: login.php');
                    break;
            }
        }         
        else 
        {
            // $_SESSION['status'] = "Invalid email / password";
            header('Location: login.php');
        }
    }
    else 
    {
        $_SESSION['status'] = "Invalid email / password";
        header('Location: login.php');
    }
}
?>
