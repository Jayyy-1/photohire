<?php
@include 'config.php';

session_start();

if (isset($_POST['notification_id'])) {
   $notificationId = $_POST['notification_id'];

   // Update notification status to approved
   $approveQuery = "UPDATE notifications SET status = 'approved' WHERE id = $notificationId";
   if (mysqli_query($conn, $approveQuery)) {
       header('Location: admin_page.php?message=Notification approved successfully!');
   } else {
       header('Location: admin_page.php?message=Error approving notification.');
   }
   exit();
}
?>
    