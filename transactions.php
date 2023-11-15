<?php
// Include Paystack PHP library
require 'paystack-php/Paystack.php';

// Replace with your test secret key
$paystackSecretKey = 'your_test_secret_key';

// Initialize Paystack with your test secret key
// $paystack = new Paystack($paystackSecretKey);

// Get the reference from the callback or wherever you're storing it
$reference = $_GET['reference']; // Change this to your method of retrieving the reference

try {
    // Verify the transaction using Paystack's API
    $paymentDetails = $paystack->transaction->verify([
        'reference' => $reference,
    ]);

    // Check if the transaction was successful
    if ($paymentDetails['data']['status'] === 'success') {
        // Payment was successful
        // Perform further actions here, e.g., update your database, fulfill the order, etc.
        // Access other details using $paymentDetails array

        // Example: Update order status in your database
        $orderId = $paymentDetails['data']['metadata']['order_id']; // Assuming you saved order ID in metadata
        // Perform your database update or order fulfillment logic here

        // Output success message or perform any additional tasks
        echo "Payment was successful. Order ID: " . $orderId;
    } else {
        // Payment failed or pending
        // Output failure message or perform necessary actions
        echo "Payment was not successful. Status: " . $paymentDetails['data']['status'];
    }
} catch (Exception $e) {
    // An error occurred
    echo "Error: " . $e->getMessage();
}
?>
