<?php 
session_start(); 
$page_title = "Login Form"; 
include('../includes/header.php');
include('../includes/navbar.php');
?>

<div class="py-5"> 

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

                <div class="card"> 

                    <div class="card-header"> 
                        <h5>Resend Email Verification</h5> 
                    </div>

                    <div class="card-body">

                        <form action="resend-code.php" method="POST">

                            <div class="form-group mb-3"> 
                                <label for="">Email Address</label> 
                                <input type="email" name="email_resend" class="form-control" placeholder="Enter Email Address">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" name="resend_email_btn">Submit</button> 
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include '../includes/footer.php';  ?>
