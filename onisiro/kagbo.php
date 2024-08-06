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
    $partner = $_GET['tani'];
    $totalAmount = $_GET['elo'];

    // Generate the unique payID
    $payID = generatePaymentId();

    // Insert the new record with the generated payID
    $insertQuery = "INSERT INTO owoAlabasepoWaHistory (partner, totalAmount, payID) 
                    VALUES ('$partner', '$totalAmount', '$payID')";

    if (mysqli_query($conn, $insertQuery)) {
        // echo '<script>alert("Payment made successfully!");</script>';
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Update the relevant records with the generated payID
    $query = "UPDATE gbigbe SET 
                        partnerPayStatus = 'beni', 
                        partnerRemitance = 'beni',
                        payID2 = '$payID' 
              WHERE partner = '$partner' 
              AND status = 'completed' 
              AND partnerRemitance = 'rara'
              AND remitanceKind = 'M2TCD'
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