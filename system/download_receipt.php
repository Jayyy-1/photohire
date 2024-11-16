<?php
@include 'config.php';
session_start();

if (!isset($_SESSION['user_name'])) {
    header('location:login_form.php');
}

if (isset($_GET['transaction_id'])) {
    $transactionId = $_GET['transaction_id'];
    // Fetch receipt file path from the database
    $query = "SELECT receipt_path FROM payments WHERE transaction_id = '$transactionId'";
    $result = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        $filePath = $row['receipt_path'];
        if (file_exists($filePath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/pdf'); // Adjust based on your file type
            header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filePath));
            readfile($filePath);
            exit;
        } else {
            echo "File not found.";
        }
    } else {
        echo "Transaction not found.";
    }
} else {
    echo "No transaction ID provided.";
}
