<?php 
// Corrected path to authentication.php
include ('./authentication.php'); 

$page_title = "Dashboard"; 
include('./includes/header.php'); 
include('./includes/navbar.php'); 
?>

<div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar">
                <h4 class="text-center">Dashboard</h4>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./course.php">
                            upload Courses
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./Veiw_Student.php">
                            Veiw Students
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./Veiw_teacher.php">
                            Teachers
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            Enrollments
                        </a>
                    </li>
                </ul>
            </nav>
            <main  role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 content">
                <?php include './Veiw_courses.php'; ?>
            </main>
       
        </div>
    </div>

<?php include './includes/footer.php'; ?>
