<?php
@include 'config.php';

session_start();

// Booking Handling Script
@include 'config.php';


@include 'config.php';
session_start();

if (!isset($_SESSION['user_name'])) {
   header('location:login_form.php');
   exit;
}
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('User ID not found. Please log in again.'); window.location.href='login_form.php';</script>";
    exit();
}

// Booking Handling
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize form data
    $event_date = mysqli_real_escape_string($conn, $_POST['event_date']);
    $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
    $amount = mysqli_real_escape_string($conn, $_POST['amount']);
    $payment = mysqli_real_escape_string($conn, $_POST['payment']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $contact_number = mysqli_real_escape_string($conn, $_POST['contact_number']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $celebrant_name = mysqli_real_escape_string($conn, $_POST['celebrant_name']);
    $event_type = mysqli_real_escape_string($conn, $_POST['event_type']);
    $venue = mysqli_real_escape_string($conn, $_POST['venue']);
    $theme = mysqli_real_escape_string($conn, $_POST['theme']);
    
    // Prepare statement to insert booking
    $stmt = $conn->prepare("INSERT INTO photobooking (user_id, event_date, customer_name, amount, payment, email, contact_number, address, celebrant_name, event_type, venue, theme) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $user_id = $_SESSION['user_id']; // User ID from session
    $stmt->bind_param("issdssssssss", $user_id, $event_date, $customer_name, $amount, $payment, $email, $contact_number, $address, $celebrant_name, $event_type, $venue, $theme);

    if ($stmt->execute()) {
        echo "<script>alert('Booking successful!'); window.location.href='user_page.php';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "'); window.location.href='photobooking.php';</script>";
    }

    $stmt->close();
    $conn->close();
}

   // Assuming user_id is stored in session (you should have user authentication setup)
   $user_id = $_SESSION['user_id']; 

   $stmt = $conn->prepare("INSERT INTO photobooking (user_id, event_date, customer_name, amount, payment, email, contact_number, address, celebrant_name, event_type, venue, theme) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
   $stmt->bind_param("issdssssssss", $user_id, $event_date, $customer_name, $amount, $payment, $email, $contact_number, $address, $celebrant_name, $event_type, $venue, $theme);

   if ($stmt->execute()) {
       echo "Booking successful!";
       // Optionally redirect or display a success message
   } else {
       echo "Error: " . $stmt->error;
   }

   $stmt->close();
   $conn->close();

?>


if (!isset($_SESSION['user_id'])) { // Check user_id in session
    echo "<script>alert('User ID not found. Please log in again.'); window.location.href='login_form.php';</script>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id']; // User ID from session
    $package = mysqli_real_escape_string($conn, $_POST['package']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $time = mysqli_real_escape_string($conn, $_POST['time']);
    $details = mysqli_real_escape_string($conn, $_POST['details']);

    // Insert the booking details into the database
    $query = "INSERT INTO photobooking (user_id, package, booking_date, booking_time, additional_details) 
              VALUES ('$user_id', '$package', '$date', '$time', '$details')";
    
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Booking successful!'); window.location.href='user_page.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "'); window.location.href='photobooking.php';</script>";
    }
}


if (!isset($_SESSION['user_name'])) {
    header('location:login_form.php');
    exit(); // Always exit after redirection
}

// Debugging: Check if user_id is set in session
echo '<pre>';
print_r($_SESSION); // Check session variables
echo '</pre>';

// Check if user_id is set in session
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('User ID not found. Please log in again.'); window.location.href='login_form.php';</script>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id']; // Assuming you have stored user ID in session
    $package = mysqli_real_escape_string($conn, $_POST['package']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $time = mysqli_real_escape_string($conn, $_POST['time']);
    $details = mysqli_real_escape_string($conn, $_POST['details']);

    // Insert the booking details into the database
    $query = "INSERT INTO bookings (user_id, package, booking_date, booking_time, additional_details) VALUES ('$user_id', '$package', '$date', '$time', '$details')";
    
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Booking successful!'); window.location.href='user_page.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "'); window.location.href='photobooking.php';</script>";
    }

    // In process_booking.php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id']; // Assuming you have stored user ID in session
    $package = mysqli_real_escape_string($conn, $_POST['package']);
    $event_date = mysqli_real_escape_string($conn, $_POST['event_date']);
    $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
    $amount = mysqli_real_escape_string($conn, $_POST['amount']);
    $payment = mysqli_real_escape_string($conn, $_POST['payment']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $contact_number = mysqli_real_escape_string($conn, $_POST['contact_number']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $celebrant_name = mysqli_real_escape_string($conn, $_POST['celebrant_name']);
    $event_type = mysqli_real_escape_string($conn, $_POST['event_type']);
    $venue = mysqli_real_escape_string($conn, $_POST['venue']);
    $theme = mysqli_real_escape_string($conn, $_POST['theme']);

    // Insert the booking details into the database
    $query = "INSERT INTO bookings (user_id, package, event_date, customer_name, amount, payment, email, contact_number, address, celebrant_name, event_type, venue, theme) 
              VALUES ('$user_id', '$package', '$event_date', '$customer_name', '$amount', '$payment', '$email', '$contact_number', '$address', '$celebrant_name', '$event_type', '$venue', '$theme')";
    
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Booking successful!'); window.location.href='user_page.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "'); window.location.href='photobooking.php';</script>";
    }
}
<?php

@include 'config.php';
session_start();

if (!isset($_SESSION['user_name'])) {
   header('location:login_form.php');
}

// Fetch the booking date from POST request
$event_date = $_POST['event_date'];

// Query the database to check if the selected date is already booked
$sql = "SELECT * FROM bookings WHERE event_date = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $event_date);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // If the date is already booked
    $_SESSION['error_message'] = "The selected date is already booked. Please choose another date.";
    header('location: photobooking.php'); // Redirect back to the booking form
    exit();
}

// Proceed with the rest of the booking process (insert into database)
$package = $_POST['package'];
$customer_name = $_POST['customer_name'];
$email = $_POST['email'];
$contact_number = $_POST['contact_number'];
$address = $_POST['address'];
$celebrant_name = $_POST['celebrant_name'];
$event_type = $_POST['event_type'];
$venue = $_POST['venue'];
$theme = $_POST['theme'];

// Additional details for custom package
$services = isset($_POST['services']) ? implode(", ", $_POST['services']) : '';
$custom_notes = $_POST['custom_notes'] ?? '';

// Insert into the database
$insert_sql = "INSERT INTO bookings (user_name, package, event_date, customer_name, email, contact_number, address, celebrant_name, event_type, venue, theme, services, custom_notes) 
               VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($insert_sql);
$stmt->bind_param('sssssssssssss', $_SESSION['user_name'], $package, $event_date, $customer_name, $email, $contact_number, $address, $celebrant_name, $event_type, $venue, $theme, $services, $custom_notes);
$stmt->execute();

// Redirect to confirmation page
header('location: confirmation.php');
?>

}
?>>
