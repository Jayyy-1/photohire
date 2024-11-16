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
   <title>User Dashboard</title>

   <!-- Bootstrap CSS file link -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="css/style.css"> <!-- Optional custom CSS -->
   
   <style>
      body {
         background-color: #f7f6f2; /* Light background for the body */
      }
      .bg-dark {
         background-color: #3f0071 !important; /* Dark violet sidebar color */
      }
      .sidebar a {
         color: #fff; /* Keep sidebar links white */
      }
      .sidebar a:hover {
         color: #f8f9fa; /* Change color on hover */
         background-color: #6f42c1; /* Slightly lighter violet on hover */
      }
      .text-black {
         color: #000 !important; /* Ensures black text for cards */
      }
      .card {
         border: none; /* Remove card borders */
      }
      .logo {
         width: 100px; /* Adjust the logo size as needed */
         margin: 20px auto; /* Center the logo */
         display: block; /* Centering the image */
      }
   </style>
</head>
<body>

<div class="container-fluid">
   <div class="row">
      <nav class="col-md-3 col-lg-2 d-md-block bg-dark sidebar text-white">
         <div class="position-sticky pt-3">
            <!-- Logo Section -->
            <img src="https://scontent.fmnl33-3.fna.fbcdn.net/v/t1.15752-9/462640560_1935490000267008_2725820518226130777_n.png?_nc_cat=110&ccb=1-7&_nc_sid=9f807c&_nc_eui2=AeGxmKRA0Bxs-K345Z_HAxfgw42wfqAwNwPDjbB-oDA3A0weSBz2MFMS8LiogNdTPMu7HNtAVCYFQfW9k-MrvocG&_nc_ohc=WOBXsypXNRsQ7kNvgGTvlkw&_nc_zt=23&_nc_ht=scontent.fmnl33-3.fna&_nc_gid=ASmPkSqWNZtNc8JE0_Ei8Uq&oh=03_Q7cD1QGj5yzr8dqJiCt4_qvd0sjT5Nc4hYr1XmQ0qe0azMHYDA&oe=674ACB97" alt="Logo" class="logo"> <!-- Add your logo path here -->
        
            <ul class="nav flex-column mt-4">
               <li class="nav-item">
                  <a class="nav-link text-white" href="browse_services.php">
                     <i class="bi bi-briefcase-fill"></i> Browse Services
                  </a>
               </li>
               <li class="nav-item">
                  <a class="nav-link text-white" href="photobooking.php">
                     <i class="bi bi-calendar-check-fill"></i> Photo Booking
                  </a>
               </li>
               <li class="nav-item">
                <a class="nav-link text-white" href="reviews.php">
                     <i class="bi bi-star-fill"></i> Reviews
             </a>
             
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="payment_page.php">
                 <i class="bi bi-currency-exchange"></i> Payment
           </a>
            </li>

               </li>
               <li class="nav-item">
                  <a class="nav-link text-white" href="logout.php">
                     <i class="bi bi-box-arrow-right"></i> Logout
                  </a>
               </li>
            </li>
            </ul>
         </div>
      </nav>

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
         <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard</h1>
         </div>

         <div class="container">
            <div class="row">
               <div class="col-md-6 mb-4">
                  <div class="card shadow-sm">
                     <div class="card-body">
                        <h5 class="card-title text-black">Browse Services</h5>
                        <p class="card-text text-black">Explore a wide range of photography services offered by our platform.</p>
                        <a href="browse_services.php" class="btn btn-outline-primary">Explore</a>
                     </div>
                  </div>
               </div>
               <div class="col-md-6 mb-4">
                  <div class="card shadow-sm">
                     <div class="card-body">
                        <h5 class="card-title text-black">Photo Booking</h5>
                        <p class="card-text text-black">Easily book photo sessions for your events and special occasions.</p>
                        <a href="photobooking.php" class="btn btn-outline-success">Book Now</a>
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
