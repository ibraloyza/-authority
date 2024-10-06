<?php 
session_start();
include('../dbcon.php');
include('includes/header.php');
include('includes/navbar.php');

?>


<!-- Modal -->
<div class="modal fade" id="addAdminProfile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Add Students</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="code.php" method="POST">
        <div class="modal-body">

            <div class="form-group">
                    <label for="f_name">id</label>
                    <input type="text" name="id" class="form-control">
            </div>
            <div class="form-group">
                    <label for="f_name">userName</label>
                    <input type="text" name="username" class="form-control">
            </div>
            <div class="form-group">
                <label for="Email">Email</label>
                <input type="email" name="email" class="form-control">
            </div>
            <div class="form-group">
                <label for="pass">password</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group">
                <label for="pass">confirmPassword</label>
                <input type="password" name="confirmPassword" class="form-control">
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-success" name="register_btn" value="ADD">
            </div>
        </div>
      </form>

    </div>
  </div>
  
</div>

<div class="container-fluid">

<div class="card shadow mb-4">
    <div class="card-header py-4">
        <h6 class="m-0 font-weight-bold text-primary">Admin profile
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAdminProfile">
            Add Admin Profile
        </button>                
        </h6>
    </div>
    <div class="card-body">
        <?php
         if (isset($_SESSION['success'])&& $_SESSION['success'] != '') 
         {
            echo '<h2>'.$_SESSION['success'].'</h2>';
            unset($_SESSION['success']);
         }
         if (isset($_SESSION['status'])&& $_SESSION['status'] != '') 
         {
            echo '<h2 class="bg-info"> '.$_SESSION['status'].'</h2>';
            unset($_SESSION['status']);
         }
        ?>
        <div class="table-responsive">
        <?php 
        $query= "SELECT * FROM users";
        $query_run = mysqli_query($conn, $query);
        ?>
        <table class="table table-hover table-bordered table-striped">
            <thead>
                <tr>
                <th>id</th>
                <th>userName</th>
                <th>Email</th>
                <th>Update</th>
                <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if(mysqli_num_rows($query_run) >0)
                {
                    while($row = mysqli_fetch_assoc($query_run))
                    {
                        
                        ?>
                        

                    <tr>
                        <td><?php echo $row['user_id'];?></td>
                        <td><?php echo $row['user_name'];?></td>
                        <td><?php echo $row['email'];?></td>
                        <td><a href="update_page1.php?id=<?php echo $row['user_id'];?>" class="btn btn-success">Update</a></td>
                        <td><a href="delete_page.php?id=<?php echo $row['user_id'];?>" class="btn btn-danger">Delete</a></td>

                    </tr>
                <?php
                    }
                }
                else
                {
                    echo "no recorded";
                }
                
                ?>

            </tbody>
        </table>
        </div>
    </div>
</div>










<?php 
include('includes/script.php');
include('includes/footer.php');
?>
