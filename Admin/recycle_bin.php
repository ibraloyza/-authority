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
      <th>phone</th>
      <th>Restore</th>
      <th>Perm Delete</th>
    </tr>
  </thead>
  <tbody>
    <?php
        // Fetch only students who have been soft-deleted (is_deleted = 1)
        $query = "SELECT * FROM `students` WHERE `is_deleted` = 1";
        $result = mysqli_query($conn, $query);

        if(!$result){
            die('Query failed: ' . mysqli_error($conn));
        } else {
            while($row = mysqli_fetch_assoc($result)){
                ?>
                <tr>
                    <td><?php echo $row['student_id'];?></td>
                    <td><?php echo $row['name'];?></td>
                    <td><?php echo $row['email'];?></td>
                    <td><?php echo $row['phone'];?></td>
                    <td>
                        <!-- Restore Button -->
                        <a href="restore.php?student_id=<?php echo $row['student_id'];?>" class="btn btn-warning">Restore</a>
                    </td>
                    <td>
                        <!-- Permanently Delete Button -->
                        <a href="./delete_permanent.php?student_id=<?php echo $row['student_id'];?>" 
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