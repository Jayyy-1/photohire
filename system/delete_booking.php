<?php
@include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $booking_id = $_POST['booking_id'];

   // Prepare the DELETE SQL query
   $query = "DELETE FROM photobooking WHERE user_id = ?";
   $stmt = mysqli_prepare($conn, $query);
   
   // Bind and execute the statement
   mysqli_stmt_bind_param($stmt, "i", $booking_id);
   if (mysqli_stmt_execute($stmt)) {
      // Redirect to the admin page after successful deletion
      header("Location: admin_page.php");
      exit();
   } else {
      echo "Error deleting record: " . mysqli_error($conn);
   }

   mysqli_stmt_close($stmt);
}
@include 'config.php';


if (!isset($_SESSION['admin_name'])) {
    header('location:login_form.php');
    exit();
}

if (isset($_POST['booking_id'])) {
    $booking_id = mysqli_real_escape_string($conn, $_POST['booking_id']);
    
    // Delete query
    $deleteQuery = "DELETE FROM photobooking WHERE id = '$booking_id'";
    if (mysqli_query($conn, $deleteQuery)) {
        header('Location: manage_bookings.php?msg=Booking deleted successfully.');
    } else {
        header('Location: manage_bookings.php?msg=Error deleting booking: ' . mysqli_error($conn));
    }
} else {
    header('Location: manage_bookings.php?msg=No booking ID specified.');
}
?>

?>>
