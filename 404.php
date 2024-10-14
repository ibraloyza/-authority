<?php 
session_start(); 

$page_title = "Registration Form"; 
include('./includes/header.php'); 
include('./includes/navbar.php'); 
include './dbcon.php';


?>

<div class="container">
    <div class="row">
        <div class="col-md-6 m-auto text-center py-5 mt-5">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title bg-warning">Error Page</h1>
                    <h1 class="card-title"> 404 Error </h1>
                    <p class="card-text">the page you are searching is not availble</p>
                    <a href="index.php">go back to the home page</a>
                </div>
            </div>

        </div>
    </div>
</div>






<?php include './includes/footer.php'; ?>