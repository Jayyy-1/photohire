<?php
@include 'config.php';
session_start();

if (!isset($_SESSION['admin_name'])) {
    header('location:login_form.php');
    exit();
}

// Fetch booking details from the database
$bookingsQuery = "SELECT * FROM photobooking ORDER BY event_date ASC";
$bookingsResult = mysqli_query($conn, $bookingsQuery);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Bookings</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css"> <!-- Optional custom CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
     body {
    background-color: #f3e8f5; /* Light violet background */
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: row;
    min-height: 100vh;
}

.sidebar {
    background-color: #3f0071; /* Violet color for the sidebar */
    width: 250px; /* Fixed width for sidebar */
    height: 100vh; /* Full height */
    position: fixed; /* Sidebar stays fixed */
    padding: 20px;
    box-sizing: border-box;
    transition: width 0.3s ease;
}

.sidebar a {
    color: white; /* White text for sidebar links */
    display: block;
    padding: 12px 20px;
    font-size: 1.1rem;
    text-decoration: none;
    transition: background-color 0.3s, color 0.3s;
}

.sidebar a:hover {
    background-color: #6f42c1; /* Lighter violet on hover */
    color: white;
}

/* Responsive table design */
.table-striped tbody tr:nth-of-type(odd) {
    background-color: #e9d8eb; /* Light violet for table rows */
}

.table thead th {
    background-color: #3f0071; /* Violet header background */
    color: white; /* White text for table header */
    padding: 12px;
    font-size: 1.1rem;
}

.table {
    width: 100%;
    margin-left: 250px; /* Offset for sidebar */
    padding: 20px;
    box-sizing: border-box;
}

.table td, .table th {
    padding: 12px;
    text-align: left;
}

/* Adjust layout for small screens */
@media (max-width: 1024px) {
    .sidebar {
        width: 220px; /* Slightly narrower sidebar */
    }

    .table {
        margin-left: 220px; /* Adjust for narrower sidebar */
    }
}

@media (max-width: 768px) {
    body {
        flex-direction: column; /* Stack sidebar and content vertically on small screens */
    }

    .sidebar {
        width: 100%; /* Full width on small screens */
        position: relative;
        height: auto;
        display: none; /* Hide sidebar on mobile */
    }

    .sidebar a {
        padding: 12px 15px; /* Adjust padding for smaller screens */
        font-size: 1rem; /* Adjust font size */
    }

    .table {
        margin-left: 0; /* Remove left margin to make table full width */
        font-size: 0.9rem; /* Smaller font size on mobile */
        padding: 10px;
        overflow-x: auto; /* Allow horizontal scrolling for the table */
    }

    .table thead th {
        font-size: 1rem; /* Slightly smaller header font on mobile */
    }

    /* Show sidebar toggle button on mobile */
    .sidebar-toggle-btn {
        display: block;
        position: absolute;
        top: 20px;
        left: 20px;
        background-color: #3f0071;
        color: white;
        border: none;
        padding: 10px;
        font-size: 1.2rem;
        cursor: pointer;
    }
}

@media (max-width: 576px) {
    .sidebar a {
        font-size: 0.9rem; /* Adjust font size for extra small screens */
    }

    .table {
        font-size: 0.8rem; /* Even smaller font size on extra small screens */
    }

    .table td, .table th {
        padding: 8px; /* Reduce padding for smaller screens */
    }
}


    </style>
</head>
<body>
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
                    <li class="nav-item">
                        <a class="nav-link" href="manage_bookings.php">
                            <i class="bi bi-calendar-check-fill"></i> Manage Bookings
                        </a>
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
                <h1 class="h2">Manage Bookings</h1>
            </div>

            <div class="row">
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
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        if ($bookingsResult) {
                            while ($row = mysqli_fetch_assoc($bookingsResult)) {
                                echo "<tr>
                                         <td>{$row['id']}</td>
                                         <td>{$row['customer_name']}</td>
                                         <td>{$row['event_date']}</td>
                                         <td>{$row['theme']}</td>
                                         <td>{$row['email']}</td>
                                         <td>{$row['contact_number']}</td>
                                         <td>
                                            <form method='POST' action='delete_booking.php' onsubmit='return confirm(\"Are you sure you want to delete this booking?\");'>
                                               <input type='hidden' name='booking_id' value='{$row['id']}'>
                                               <button type='submit' class='btn btn-danger btn-sm'>Delete</button>
                                            </form>
                                            <a href='edit_booking.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                                         </td>
                                   </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='9'>No bookings found.</td></tr>";
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
