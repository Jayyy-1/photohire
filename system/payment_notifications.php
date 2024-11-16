<?php
session_start();
@include 'config.php';

if (!isset($_SESSION['admin_name'])) {
    header('location:login_form.php');
    exit();
}

// Fetch unread admin notifications
$adminNotificationsQuery = "SELECT * FROM notifications WHERE notification_type = 'admin' AND is_read = 0 ORDER BY created_at DESC";
$adminNotificationsResult = mysqli_query($conn, $adminNotificationsQuery);

// Mark as read or approve payment
if (isset($_POST['mark_as_read'])) {
    $notification_id = $_POST['notification_id'];
    $updateNotifQuery = "UPDATE notifications SET is_read = 1 WHERE notification_id = '$notification_id'";
    mysqli_query($conn, $updateNotifQuery);
    header("Location: payment_notifications.php");
    exit();
}

if (isset($_POST['approve_payment'])) {
    $user_id = $_POST['user_id'];
    $paymentUpdateQuery = "UPDATE payments SET payment_status = 'approved' WHERE user_id = '$user_id' AND payment_status = 'pending'";
    mysqli_query($conn, $paymentUpdateQuery);

    // Update notification to read status
    $notification_id = $_POST['notification_id'];
    $updateNotifQuery = "UPDATE notifications SET is_read = 1 WHERE notification_id = '$notification_id'";
    mysqli_query($conn, $updateNotifQuery);
    header("Location: payment_notifications.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Payment Notifications</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
       body {
    background-color: #f8f9fa;
    margin: 0;
    padding: 0;
    font-family: 'Arial', sans-serif;
}

.container {
    max-width: 900px; /* Increase container width */
    margin: 30px auto; /* Center container with auto margin */
    background-color: #ffffff;
    padding: 2rem;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

h3 {
    color: #343a40;
    margin-bottom: 20px;
    font-size: 1.75rem; /* Larger, more prominent heading */
    font-weight: 600;
}

.notification {
    background-color: #f1f3f5;
    padding: 1.5rem;
    border-radius: 8px;
    margin-bottom: 1.5rem;
    border-left: 5px solid #007bff;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.notification p {
    font-size: 14px;
    color: #495057;
    margin-bottom: 0.5rem;
}

.notification small {
    color: #6c757d;
}

.btn-primary {
    background-color: #007bff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    color: #ffffff;
    font-size: 1rem;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background-color: #0056b3;
    cursor: pointer;
}

.btn-secondary {
    background-color: #6c757d;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    color: #ffffff;
    font-size: 1rem;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-secondary:hover {
    background-color: #5a6268;
    cursor: pointer;
}

@media screen and (max-width: 768px) {
    .container {
        padding: 1.5rem; /* Reduce padding for smaller screens */
        max-width: 100%; /* Allow full-width on small devices */
    }

    h3 {
        font-size: 1.5rem; /* Adjust heading size for smaller screens */
    }

    .btn-primary, .btn-secondary {
        width: 100%; /* Make buttons full width on small screens */
        padding: 12px;
        margin-top: 10px; /* Add space between buttons */
    }
}

@media screen and (max-width: 480px) {
    .notification {
        padding: 1rem; /* Reduce padding in notifications for very small screens */
    }

    h3 {
        font-size: 1.25rem; /* Smaller heading for very small screens */
    }
}

    </style>
</head>
<body>

<div class="container">
    <h3 class="text-center">Admin Payment Notifications</h3>
    <?php if (mysqli_num_rows($adminNotificationsResult) > 0): ?>
        <?php while ($notif = mysqli_fetch_assoc($adminNotificationsResult)): ?>
            <div class="notification">
                <p><strong><?php echo htmlspecialchars($notif['message']); ?></strong></p>
                <p><small>Created on: <?php echo date("Y-m-d H:i:s", strtotime($notif['created_at'])); ?></small></p>
                <form method="post" action="" class="d-flex gap-2">
                    <input type="hidden" name="notification_id" value="<?php echo $notif['notification_id']; ?>">
                    <input type="hidden" name="user_id" value="<?php echo $notif['user_id']; ?>">
                    <button type="submit" name="mark_as_read" class="btn btn-secondary btn-sm w-100 w-sm-auto">Mark as Read</button>
                    <button type="submit" name="approve_payment" class="btn btn-primary btn-sm w-100 w-sm-auto">Approve Payment</button>
                </form>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p class="text-center text-muted">No new notifications.</p>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
