<?php
@include 'config.php';
session_start();

if (!isset($_SESSION['user_name'])) {
   header('location:login_form.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>User Dashboard - Browse Services</title>

   <!-- Bootstrap CSS file link -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="css/style.css"> <!-- Optional custom CSS -->
   <style>
       body {
           background-color: #ffffff; /* White background */
           color: #1a003c; /* Dark violet text for contrast */
       }

       .sidebar {
           background-color: #3f0071; /* Dark violet sidebar */
       }

       .nav-link {
           color: #ffffff; /* White link color */
       }

       .nav-link:hover {
           color: #1a003c;  /* Dark violet on hover */
           background-color: #ffffff; /* White background on hover */
       }

       .card {
           background-color: #f8f9fa; /* Light background for cards */
           border: 1px solid #1a003c; /* Dark violet border */
       }

       .card-title {
           color: #1a003c; /* Dark violet title color */
       }

       .btn-outline-primary {
           color: #1a003c;
           border-color: #1a003c;
       }

       .btn-outline-primary:hover {
           background-color: #1a003c;
           color: #ffffff;
       }

       .btn-outline-secondary {
           color: #1a003c;
           border-color: #1a003c;
       }

       .btn-outline-secondary:hover {
           background-color: #1a003c;
           color: #ffffff;
       }

       .btn-outline-warning {
           color: #1a003c;
           border-color: #1a003c;
       }

       .btn-outline-warning:hover {
           background-color: #1a003c;
           color: #ffffff;
       }

       .btn-outline-info {
           color: #1a003c;
           border-color: #1a003c;
       }

       .btn-outline-info:hover {
           background-color: #1a003c;
           color: #ffffff;
       }
   </style>
</head>
<body>

<div class="container-fluid">
   <div class="row">
      <nav class="col-md-3 col-lg-2 d-md-block sidebar text-white">
         <div class="position-sticky pt-3">
            <h4 class="text-center mt-3">Welcome, <span><?php echo $_SESSION['user_name'] ?></span></h4>
            <ul class="nav flex-column mt-4">
               <li class="nav-item">
                  <a class="nav-link" href="user_page.php">
                     <i class="bi bi-house-fill"></i> Dashboard
                  </a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="browse_services.php">
                     <i class="bi bi-briefcase-fill"></i> Browse Services
                  </a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="photobooking.php">
                     <i class="bi bi-calendar-check-fill"></i> Photo Booking
                  </a>
               </li>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="logout.php">
                     <i class="bi bi-box-arrow-right"></i> Logout
                  </a>
               </li>
            </ul>
         </div>
      </nav>

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
         <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Browse Services</h1>
         </div>

         <div class="container">
            <div class="row">
               <!-- Bronze Packages -->
               <div class="col-md-4 mb-4">
                  <div class="card shadow-sm">
                     <div class="card-body">
                        <h5 class="card-title">Bronze I Package</h5>
                        <p class="card-text">Starting at ₱2,899</p>
                        <a href="bronze1_package.php" class="btn btn-outline-primary">Learn More</a>
                     </div>
                  </div>
               </div>
               <div class="col-md-4 mb-4">
                  <div class="card shadow-sm">
                     <div class="card-body">
                        <h5 class="card-title">Bronze II Package</h5>
                        <p class="card-text">Starting at ₱3,399</p>
                        <a href="bronze2_package.php" class="btn btn-outline-primary">Learn More</a>
                     </div>
                  </div>
               </div>

               <!-- Silver Packages -->
               <div class="col-md-4 mb-4">
                  <div class="card shadow-sm">
                     <div class="card-body">
                        <h5 class="card-title">Silver I Package</h5>
                        <p class="card-text">Starting at ₱3,899</p>
                        <a href="silver1_package.php" class="btn btn-outline-secondary">Learn More</a>
                     </div>
                  </div>
               </div>
               <div class="col-md-4 mb-4">
                  <div class="card shadow-sm">
                     <div class="card-body">
                        <h5 class="card-title">Silver II Package</h5>
                        <p class="card-text">Starting at ₱4,399</p>
                        <a href="silver2_package.php" class="btn btn-outline-secondary">Learn More</a>
                     </div>
                  </div>
               </div>

               <!-- Gold Packages -->
               <div class="col-md-4 mb-4">
                  <div class="card shadow-sm">
                     <div class="card-body">
                        <h5 class="card-title">Gold I Package</h5>
                        <p class="card-text">Starting at ₱4,899</p>
                        <a href="gold1_package.php" class="btn btn-outline-warning">Learn More</a>
                     </div>
                  </div>
               </div>
               <div class="col-md-4 mb-4">
                  <div class="card shadow-sm">
                     <div class="card-body">
                        <h5 class="card-title">Gold II Package</h5>
                        <p class="card-text">Starting at ₱5,399</p>
                        <a href="gold2_package.php" class="btn btn-outline-warning">Learn More</a>
                     </div>
                  </div>
               </div>

               <!-- Other Services -->
               <div class="col-md-4 mb-4">
                  <div class="card shadow-sm">
                     <div class="card-body">
                        <h5 class="card-title">Photo Coverage</h5>
                        <p class="card-text">Starting at ₱3,500</p>
                        <a href="Photo Coverage.php   " class="btn btn-outline-info">Learn More</a>
                     </div>
                  </div>
               </div>
               <div class="col-md-4 mb-4">
                  <div class="card shadow-sm">
                     <div class="card-body">
                        <h5 class="card-title">Video Coverage</h5>
                        <p class="card-text">Starting at ₱4,500</p>
                        <a href="video_coverage.php" class="btn btn-outline-info">Learn More</a>
                     </div>
                  </div>
               </div>
               <div class="col-md-4 mb-4">
                  <div class="card shadow-sm">
                     <div class="card-body">
                        <h5 class="card-title">Same Day Edit Video</h5>
                        <p class="card-text">Starting at ₱4,500</p>
                        <a href="same_day_edit.php" class="btn btn-outline-info">Learn More</a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </main>
   </div>
</div>

<!-- Bootstrap JS file link -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Optionally include Bootstrap Icons CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</body>
</html>
