<?php
include ('./authentication.php');
$page_title = "update"; 
include('./includes/header.php'); 
include('./includes/navbar.php'); 
include './dbcon.php';
?>

<?php
if (isset($_GET['student_id'])) {
    $id =  $_GET['student_id'];
    $query = "SELECT * FROM `students` WHERE `student_id` = '$id'";
    $result = mysqli_query($conn, $query);
    
    if (!$result) {
        die('Query failed: ' . mysqli_error($conn));
    } else {
        $row = mysqli_fetch_assoc($result);
        // Add this line to check if data was retrieved
        // var_dump($row);  // This should output the student's data array
    }
}

?>

<?php
if (isset($_POST['Update_students'])) {
    $student_id = mysqli_real_escape_string($conn, $_POST['student_id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $query = "UPDATE `students` SET `name` = '$name', `phone` = '$phone', `email` = '$email' WHERE `student_id` = '$student_id'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die('Query failed: ' . mysqli_error($conn));
    } else {
        header('location:Veiw_Student.php?update_msg=updated succesfully');
    }
}
?>

<form action="Update.php?student_id=<?php echo $id; ?>" method="post">
    <div class="form-group">
        <label for="f_name">Student ID</label>
        <input type="text" name="student_id" required class="form-control" value="<?php echo isset($row['student_id']) ? htmlspecialchars($row['student_id']) : ''; ?>">
    </div>
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" required class="form-control" value="<?php echo isset($row['name']) ? htmlspecialchars($row['name']) : ''; ?>">
    </div>
    <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" name="phone" required class="form-control" value="<?php echo isset($row['phone']) ? htmlspecialchars($row['phone']) : ''; ?>">
    </div>
    <div class="form-group">
        <label for="Email">Email</label>
        <input type="email" name="email" required class="form-control" value="<?php echo isset($row['email']) ? htmlspecialchars($row['email']) : ''; ?>">
    </div>
    <input type="submit" class="btn btn-success" name="Update_students" value="Update">
</form>

<?php include('./includes/footer.php'); ?>
