<?php
include('../dbcon.php');

if(isset($_GET['student_id'])){
    $id = $_GET['student_id'];


    // Update the is_deleted column to 1 (soft delete)
    $query = "UPDATE `students` SET `is_deleted` = 1 WHERE `student_id` = '$id'";
    $result = mysqli_query($conn, $query);
    
    if(!$result){
        die("query failed" . mysqli_error($conn));
    }else{
        header('location:./Veiw_Student.php?delete_msg=you have deleted the data');
    }
}
if(isset($_GET['teacher_id'])){
    $id = $_GET['teacher_id'];


    // Update the is_deleted column to 1 (soft delete)
    $query = "UPDATE `teachers` SET `is_deleted` = 1 WHERE `teacher_id` = '$id'";
    $result = mysqli_query($conn, $query);
    
    if(!$result){
        die("query failed" . mysqli_error($conn));
    }else{
        header('location:./Veiw_Student.php?delete_msg=you have deleted the data');
    }
}






?>