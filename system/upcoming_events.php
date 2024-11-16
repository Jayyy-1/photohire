<?php
@include 'config.php';

session_start();

if (!isset($_SESSION['admin_name'])) {
   header('location:login_form.php');
   exit();
}

// Query to fetch upcoming events
$upcomingEventsQuery = "SELECT * FROM photobooking WHERE event_date >= CURDATE() ORDER BY event_date ASC";
$upcomingEventsResult = mysqli_query($conn, $upcomingEventsQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
   <title>Upcoming Events</title>
   <style>
       body {
           background-color: #f8f9fa;
       }
       h1 {
           color: #343a40;
       }
       .card {
           margin-top: 20px;
       }
   </style>
</head>
<body>
   <!-- Navbar -->
   <nav class="navbar navbar-expand-lg navbar-light bg-light">
       <a class="navbar-brand" href="#">GRINGROOVE</a>
       <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
           <span class="navbar-toggler-icon"></span>
       </button>
       <div class="collapse navbar-collapse" id="navbarNav">
           <ul class="navbar-nav ml-auto">
               <li class="nav-item">
                   <a class="nav-link" href="logout.php">Logout</a>
               </li>
           </ul>
       </div>
   </nav>

   <div class="container">
       <h1 class="mt-4">Upcoming Events</h1>
      

       <div class="card">
           <div class="card-body">
               <?php if (mysqli_num_rows($upcomingEventsResult) > 0): ?>
                   <table class="table table-hover table-bordered">
                       <thead class="thead-light">
                           <tr>
                               <th scope="col">Event Date</th>
                               <th scope="col">Customer Name</th>
                               <th scope="col">Event Type</th>
                               <th scope="col">Venue</th>
                               <th scope="col">Theme</th>
                               <th scope="col">Contact</th>
                           </tr>
                       </thead>
                       <tbody>
                           <?php while ($event = mysqli_fetch_assoc($upcomingEventsResult)): ?>
                               <tr>
                                   <td><?php echo htmlspecialchars($event['event_date']); ?></td>
                                   <td><?php echo htmlspecialchars($event['customer_name']); ?></td>
                                   <td><?php echo htmlspecialchars($event['event_type']); ?></td>
                                   <td><?php echo htmlspecialchars($event['venue']); ?></td>
                                   <td><?php echo htmlspecialchars($event['theme']); ?></td>
                                   <td><?php echo htmlspecialchars($event['contact_number']); ?></td>
                               </tr>
                           <?php endwhile; ?>
                       </tbody>
                   </table>
               <?php else: ?>
                   <p class="text-muted">No upcoming events found.</p>
               <?php endif; ?>
           </div>
       </div>
       <a href="admin_page.php" class="btn btn-secondary mb-3">Back</a> <!-- Back Button -->
   </div>

   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
