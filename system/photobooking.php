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
   <title>User Dashboard - Photo Booking</title>

   <!-- Bootstrap CSS file link -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="css/style.css">
   <style>
       body {
           background-color: #f8f9fa;
       }

       .sidebar {
           background-color: #3f0071;
           width: 200px;
       }

       .sidebar .nav-link {
           color: #ffffff;
           padding: 10px;
           font-size: 0.9rem;
       }

       .sidebar .nav-link:hover {
           color: #3f0071;
           background-color: #ffffff;
       }

       .btn-primary {
           background-color: #3f0071;
           border-color: #3f0071;
       }

       .btn-primary:hover {
           background-color: #ffffff;
           color: #3f0071;
           border-color: #3f0071;
       }

       .form-label {
           color: #3f0071;
       }

       .container, .container-fluid {
           padding-left: 10px;
           padding-right: 10px;
       }
   </style>
</head>
<body>

<div class="container-fluid">
   <div class="row">
      <nav class="col-md-2 sidebar d-md-block p-2">
         <div class="text-center text-white py-3">
            <h4>Welcome, <span><?php echo $_SESSION['user_name'] ?></span></h4>
         </div>
         <ul class="nav flex-column">
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
            <li class="nav-item">
               <a class="nav-link" href="logout.php">
                  <i class="bi bi-box-arrow-right"></i> Logout
               </a>
            </li>
         </ul>
      </nav>

      <main class="col-md-10 ms-sm-auto">
         <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Photo Booking</h1>
         </div>

         <div class="container">
            <form action="process_booking.php" method="POST">
               <div class="row g-3">
                  <div class="col-md-6">
                     <label for="package" class="form-label">Select Package</label>
                     <select class="form-select" id="package" name="package" required>
                        <option value="">Choose...</option>
                        <option value="Bronze I Package">Bronze I Package - ₱2,899</option>
                        <option value="Bronze II Package">Bronze II Package - ₱3,399</option>
                        <option value="Silver I Package">Silver I Package - ₱3,899</option>
                        <option value="Silver II Package">Silver II Package - ₱4,399</option>
                        <option value="Gold I Package">Gold I Package - ₱4,899</option>
                        <option value="Gold II Package">Gold II Package - ₱5,44  9</option>
                        <option value="Custom Package">Create Your Own Package</option>
                     </select>
                  </div>

                  <div class="col-md-6">
                     <label for="event_date" class="form-label">Date of Event</label>
                     <input type="date" class="form-control" id="event_date" name="event_date" required>
                  </div>
                  <div class="col-md-6">
                     <label for="customer_name" class="form-label">Name</label>
                     <input type="text" class="form-control" id="customer_name" name="customer_name" required>
                  </div>

                  <div class="col-md-6">
                     <label for="email" class="form-label">Email Address</label>
                     <input type="email" class="form-control" id="email" name="email" required>
                  </div>

                  <div class="col-md-6">
                     <label for="contact_number" class="form-label">Contact Number</label>
                     <input type="text" class="form-control" id="contact_number" name="contact_number" required>
                  </div>

                  <div class="col-md-6">
                     <label for="address" class="form-label">Customer Address</label>
                     <input type="text" class="form-control" id="address" name="address" required>
                  </div>

                  <div class="col-md-6">
                     <label for="celebrant_name" class="form-label">Celebrant Name</label>
                     <input type="text" class="form-control" id="celebrant_name" name="celebrant_name" required>
                  </div>

                  <div class="col-md-6">
                     <label for="event_type" class="form-label">Event Type</label>
                     <input type="text" class="form-control" id="event_type" name="event_type" required>
                  </div>

                  <div class="col-md-6">
                     <label for="venue" class="form-label">Venue Full Address</label>
                     <input type="text" class="form-control" id="venue" name="venue" required>
                  </div>

                  <div class="col-md-6">
                     <label for="theme" class="form-label">Theme</label>
                     <input type="text" class="form-control" id="theme" name="theme">
                  </div>
               </div>
                  <div id="custom-package-fields" style="display: none;">
                     <div class="col-md-6">
                        <label for="services" class="form-label">Select Services</label>
                        <select class="form-select" id="services" name="services[]" multiple>
                           <option value="Photography">Photography</option>
                           <option value="Videography">Videography</option>
                           <option value="Photo Album">Photo Album</option>
                           <option value="Drone Coverage">Drone Coverage</option>
                           <option value="Event Coordination">Event Coordination</option>
                        </select>
                     </div>

                     <div class="col-md-6">
                        <label for="custom_notes" class="form-label">Special Instructions</label>
                        <textarea class="form-control" id="custom_notes" name="custom_notes" rows="3"></textarea>
                     </div>
                  </div>
               </div>
               <div class="d-flex justify-content-end mt-4">
                  <button type="submit" class="btn btn-primary">Book Now</button>
               </div>
            </form>
         </div>
      </main>
   </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
   document.getElementById('package').addEventListener('change', function () {
      const customFields = document.getElementById('custom-package-fields');
      if (this.value === 'Custom Package') {
         customFields.style.display = 'block';
      } else {
         customFields.style.display = 'none';
      }
   });
</script>
</body>
</html>
