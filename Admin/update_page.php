<?php 
session_start();
include('includes/header.php');
include('includes/navbar.php');
include('../dbcon.php');

?>



<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary text-center text-3xl" id="exampleModalLabel">Edit Addmin profile</h3>
        </div>
        <div class="modal-body">
            <?php 
            if(isset($_POST['edit_btn']))
            {
                $id = $_POST['edit_id'];

                $query = "SELECT * FROM admin WHERE id   = '$id'";
                $query_run = mysqli_query($conn, $query);

                foreach($query_run as $row)
                {
            ?>

            <form action="code.php" method="POST">
                <input type="hidden" name="edit_id" value= "<?php echo $row['id'];?>">
                <div class="form-group">
                        <label for="username">userName</label>
                        <input type="text" value= "<?php echo $row['name'];?>" name="edit_username" class="form-control">
                </div>
                <div class="form-group">
                    <label for="Email">Email</label>
                    <input type="email" value= "<?php echo $row['email'];?>" name="edit_Email" class="form-control">
                </div>
                <div class="form-group mb-3"> 
                    <label for="">Phone Number</label> 
                    <input type="tel" name="Update_phone" value= "<?php echo $row['phone'];?>"  class="form-control" required> 
                </div>

                <select name="Update_usertype" class="form-control">
                    <?php
                    $role_query = "SELECT * FROM roles";
                    $role_query_run = mysqli_query($conn, $role_query);
                    if (mysqli_num_rows($role_query_run) > 0) {
                        while ($row = mysqli_fetch_assoc($role_query_run)) {
                            echo "<option value='".$row['role_id']."'>".$row['role_name']."</option>";
                        }
                    }
                    ?>
                </select>


                <div class="modal-footer">
                    <a href="register.php" class="btn btn-danger" data-dismiss="modal">Close</button></a>
                    <button type="submit" class="btn btn-primary" name="update_btn" value="ADD">Update</button>
                </div>
            </form>
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