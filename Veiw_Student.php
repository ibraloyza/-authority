<?php 
session_start(); 

$page_title = "Registration Form"; 
include('./includes/header.php'); 
include('./includes/navbar.php'); 
include './dbcon.php';


?>
<div class="box1">
    <h2 class="text-center">All students</h2>
    <button class="btn btn-primary " data-toggle="modal" data-target="#exampleModal">ADD STUDENTS</button>
    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
        <a class=" btn btn-warning" href="./recycle_bin.php">Recycle Bin</a>
    </ul>

    </li>

</div>

<table class="table table-hover table-bordered table-striped">
  <thead>
    <tr>
      <th>student_id</th>
      <th>Name</th>
      <th>Phone</th>
      <th>Email</th>
      <th>action</th>
    </tr>
  </thead>
  <tbody>
    <?php
            // Fetch only students who have not been soft-deleted (is_deleted = 0)
            $query = "SELECT * FROM `students` WHERE `is_deleted` = 0";

            $result = mysqli_query($conn, $query);
            if(!$result){
                die('query failed'.mysqli_error($conn));
            }else{
                while($row = mysqli_fetch_assoc($result)){
                    ?>
                <tr>
                    <td><?php echo $row['student_id'];?></td>
                    <td><?php echo $row['name'];?></td>
                    <td><?php echo $row['phone'];?></td>
                    <td><?php echo $row['email'];?></td>
                 
                    <td><a href="./Update.php?student_id=<?php echo $row['student_id'];?>" class="btn btn-success">Update</a>
                    <!-- Delete button with confirmation -->
                    
                        <a href="./delete.php?student_id=<?php echo $row['student_id'];?>" 
                            class="btn btn-danger" 
                            onclick="return confirm('Are you sure you want to temporarily delete this student?');">
                            Delete
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
    if(isset($_GET['message'])){
        echo "<h5>".$_GET['message']."</h5>";
    }
?>
<?php
    if(isset($_GET['insert_data_msg'])){
        echo "<h6>".$_GET['insert_data_msg']."</h6>";
    }
?>
<?php
    if(isset($_GET['update_msg'])){
        echo "<h6>".$_GET['update_msg']."</h6>";
    }
?>
<?php
    if(isset($_GET['delete_msg'])){
        echo "<h6>".$_GET['delete_msg']."</h6>";
    }
?>

<?php include './includes/footer.php'; ?>
