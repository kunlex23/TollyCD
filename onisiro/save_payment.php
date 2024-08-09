<?php
require '../config.php';

// Function to generate a unique payID
function generatePaymentId()
{
    $timestamp = microtime(true); // Current timestamp with microseconds
    $randomNumber = mt_rand(100000, 999999); // Random number within a specified range

    // Concatenate timestamp and random number
    $paymentId = $timestamp . $randomNumber;

    // Remove any decimal point from the timestamp
    $paymentId = str_replace('.', '', $paymentId);

    return $paymentId;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $partner = $_GET['partner'];
    $totalAmount = $_GET['totalAmount'];
    $accountNumber = $_GET['accountNumber'];
    $bank = $_GET['bank'];
    $accountName = $_GET['accountName'];

    // Generate the unique payID
    $payID = generatePaymentId();

    // Insert the new record with the generated payID
    $insertQuery = "INSERT INTO owoAlabasepoHistory (partner, totalAmount, accountNumber, bank, accountName, payID) 
                    VALUES ('$partner', '$totalAmount', '$accountNumber', '$bank', '$accountName', '$payID')";

    if (mysqli_query($conn, $insertQuery)) {
        // echo '<script>alert("Payment made successfully!");</script>';
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Update the relevant records with the generated payID
    $query = "UPDATE gbigbe SET partnerPayStatus = 'beni', payID = '$payID' 
              WHERE partner = '$partner' 
              AND status = 'completed' 
              AND remitanceKind = 'NORMs'
              AND partnerPayStatus = 'rara'";

    if (mysqli_query($conn, $query)) {
        echo "Payment made successfully.";
        echo '<script>window.location.href = "./records.php";</script>';
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request method.";
}
?>