<?php 
$page_title = "Home Page"; 
include('includes/header.php'); 
include('includes/navbar.php');
?>

<div class="py-5">
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center">
        <h2>Welcome to the WEB OF IT</h2>
        <a href="./pages/register.php" class="">
        <button
          class="relative flex items-center btn btn-primary px-6 py-3 overflow-hidden font-medium transition-all bg-indigo-500 rounded-md group"
        >
          <span
            class="relative w-full text-left text-white transition-colors duration-200 ease-in-out group-hover:text-white"
            >Get Started</span
          >
        </button>
        </a>
      </div>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
