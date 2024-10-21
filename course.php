<?php 

include './Admin/security.php';
include './dbcon.php';

// include ('./authentication.php'); 
include('./includes/header.php');
include('./includes/navbar.php');

// // Debug: Check the content of the $_POST array
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     echo "<pre>";
//     var_dump($_POST);
//     echo "</pre>";
// }

if(isset($_POST['submit'])){
    $course_Name = mysqli_real_escape_string($conn, $_POST['course_name']); // Escape input
    $file_Name = $_FILES['image']['name'];
    $tempName = $_FILES['image']['tmp_name'];
    $folder = 'images/' . $file_Name;
    
    // Check if the teacher_id is set in the POST request
    if (isset($_POST['teacher_id'])) {
        $teacher_id = $_POST['teacher_id']; // Use 'teacher_id' from the POST request
    } else {
        $teacher_id = null; // If no teacher is selected, set as null
    }
    
    $desc_course = mysqli_real_escape_string($conn, $_POST['description']); // Escape input

    // Check if teacher_id is valid and not empty
    if(!empty($teacher_id)) {
        // Insert course into the database
        $query = "INSERT INTO courses(course_name, course_image, teacher_id, description) 
                  VALUES ('$course_Name', '$file_Name', '$teacher_id', '$desc_course')";
                  
        $result_query = mysqli_query($conn, $query);

        // Check if the query was successful
        if($result_query){
            // Move uploaded file
            if(move_uploaded_file($tempName, $folder)){
                header('location:./Veiw_courses.php?course_msg= this course  uploaded successfully');
               
            } else {
                echo "<h2>File upload failed</h2>"; 
            }
        } else {
            echo "<h2>Query failed: " . mysqli_error($conn) . "</h2>";
        }
    } else {
        echo "<h2>Invalid teacher selection</h2>";
    }
}
?>

<div class="">
    <div class="card-header">
        <h5>Upload the Course</h5>
    </div>
    <div class="card-body">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group mb-3">
                <label for="course_image">Course Image:</label>
                <input type="file" name="image" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label for="course_name">Course Name:</label>
                <input type="text" name="course_name" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label for="teacher_id">Assign Teacher:</label>
                <select name="teacher_id" class="form-control" required>
                    <option value="" disabled selected>Select a teacher</option>
                    <?php
                    // Fetch all teachers from the teachers table
                    $teachers_query = mysqli_query($conn, "SELECT * FROM teachers");
                    while ($teacher = mysqli_fetch_assoc($teachers_query)) {
                        echo "<option value='{$teacher['teacher_id']}'>{$teacher['teacher_name']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="description">Description:</label>
                <textarea name="description" class="form-control" required></textarea>
            </div>           
            <div class="form-group">
                <input type="submit" name="submit" class="btn btn-primary" value="Add Course">
            </div>
        </form>
    </div>

</div>

<?php include ('./includes/footer.php'); ?>
