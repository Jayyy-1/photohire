<?php

@include 'config.php';

session_start();

if (!isset($_SESSION['user_name'])) {
    header('location:login_form.php');
}

// Fetch user details from the database
$user_email = $_SESSION['user_name'];
$query = "SELECT * FROM user_form WHERE email = '$user_email'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>User Profile</title>

   <!-- Bootstrap CSS file link -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="css/style.css"> <!-- Optional custom CSS -->
</head>
<body class="bg-light">

<div class="container mt-5">
   <h1 class="text-center">Profile Details</h1>
   <div class="card p-4">


         <a href="edit_profile.php" class="btn btn-primary">Edit Profile</a>
         <a href="user_page.php" class="btn btn-secondary">Back to Dashboard</a>
         <a href="logout.php" class="btn btn-danger">Logout</a>
      </div>
   </div>
</div>

<!-- Bootstrap JS file link -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
