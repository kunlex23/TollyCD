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
    $partner = $_POST['tani'];
    $selectedShipments = $_POST['selectedShipments'];
    // Generate the unique payID
    $payID = generatePaymentId();
    
    // Calculate total amount for the selected shipments
    $totalAmount = 0;
    foreach ($selectedShipments as $shipmentId) {
        $query = "SELECT deliveryFee FROM gbigbe WHERE id = '$shipmentId'";
        $result = mysqli_query($conn, $query);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $totalAmount += $row['deliveryFee'];
        }
    }
    echo $totalAmount;

    // Insert the new record with the generated payID
    $insertQuery = "INSERT INTO owoalabasepowahistory (partner, totalAmount, payID) 
                    VALUES ('$partner', '$totalAmount', '$payID')";

    if (mysqli_query($conn, $insertQuery)) {
        // Update the relevant records with the generated payID
        foreach ($selectedShipments as $shipmentId) {
            $updateQuery = "UPDATE gbigbe 
                            SET partnerPayStatus = 'beni', 
                            payID1 = '$payID' 
                            WHERE id = '$shipmentId'";
            mysqli_query($conn, $updateQuery);
        }
        echo "Payment made successfully.";
        echo '<script>window.location.href = "./records.php";</script>';
    } else {
        echo "Error: " . mysqli_error($conn);
    }

}
?>