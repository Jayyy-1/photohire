<?php
@include 'config.php';
session_start();

if (!isset($_SESSION['user_name'])) {
   header('location:login_form.php');
   exit();
}

// Handle new review submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['review_text'], $_POST['rating'])) {
   $userName = $_SESSION['user_name'];
   $reviewText = mysqli_real_escape_string($conn, $_POST['review_text']);
   $rating = (int) $_POST['rating'];

   $insertReview = "INSERT INTO reviews (user_name, review_text, rating) VALUES ('$userName', '$reviewText', '$rating')";
   mysqli_query($conn, $insertReview);
   header("Location: reviews.php");
   exit();
}

// Fetch reviews
$fetchReviews = "SELECT * FROM reviews ORDER BY created_at DESC";
$reviewsResult = mysqli_query($conn, $fetchReviews);
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Reviews</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   <style>
       body {
         background-color: #f8f9fa  ;
         color: #333;
         font-family: Arial, sans-serif;
      }
      .container {
         max-width: 700px;
         margin-top: 20px;
      }
      .card {
         border: none;
         border-radius: 6px;
         background-color: #ffffff;
         margin-top: 15px;
      }
      .card-title, h1 {
         color: #3a3a3a;
      }
      .btn-primary {
         background-color: #07080a;
         border: none;
         border-radius: 4px;
      }
      .btn-primary:hover {
         background-color: #0056b3;
      }
      h1 {
         text-align: center;
         margin-bottom: 15px;
         font-size: 1.75rem;
      }
      .form-label, .review-header {
         font-weight: bold;
         color: #333;
      }
      .rating-text {
         color: #6c757d;
         font-weight: bold;
         font-size: 0.9rem;
      }
      .text-muted {
         font-size: 0.85rem;
      }
      .card-body p {
         margin-bottom: 5px;
      }
   </style>
</head>
<body>

<div class="container">

   <h1>User Reviews</h1>

   <!-- Review Submission Form -->
   <div class="card shadow-sm">
      <div class="card-body">
         <h5 class="card-title">Add a Review</h5>
         <form method="POST" action="reviews.php">
            <div class="mb-3">
               <label for="reviewText" class="form-label">Review</label>
               <textarea class="form-control" id="reviewText" name="review_text" rows="3" required></textarea>
            </div>
            <div class="mb-3">
               <label for="rating" class="form-label">Rating</label>
               <select class="form-select" id="rating" name="rating" required>
                  <option value="5">5 - Excellent</option>
                  <option value="4">4 - Good</option>
                  <option value="3">3 - Average</option>
                  <option value="2">2 - Poor</option>
                  <option value="1">1 - Very Poor</option>
               </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Submit Review</button>
         </form>
      </div>
   </div>

   <!-- Display Reviews -->
   <?php while ($row = mysqli_fetch_assoc($reviewsResult)) { ?>
   <div class="card mb-3 shadow-sm">
      <div class="card-body">
         <div class="review-header"><?php echo htmlspecialchars($row['user_name']); ?></div>
         <p class="card-text"><?php echo htmlspecialchars($row['review_text']); ?></p>
         <p class="rating-text">Rating: <?php echo $row['rating']; ?> / 5</p>
         <p class="text-muted">Posted on: <?php echo $row['created_at']; ?></p>
      </div>
   </div>
   <?php } ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
