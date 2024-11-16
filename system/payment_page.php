        <?php
        session_start();
        @include 'config.php';

        if (!isset($_SESSION['user_name'])) {
            header('location:login_form.php');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user_id = $_SESSION['user_id'];
            $amount = $_POST['amount'];
            $payment_method = $_POST['payment_method'];
            $user_email = $_POST['email'];

            // Insert payment record
            $paymentQuery = "INSERT INTO payments (user_id, amount, payment_status, payment_method) VALUES ('$user_id', '$amount', 'pending', '$payment_method')";
            mysqli_query($conn, $paymentQuery);

            // Notify user about pending payment
            $userNotif = "INSERT INTO notifications (user_id, message, notification_type) VALUES ('$user_id', 'Your payment of $amount via $payment_method is pending.', 'user')";
            mysqli_query($conn, $userNotif);

            // Notify admin about pending payment with amount and email
            $adminNotif = "INSERT INTO notifications (user_id, message, notification_type) VALUES ('$user_id', 'A new payment of $amount via $payment_method is pending approval from user $user_email.', 'admin')";
            mysqli_query($conn, $adminNotif);

            echo "<p class='alert alert-info mt-3'>Payment has been recorded and is awaiting confirmation.</p>";
        }
        ?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Payment Page</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
            <style>
                        body {
                            background-color: #f0f0f5;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            height: 100vh;
                            margin: 0;
                        }
                        .payment-container {
                            background-color: whitesmoke;
                            color: black;
                            padding: 2rem;
                            border-radius: 8px;
                            max-width: 500px;
                            width: 100%;
                        }
                        .form-label {
                            color: black;
                        }
                        .btn-primary {
                            background-color: black;
                            border: none;
                        }
                        .btn-primary:hover {
                            background-color: grey;
                        }
                        .btn-secondary {
                            color: black;
                        }
                        .small-logo {
         display: block; /* Center the logo */
         margin: 0 auto 20px; /* Margin below the logo */
         width: 150px; /* Adjust this size as needed */
         height: auto; /* Maintain aspect ratio */
      }
            </style>
        </head>
        <body>

        <div class="payment-container">
        <img src="https://scontent.fmnl33-2.fna.fbcdn.net/v/t1.15752-9/449475073_913484477203476_804443557467684110_n.png?stp=dst-png_s2048x2048&_nc_cat=104&ccb=1-7&_nc_sid=9f807c&_nc_eui2=AeFN_22NXVg_h7uzQu8RSAjVMDb4Cz3Z6fgwNvgLPdnp-FUUpMe1m_n87hp3Vke1LkMA7GoMa4dy3LmeB1IyzZ9F&_nc_ohc=8Vtv_5ah8XQQ7kNvgGnnUT7&_nc_zt=23&_nc_ht=scontent.fmnl33-2.fna&_nc_gid=A2IQZV-6uXjCsZzvCPudRB1&oh=03_Q7cD1QHrqehRAH1DdmlBDZCAvsnryptO8av2Or0sxxF4UOfoRg&oe=674D051C" alt="Logo" class="small-logo"> <!-- Replace with your logo path -->  
            <h2 class="text-center mb-4">Make a Payment</h2>
            <form method="post" action="payment_page.php">
                <div class="mb-3">
                    <label for="amount" class="form-label">Amount:</label>
                    <input type="number" name="amount" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
        <div>
        <div class="mb-3">
            <label for="payment_method" class="form-label">Payment Method:</label>
            <div class="btn-group w-100" role="group" aria-label="Payment methods">
                <input type="radio" class="btn-check" name="payment_method" id="gcash" value="gcash" required>
                <label class="btn btn-outline-primary d-flex align-items-center justify-content-center" for="gcash">
                    <img src="data:image/jpeg;base64,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" alt="GCash Logo" width="24" height="24" class="me-2">
                    GCash
                </label>

                <input type="radio" class="btn-check" name="payment_method" id="paymaya" value="paymaya" required>
                <label class="btn btn-outline-primary d-flex align-items-center justify-content-center" for="paymaya">
                    <img src="data:image/jpeg;base64,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" alt="PayMaya Logo" width="24" height="24" class="me-2">
                    PayMaya
                </label>
            </div>
        </div>

        </div>
            
                
                <button type="submit" class="btn btn-primary w-100 mb-2">Submit Payment</button>
            </form>
            <a href="user_page.php" class="btn btn-secondary w-100">Back</a>
        </div>

        </body>
        </html>
