<?php 
session_start();
include('includes/header.php');
include('includes/navbar.php');
include('../dbcon.php');

?>



<div class="container-fluid">
<div class="box1">
    <h2 class="text-center">Recycle Bin</h2>
</div>

<table class="table table-hover table-bordered table-striped">
  <thead>
    <tr>
      <th>user_id</th>
      <th>userName</th>
      <th>Email</th>
      <th>password</th>
      <th>Restore</th>
      <th>Perm Delete</th>
    </tr>
  </thead>
  <tbody>
    <?php
        // Fetch only students who have been soft-deleted (is_deleted = 1)
        $query = "SELECT * FROM `users` WHERE `is_deleted` = 1";
        $result = mysqli_query($conn, $query);

        if(!$result){
            die('Query failed: ' . mysqli_error($conn));
        } else {
            while($row = mysqli_fetch_assoc($result)){
                ?>
                <tr>
                    <td><?php echo $row['user_id'];?></td>
                    <td><?php echo $row['user_name'];?></td>
                    <td><?php echo $row['email'];?></td>
                    <td><?php echo $row['password'];?></td>
                    <td>
                        <!-- Restore Button -->
                        <a href="restore.php?user_id=<?php echo $row['user_id'];?>" class="btn btn-warning">Restore</a>
                    </td>
                    <td>
                        <!-- Permanently Delete Button -->
                        <a href="delete_permanent.php?user_id=<?php echo $row['user_id'];?>" 
                           class="btn btn-danger" 
                           onclick="return confirm('Are you sure you want to permanently delete this student? This action cannot be undone.');">
                           Perm Delete
                        </a>
                    </td>
                </tr>
                <?php
            }
        }
    ?>
  </tbody>
</table>




<?php 
include('includes/script.php');
include('includes/footer.php');
?>