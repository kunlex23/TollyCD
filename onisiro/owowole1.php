<?php
session_start();
if (!isset($_SESSION['userType'])) {
    header("location: ../index.php");
} elseif (($_SESSION['userType']) == "Inventory") {
    header("Location: ../okojooja");
} elseif (($_SESSION['userType']) == "Data_Entry") {
    header("Location: ../titesi");
} elseif (($_SESSION['userType']) == "Accountant") {
} elseif (($_SESSION['userType']) == "Admin") {
} else {
    header("location: ../index.php");
}

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
    $partner = $_GET['olubasepo'];
    $totalAmount = $_GET['owo'];
    $accountNumber = $_GET['eni'];

    // Generate the unique payID
    $payID = generatePaymentId();


    // Update the relevant records with the generated payID
    $query = "UPDATE gbigbe SET captainPayStatus = 'beni', payID = '$payID' 
              WHERE partner = '$partner' AND status = 'completed' AND id = '$accountNumber' AND profitReward='$totalAmount'";
    if (mysqli_query($conn, $query)) {
        echo "Payment confirmed!.";
        // echo '<script>window.location.href = "./iranse.php";</script>';
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request method.";
}
?>