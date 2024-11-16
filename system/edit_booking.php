<?php
@include 'config.php';
session_start();

if (!isset($_SESSION['admin_name'])) {
    header('location:login_form.php');
    exit();
}

if (isset($_GET['id'])) {
    $booking_id = mysqli_real_escape_string($conn, $_GET['id']);
    
    // Fetch current booking details
    $bookingQuery = "SELECT * FROM photobooking WHERE id = '$booking_id'";
    $bookingResult = mysqli_query($conn, $bookingQuery);
    $booking = mysqli_fetch_assoc($bookingResult);
} else {
    header('Location: manage_bookings.php?msg=No booking ID specified.');
}

// Handle update
if (isset($_POST['update_booking'])) {
    // Capture new booking data from the form
    $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
    $event_date = mysqli_real_escape_string($conn, $_POST['event_date']);
    $payment = mysqli_real_escape_string($conn, $_POST['payment']);
    $amount = mysqli_real_escape_string($conn, $_POST['amount']);
    $theme = mysqli_real_escape_string($conn, $_POST['theme']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $contact_number = mysqli_real_escape_string($conn, $_POST['contact_number']);

    // Update query
    $updateQuery = "UPDATE photobooking SET 
        customer_name = '$customer_name', 
        event_date = '$event_date', 
        payment = '$payment', 
        amount = '$amount', 
        theme = '$theme', 
        email = '$email', 
        contact_number = '$contact_number' 
        WHERE id = '$booking_id'";

    if (mysqli_query($conn, $updateQuery)) {
        header('Location: manage_bookings.php?msg=Booking updated successfully.');
    } else {
        header('Location: manage_bookings.php?msg=Error updating booking: ' . mysqli_error($conn));
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Booking</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2>Edit Booking</h2>
    <form method="POST">
        <input type="hidden" name="booking_id" value="<?php echo $booking['id']; ?>">
        <div class="mb-3">
            <label for="customer_name" class="form-label">Customer Name</label>
            <input type="text" class="form-control" id="customer_name" name="customer_name" value="<?php echo $booking['customer_name']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="event_date" class="form-label">Event Date</label>
            <input type="date" class="form-control" id="event_date" name="event_date" value="<?php echo $booking['event_date']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="theme" class="form-label">Theme</label>
            <input type="text" class="form-control" id="theme" name="theme" value="<?php echo $booking['theme']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $booking['email']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="contact_number" class="form-label">Contact Number</label>
            <input type="text" class="form-control" id="contact_number" name="contact_number" value="<?php echo $booking['contact_number']; ?>" required>
        </div>
        <button type="submit" name="update_booking" class="btn btn-primary">Update Booking</button>
        <a href="manage_bookings.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
