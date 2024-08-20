<?php
require '../config.php';

echo '<pre>';
print_r($_POST);
echo '</pre>';

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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $partner = $_POST['partner'];
    $selectedShipments = $_POST['selectedShipments'];
    $accountNumber = $_POST['accountNumber'];
    $bank = $_POST['bank'];
    $accountName = $_POST['accountName'];

    // Generate the unique payID
    $payID = generatePaymentId();

    // Calculate total amount for the selected shipments
    $totalAmount = 0;
    foreach ($selectedShipments as $shipmentId) {
        $query = "SELECT amount FROM gbigbe WHERE id = '$shipmentId'";
        $result = mysqli_query($conn, $query);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $totalAmount += $row['amount'];
        }
    }
    echo $totalAmount;
    // Insert the new record with the generated payID
    $insertQuery = "INSERT INTO owoalabasepohistory2 (partner, totalAmount, accountNumber, bank, accountName, payID) 
                    VALUES ('$partner', '$totalAmount', '$accountNumber', '$bank', '$accountName', '$payID')";

    if (mysqli_query($conn, $insertQuery)) {
        // echo '<script>alert("Payment made successfully!");</script>';
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Update the relevant records with the generated payID
    $query = "UPDATE gbigbe SET captainPayStatus = 'beni', payID1 = '$payID' 
             WHERE shipmentType='Delivery' 
             AND partner = '$partner' 
             AND status = 'completed' 
             AND accCaptain = 'beni' 
             AND remitanceKind = 'WP2P'
             AND captainPayStatus = 'rara'";

    if (mysqli_query($conn, $query)) {
        echo '<script>alert("Payment made successfully!");</script>';
        echo '<script>window.location.href = "./records.php";</script>';
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request method.";
}
?>