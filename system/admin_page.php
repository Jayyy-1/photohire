   <?php
   @include 'config.php';

   session_start();

   if (!isset($_SESSION['admin_name'])) {
      header('location:login_form.php');
      exit();
   }

   // Query the database to count total bookings
   $totalBookingsQuery = "SELECT COUNT(*) AS total FROM photobooking";
   $result = mysqli_query($conn, $totalBookingsQuery);
   $totalBookings = 0; // Default if query fails

   if ($result) {
      $row = mysqli_fetch_assoc($result);
      $totalBookings = $row['total'];
   }

   // Query to fetch upcoming events
   $upcomingEventsQuery = "SELECT * FROM photobooking WHERE event_date >= CURDATE() ORDER BY event_date ASC";
   $upcomingEventsResult = mysqli_query($conn, $upcomingEventsQuery);
   ?>
   <!DOCTYPE html>
   <html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Admin Dashboard</title>

      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" href="style.css"> 
      <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
      <style>
        body {
    background-color: #f3e8f5; /* Light violet background */
    margin: 0;
    padding: 0;
    display: flex;
    min-height: 100vh;
    flex-direction: column; /* Stack the layout vertically */
}

.sidebar {
    background-color: #3f0071; /* Violet color for the sidebar */
    width: 250px; /* Fixed width for the sidebar */
    position: fixed; /* Sidebar remains fixed on the left */
    height: 100vh; /* Full height of the viewport */
    top: 0;
    left: 0;
    padding: 20px;
}

.sidebar a {
    color: white; /* White text for sidebar links */
    display: block;
    padding: 10px 0;
    text-decoration: none;
    font-size: 1.2em;
}

.sidebar a:hover {
    color: #f8f9fa; /* Change color on hover */
    background-color: #6f42c1; /* Slightly lighter violet on hover */
}

.card {
    margin: 20px;
    flex: 1; /* Allow card to grow and fill available space */
}

.card-header {
    background-color: #3f0071; /* Darker violet for card header */
    color: black;
}

.card-title {
    color: #6f42c1; /* Violet for card title */
}

.table-striped tbody tr:nth-of-type(odd) {
    background-color: #e9d8eb; /* Light violet for table rows */
}

.bg-img {
    background-image: url(''); /* Optional background image */
    background-size: cover;
    position: relative;
    height: 100vh; /* Cover the entire viewport height */
}

/* Main content area */
.main-content {
    margin-left: 250px; /* Leave space for the sidebar */
    padding: 20px;
    flex: 1; /* Allow content to take the remaining space */
}

table {
    width: 100%; /* Ensure tables are full width */
    border-collapse: collapse;
}

table th, table td {
    padding: 12px;
    text-align: left;
}

@media screen and (max-width: 768px) {
    .sidebar {
        width: 200px; /* Adjust sidebar size on smaller screens */
    }

    .main-content {
        margin-left: 200px; /* Adjust content area */
    }

    .sidebar a {
        font-size: 1em;
    }
}

         
      </style>
   </head>
   <body>
   <div class="bg-img">
   <div class="bg-overlay"></div>
   <div class="container-fluid">
      <div class="row">
         <nav class="col-md-3 col-lg-2 d-md-block sidebar text-white">
            <div class="position-sticky pt-3">
               <h1>WELCOME</h1>
               <ul class="nav flex-column mt-4">
                  <li class="nav-item">
                     <a class="nav-link" href="admin_page.php">
                        <i class="bi bi-house-fill"></i> Dashboard
                     </a>
                  </li>
                 
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="upcoming_events.php">
                        <i class="bi bi-calendar-event-fill"></i> Upcoming Events
                     </a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="reviews.php">
                        <i class="bi bi-star-fill"></i> My Reviews
                     </a>
                  </li>
                  <?php
// Query to get the count of unread notifications for the admin
   $unreadAdminNotifQuery = "SELECT COUNT(*) AS unread_count FROM notifications WHERE notification_type = 'admin' AND is_read = 0";
   $unreadResult = mysqli_query($conn, $unreadAdminNotifQuery);
   $unreadCount = mysqli_fetch_assoc($unreadResult)['unread_count'];
   ?>

   <li class="nav-item">
      <a class="nav-link text-white" href="payment_notifications.php">
         <i class="bi bi-bell-fill"></i> Payment Notifications
         <?php if ($unreadCount > 0): ?>
            <span class="badge bg-danger ms-2"><?php echo $unreadCount; ?></span>
         <?php endif; ?>
      </a>
   </li>

                     </a>
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
               <h1 class="h2">Admin Dashboard</h1>
            </div>

            <div class="row">
               <!-- Total Bookings Card -->
               <div class="col-md-4 mb-4">
                  <div class="card shadow-sm">
                     <div class="card-header">
                        <h5 class="card-title">Total Bookings</h5>
                     </div>
                     <div class="card-body">
                        <p class="card-text">You have <strong><?php echo $totalBookings; ?></strong> bookings.</p>
                     </div>
                  </div>
               </div>


               <!-- Booking Details Section -->
               <div class="col-md-12">
                  <h3 class="mt-4">Booking Details</h3>
                  <table class="table table-striped">
                     <thead>
                        <tr>
                           <th scope="col">Booking ID</th>
                           <th scope="col">Customer Name</th>
                           <th scope="col">Event Date</th>
                           <th scope="col">Theme</th>
                           <th scope="col">Email</th>
                           <th scope="col">Contact N#</th>
                           <th scope="col">Venue</th>
                           <th scope="col">Created_At</th>
                           <th scope="col">Actions</th>
                        </tr>
                     </thead>
                     <tbody>
                     <?php
                     // Fetch booking details from the database
                     $result = mysqli_query($conn, "SELECT * FROM photobooking");
                     while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                                 <td>{$row['user_id']}</td>
                                 <td>{$row['customer_name']}</td>
                                 <td>{$row['event_date']}</td>
                                 <td>{$row['theme']}</td>
                                 <td>{$row['email']}</td>
                                 <td>{$row['contact_number']}</td>
                                   <td>{$row['venue']}</td>
                                     <td>{$row['created_at']}</td>
                                    


                                 <td>
                                    <form method='POST' action='delete_booking.php' onsubmit='return confirm(\"Are you sure you want to delete this booking?\");'>
                                       <input type='hidden' name='booking_id' value='{$row['user_id']}'>
                                       <button type='submit' class='btn btn-danger btn-sm'>Delete</button>
                                    </form>
                                 </td>
                           </tr>";
                           
                     }
                     ?>
                     </tbody>
                  </table>
               </div>
            </div>
         </main>
      </div>
   </div>

   <!-- Bootstrap JS file link -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
   </body>
   </html>
