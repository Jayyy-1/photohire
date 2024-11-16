   <?php
   @include 'config.php';

   if (isset($_POST['submit'])) {
      $name = mysqli_real_escape_string($conn, $_POST['name']);
      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $pass = md5($_POST['password']);
      $cpass = md5($_POST['cpassword']);
      $user_type = $_POST['user_type'];

      $select = "SELECT * FROM user_form WHERE email = '$email'";

      $result = mysqli_query($conn, $select);

      if (mysqli_num_rows($result) > 0) {
         $error[] = 'User already exists!';
      } else {
         if ($pass != $cpass) {
               $error[] = 'Passwords do not match!';
         } else {
               $insert = "INSERT INTO user_form(name, email, password, user_type) VALUES('$name','$email','$pass','$user_type')";
               mysqli_query($conn, $insert);
               header('location:login_form.php');
         }
      }
   }
   ?>

   <!DOCTYPE html>
   <html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Register | Gringrove</title>

      <!-- Bootstrap CSS -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
      <!-- Anime.js for animations -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>

      <style>
         body {
            background: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
         }
         .form-container {
            background-color: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.1);
            position: relative;
            width: 100%;
            max-width: 400px;
         }
         .form-container h3 {
            text-align: center;
            color: #495057;
            font-weight: bold;
         }
         .form-label {
            color: #495057;
         }
         .form-control {
            border: 2px solid violet;
            border-radius: 30px;
            padding: 10px 15px;
            transition: 0.3s;
         }
         .form-control:focus {
            border-color: violet;
            box-shadow: none;
         }
         .error-msg {
            display: block;
            background: #ffdddd;
            color: #d9534f;
            padding: 10px;
            margin-bottom: 15px;
            text-align: center;
            border-radius: 5px;
         }
         .form-btn {
            background-color: violet;
            border: none;
            color: #fff;
            border-radius: 30px;
            padding: 10px 0;
            cursor: pointer;
            transition: 0.3s;
            width: 100%;
         }
         .form-btn:hover {
            background-color: violet;
         }
         .link {
            text-align: center;
            color: violet;
            margin-top: 10px;
         }
         svg {
            position: absolute;
            top: -10px;
            left: -10px;
            z-index: -1;
         }
         path {
            fill: none;
            stroke: #89c2d9;
            stroke-width: 3;
            stroke-dasharray: 300;
            stroke-dashoffset: 300;
         }
      </style>
   </head>
   <body>

   <div class="form-container">
      <h3>Register Now</h3>

      <?php
         if (isset($error)) {
            foreach ($error as $error) {
               echo '<span class="error-msg">'.$error.'</span>';
            }
         }
      ?>

      <form action="" method="post">
         <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" name="name" id="name" class="form-control" required placeholder="Enter your name">
         </div>

         <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" name="email" id="email" class="form-control" required placeholder="Enter your email">
         </div>

         <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control" required placeholder="Enter your password">
         </div>

         <div class="mb-3">
            <label for="cpassword" class="form-label">Confirm Password</label>
            <input type="password" name="cpassword" id="cpassword" class="form-control" required placeholder="Confirm your password">
         </div>

         <div class="mb-3">
            <label for="user_type" class="form-label">User </label>
            <select name="user_type" class="form-select" id="user_type">
               <option value="user">User</option>
               <option value="admin"></option>
            </select>
         </div>

         <input type="submit" name="submit" value="Register Now" class="form-btn">
         <p class="link">Already have an account? <a href="login_form.php">Login now</a></p>
      </form>

      <!-- Animated SVG Path -->
      <svg width="600" height="400" viewBox="0 0 600 400">
         <path d="M10,10 C150,350 450,350 590,10" />
      </svg>
   </div>

   <!-- Bootstrap JS -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

   <!-- Anime.js Animation Script -->
   <script>
      anime({
         targets: 'path',
         strokeDashoffset: [anime.setDashoffset, 0],
         easing: 'easeInOutSine',
         duration: 3000,
         delay: function(el, i) { return i * 250 },
         direction: 'alternate',
         loop: true
      });
   </script>

   </body>
   </html>
