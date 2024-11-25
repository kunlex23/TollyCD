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

// echo '<pre>';
// print_r($_POST);
// echo '</pre>';

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
    $partner = $_POST['oluwa'];
    $selectedShipments = $_POST['selectedShipments'];
    if (!is_array($selectedShipments)) {
        echo "No shipments selected.";
        exit;
    }

    // Generate the unique payID
    $payID = generatePaymentId();

    // Calculate total amount for the selected shipments
    $totalAmount = 0;
    foreach ($selectedShipments as $shipmentId) {
        // Sanitize shipmentId to prevent SQL injection
        $shipmentId = mysqli_real_escape_string($conn, $shipmentId);

        $query = "SELECT riderReward FROM gbigbe WHERE id = '$shipmentId'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $totalAmount += intval($row['riderReward']);
        } else {
            // Handle case where the query fails or no result is returned
            echo "Failed to retrieve data for shipment ID: $shipmentId";
        }
    }

    // echo "Total: $totalAmount";


    // Insert the new record with the generated payID
    $insertQuery = "INSERT INTO agenthistory (agent, totalAmount, payID) 
                    VALUES ('$partner', '$totalAmount', '$payID')";

    if (mysqli_query($conn, $insertQuery)) {
        // Update the relevant records with the generated payID
        foreach ($selectedShipments as $shipmentId) {
            $updateQuery = "UPDATE gbigbe 
                            SET captainPayStatus = 'beni', 
                            payID6 = '$payID' 
                            WHERE id = '$shipmentId'";
            mysqli_query($conn, $updateQuery);
        }

        // echo "<script>alert('Success');</script>";

        echo '<script>window.location.href = "./iranse.php";</script>';
    } else {
        echo "Error: " . mysqli_error($conn);
    }

}
?>