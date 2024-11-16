<?php
@include 'config.php';

session_start();

if (!isset($_SESSION['user_name'])) {
   header('location:login_form.php');
   exit();
}

// Fetch user data from the database
$user_name = $_SESSION['user_name'];
$query = "SELECT * FROM users WHERE username = '$user_name'";
$result = mysqli_query($conn, $query);
$user_data = mysqli_fetch_assoc($result);

// Handle form submission
if (isset($_POST['update_profile'])) {
   $new_email = mysqli_real_escape_string($conn, $_POST['email']);
   $new_contact = mysqli_real_escape_string($conn, $_POST['contact']);

   // Update user information in the database
   $update_query = "UPDATE users SET email = '$new_email', contact = '$new_contact' WHERE username = '$user_name'";
   
   if (mysqli_query($conn, $update_query)) {
      $success_message = "Profile updated successfully!";
   } else {
      $error_message = "Failed to update profile. Please try again.";
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Edit Profile</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
   <div class="container mt-5">
      <h2>Edit Profile</h2>

      <?php if (isset($success_message)) { ?>
         <div class="alert alert-success"><?php echo $success_message; ?></div>
      <?php } elseif (isset($error_message)) { ?>
         <div class="alert alert-danger"><?php echo $error_message; ?></div>
      <?php } ?>

      <form method="POST" action="">
         <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $user_data['email']; ?>" required>
         </div>
         <div class="mb-3">
            <label for="contact" class="form-label">Contact Number</label>
            <input type="text" class="form-control" id="contact" name="contact" value="<?php echo $user_data['contact']; ?>" required>
         </div>
         <button type="submit" name="update_profile" class="btn btn-primary">Update Profile</button>
      </form>
   </div>

   <!-- Bootstrap JS file link -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
