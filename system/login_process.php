<?php
session_start();
@include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = "SELECT id FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user_name'] = $username;
        $_SESSION['user_id'] = $row['id']; // Set user ID in session
        header('location:user_page.php');
    } else {
        echo "Invalid login credentials.";
    }
}
