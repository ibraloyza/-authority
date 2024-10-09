<?php

include('../config/dbconn.php'); // Database connection
include('./includes/navbar.php'); 
include('./config/dbconn.php');

// Get the course ID from the URL
if (isset($_GET['course_id'])) {
    $course_id = $_GET['course_id'];
    $student_id = $_SESSION['student_id']; // Assume student_id is stored in session after login

    // Check if the student is already enrolled in the course
    $check_query = "SELECT * FROM enrollments WHERE student_id = ? AND course_id = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("ii", $student_id, $course_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['status'] = "You are already enrolled in this course!";
    } else {
        // Insert enrollment record
        $insert_query = "INSERT INTO enrollments (student_id, course_id) VALUES (?, ?)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param("ii", $student_id, $course_id);

        if ($stmt->execute()) {
            $_SESSION['status'] = "You have successfully enrolled in the course!";
        } else {
            $_SESSION['status'] = "Error enrolling in the course!";
        }
    }

    // Redirect back to courses page
    header("Location: courses.php");
    exit(0);
} else {
    $_SESSION['status'] = "Invalid course selected!";
    header("Location: courses.php");
    exit(0);
}
?>
