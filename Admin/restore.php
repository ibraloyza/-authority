<?php

include '../dbcon.php';
if (isset($_GET['student_id'])) {
    $id = $_GET['student_id'];

    // Update the is_deleted column to 0 to restore the student
    $query = "UPDATE `students` SET `is_deleted` = 0 WHERE `student_id` = '$id'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    } else {
        header('Location: ./Veiw_Student.php?restore_msg=Student has been restored successfully');
    }
}
?>
