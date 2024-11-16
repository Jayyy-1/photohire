<?php

@include 'config.php';

session_start();

// Login Script
@include 'config.php';

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = md5($_POST['password']); // Consider switching to password_hash()

    $select = "SELECT * FROM user_form WHERE email = '$email' AND password = '$pass'";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $_SESSION['user_id'] = $row['id']; // Store user ID in session
        $_SESSION['user_name'] = $row['name'];

        if ($row['user_type'] == 'admin') {
            header('location:admin_page.php');
        } else {
            header('location:user_page.php');
        }
    } else {
        $error[] = 'Incorrect email or password!';
    }
}



if (isset($_POST['submit'])) {

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);

   $select = "SELECT * FROM user_form WHERE email = '$email' && password = '$pass'";
   $result = mysqli_query($conn, $select);

   if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_array($result);
      if ($row['user_type'] == 'admin') {
         $_SESSION['admin_name'] = $row['name'];
         header('location:admin_page.php');
      } elseif ($row['user_type'] == 'user') {
         $_SESSION['user_name'] = $row['name'];
         header('location:user_page.php');
      }
   } else {
      $error[] = 'Incorrect email or password!';
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login | Gringrove</title>

   <!-- Bootstrap CSS file link -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   <style>
      body {
         background: #f7f6f2;
      }
      .form-container {
         max-width: 400px;
         margin: 100px auto;
         padding: 30px;
         border-radius: 15px;
         box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
         background: #ffffff;
      }
      .form-title {
         font-family: 'Arial', sans-serif;
         text-align: center;
         margin-bottom: 1rem;
         color: #3A3B3C;
         font-weight: 600;
      }
      .input-submit {
         width: 100%;
         height: 50px;
         background: violet;
         font-size: 16px;
         font-weight: 500;
         border: none;
         border-radius: 30px;
         cursor: pointer;
         transition: 0.3s;
      }
      .input-submit:hover {
         background: #89c2d9;
      }
      .form-label {
         color: #495057;
      }
      .alert {
         background-color: #ffdddd;
         color: #b00f0f;
      }
      .small-logo {
         display: block; /* Center the logo */
         margin: 0 auto 20px; /* Margin below the logo */
         width: 200px; /* Adjust this size as needed */
         height: auto; /* Maintain aspect ratio */
      }

   </style>
</head>
<body>

   <div class="container">
      <div class="form-container">
      <img src="https://scontent.fmnl33-2.fna.fbcdn.net/v/t1.15752-9/449475073_913484477203476_804443557467684110_n.png?stp=dst-png_s2048x2048&_nc_cat=104&ccb=1-7&_nc_sid=9f807c&_nc_eui2=AeFN_22NXVg_h7uzQu8RSAjVMDb4Cz3Z6fgwNvgLPdnp-FUUpMe1m_n87hp3Vke1LkMA7GoMa4dy3LmeB1IyzZ9F&_nc_ohc=8Vtv_5ah8XQQ7kNvgGnnUT7&_nc_zt=23&_nc_ht=scontent.fmnl33-2.fna&_nc_gid=A2IQZV-6uXjCsZzvCPudRB1&oh=03_Q7cD1QHrqehRAH1DdmlBDZCAvsnryptO8av2Or0sxxF4UOfoRg&oe=674D051C" alt="Logo" class="small-logo"> <!-- Replace with your logo path -->
         <h3 class="text-center text-muted">Login Now</h3>

         <?php
            if (isset($error)) {
               foreach ($error as $error) {
                  echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
               }
            }
         ?>

         <form action="" method="post">
            <div class="mb-3">
               <label for="email" class="form-label">Email Address</label>
               <input type="email" name="email" id="email" class="form-control" required placeholder="Enter your email">
            </div>
            <div class="mb-3">
               <label for="password" class="form-label">Password</label>
               <input type="password" name="password" id="password" class="form-control" required placeholder="Enter your password">
            </div>
            <div class="d-grid">
               <input type="submit" name="submit" value="Login Now" class="input-submit">
            </div>
            <p class="text-center mt-3">Don't have an account? <a href="register_form.php" class="text-decoration-none" style="color: violet;">Register now</a></p>
         </form>
      </div>
   </div>

   <!-- Bootstrap JS and dependencies -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
