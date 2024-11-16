<?php
@include 'config.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('location:login.php');
}

// Handle payment submission
if (isset($_POST['make_payment'])) {
    $user_id = $_SESSION['user_id'];
    $booking_id = mysqli_real_escape_string($conn, $_POST['booking_id']);
    $amount = mysqli_real_escape_string($conn, $_POST['amount']);
    $payment_method = mysqli_real_escape_string($conn, $_POST['payment_method']);

    // Check if booking exists
    $booking_query = "SELECT * FROM photobooking WHERE id = '$booking_id' AND user_id = '$user_id'";
    $booking_result = mysqli_query($conn, $booking_query);

    if (mysqli_num_rows($booking_result) > 0) {
        // Insert payment into the database
        $insert_payment_query = "INSERT INTO payments (user_id, booking_id, amount, payment_method) VALUES ('$user_id', '$booking_id', '$amount', '$payment_method')";
        
        if (mysqli_query($conn, $insert_payment_query)) {
            // Notify admin
            $to = 'admin@example.com';
            $subject = 'New Payment Received';
            $message = "
            <html>
            <head>
                <title>New Payment Notification</title>
            </head>
            <body>
                <h2>New Payment Received</h2>
                <p>A new payment has been made:</p>
                <ul>
                    <li><strong>User ID:</strong> $user_id</li>
                    <li><strong>Booking ID:</strong> $booking_id</li>
                    <li><strong>Amount:</strong> ₱$amount</li>
                    <li><strong>Payment Method:</strong> $payment_method</li>
                </ul>
                <p>Thank you!</p>
            </body>
            </html>
            ";

            $headers  = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= "From: noreply@yourdomain.com" . "\r\n"; // Replace with your domain
            
            mail($to, $subject, $message, $headers);
            echo "<div class='alert alert-success'>Payment processed successfully!</div>";
        } else {
            echo "<div class='alert alert-danger'>Error processing payment: " . mysqli_error($conn) . "</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Booking not found!</div>";
    }
}

// Fetch user's bookings for the payment form
$user_id = $_SESSION['user_id'];
$bookings_query = "SELECT * FROM photobooking WHERE user_id = '$user_id'";
$bookings_result = mysqli_query($conn, $bookings_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Make a Payment</h2>
        
        <form action="" method="post" class="mb-4">
            <div class="mb-3">
                <label for="booking_id" class="form-label">Select Booking</label>
                <select name="booking_id" id="booking_id" class="form-select" required>
                    <option value="">Select a booking</option>
                    <?php while ($booking = mysqli_fetch_assoc($bookings_result)): ?>
                        <option value="<?= $booking['id']; ?>"><?= $booking['description']; ?> - ₱<?= $booking['amount']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="amount" class="form-label">Amount</label>
                <input type="number" name="amount" id="amount" class="form-control" required placeholder="Enter amount" step="0.01">
            </div>
            <div class="mb-3">
                <label for="payment_method" class="form-label">Payment Method</label>
                <input type="text" name="payment_method" id="payment_method" class="form-control" required placeholder="Enter payment method (e.g. Credit Card)">
            </div>
            <button type="submit" name="make_payment" class="btn btn-primary">Make Payment</button>
        </form>
    </div>
</body>
</html>
