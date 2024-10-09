<?php 
include ('./authentication.php');

$page_title = "Registration Form"; 
include('./includes/header.php'); 
include('./includes/navbar.php'); 
include './dbcon.php';


?>
<div class="card">
  <div class="card-shadow">
    <div class="card-body">
      <form action="">
        <div class="form-group mb-3">
            <label for="">hello</label>
            <input type="text" name="hello" />
        </div>
        <div class="form-group mb-3">
            <label for="">hello</label>
            <input type="text" name="hello" />
        </div>
        <div class="form-group mb-3">
            <label for="">hello</label>
            <input type="text" name="hello" />
        </div>
        <div class="form-group mb-3">
            <label for="">hello</label>
            <input type="text" name="hello" />
        </div>
      </form>
    </div>
  </div>
</div>

<?php include('./includes/footer.php'); ?>
