<?php 
session_start(); 

$page_title = "Registration Form"; 
include('../includes/header.php'); 
include('../includes/navbar.php'); 
?>

<div id="Register" class="py-5" style="margin-top: -15px;"> 
    <div class="container"> 
        <div class="row justify-content-center"> 
            <div class="col-md-6">
                <?php
                if (isset($_SESSION['status'])) {
                    ?>
                    <div class="alert alert-success"> 
                        <h5><?= $_SESSION['status']; ?></h5>
                    </div>
                    <?php
                    unset($_SESSION['status']); 
                }
                ?>
                <div class="card shadow"> 
                    <div class="card-header"> 
                        <h5>Registration Form</h5>
                    </div>
                    <div class="card-body"> 
                        <form action="code.php" method="POST"> 
                            <div class="form-group mb-3"> 
                                <label for="">Name</label> 
                                <input type="text" name="name" class="form-control" required> 
                            </div>
                            <div class="form-group mb-3"> 
                                <label for="">Phone Number</label> 
                                <input type="tel" name="phone" class="form-control" required> 
                            </div>
                            <div class="form-group mb-3"> 
                                <label for="">Email Address</label> 
                                <input type="email" name="email" class="form-control" required> 
                            </div>
                            <div class="form-group mb-3"> 
                                <label for="">Password</label> 
                                <input type="password" name="password" class="form-control" required> 
                            </div>
                            <div class="form-group mb-3"> 
                                <label for="">Confirm Password</label> 
                                <input type="password" name="confirm_password" class="form-control" required> 
                            </div>
                            <!-- Set usertype as 'student' by default -->
                            <input type="hidden" name="usertype" value="student">
                            <div class="form-group"> 
                                <button type="submit" class="btn btn-primary" name="register_btn">Register Now</button> 
                                <p class="float-end">If you are registered, <a href="../Admin/login.php">login here</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
