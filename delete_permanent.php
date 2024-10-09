<?php include './dbcon.php';?>

<?php
if (isset($_GET['student_id'])) {
    $id = $_GET['student_id'];

    // Delete the student record permanently from the database
    $query = "DELETE FROM `students` WHERE `student_id` = '$id'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    } else {
        header('Location: ./recycle_bin.php?delete_msg=Student has been permanently deleted');
    }
}
?>
