<?php 
// session_start();
include('security.php');
$page_title = "Courses"; 
include('includes/header.php');
include('includes/navbar.php');
include('../dbcon.php');


?>


<div class="container mt-5">
    <h2 class="text-center mb-4"><?php echo $page_title; ?></h2>

    <div class="row">
        <?php 
            // Query to fetch all courses with their associated teacher or NULL
            $query = "
                SELECT courses.course_image, courses.course_name, teachers.teacher_name, courses.description 
                FROM courses
                LEFT JOIN teachers ON courses.teacher_id = teachers.teacher_id;
            ";
        
            $results = mysqli_query($conn, $query);

            if(!$results) {
                die('Query failed: ' . mysqli_error($conn));
            } else {
                while($row = mysqli_fetch_assoc($results)) {
        ?>
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <a href="./enrollment.php"><img src="../images/<?php echo htmlspecialchars($row['course_image']); ?>" class="card-img-top img-fluid" alt="Course Image">
                </a>
 
                <div class="card-body">
                    <h5 class="card-title"><strong>Course Name:</strong> <?php echo htmlspecialchars($row['course_name']); ?></h5>
                    <!-- Display teacher name, default to 'Unknown' if null -->
                    <p class="card-text"><strong>Teacher:</strong> <?php echo $row['teacher_name'] ? htmlspecialchars($row['teacher_name']) : 'Unknown'; ?></p>
                    <!-- Display course description -->
                    <p class="card-text"><?php echo htmlspecialchars($row['description']); ?></p>
                </div>
            </div>
        </div>
        <?php 
                } 
            }
        ?>
    </div>
</div>

<?php 
include('includes/script.php');
include('includes/footer.php');
?>
