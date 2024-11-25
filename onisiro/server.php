<?php
session_start();

require '../config.php';

// Query to sum the records from the last month for Delivery shipments
$sql = "SELECT SUM(profitReward) AS amount 
        FROM gbigbe 
        WHERE status = 'Completed'
        AND shipmentType = 'delivery'
        AND date > DATE_SUB(NOW(), INTERVAL 1 MONTH)";

$tClients = 0; // Initialize default value
if ($result = $conn->query($sql)) {
    $row = $result->fetch_assoc();
    $tClients = $row['amount'] ?? 0;  // Handle null case
    $result->free();
} else {
    echo "Error: " . $conn->error;
}


// Query to sum the records from the last month for others_gifts
$sql1 = "SELECT SUM(amount) AS amount 
        FROM others_gifts  
        WHERE date > DATE_SUB(NOW(), INTERVAL 1 MONTH)";

$gifts = 0; // Initialize default value
if ($result1 = $conn->query($sql1)) {
    $row1 = $result1->fetch_assoc();
    $gifts = $row1['amount'] ?? 0;  // Handle null case
    $result1->free();
} else {
    echo "Error: " . $conn->error;
}

// Query to sum the records from the last 7 days for Waybill shipments
$sql2 = "SELECT SUM(profitReward) AS amount 
        FROM gbigbe 
        WHERE shipmentType= 'Waybill' 
        AND date > DATE_SUB(NOW(), INTERVAL 1 MONTH)";

$waybill = 0; // Initialize default value
if ($result2 = $conn->query($sql2)) {
    $row2 = $result2->fetch_assoc();
    $waybill = $row2['amount'] ?? 0;  // Handle null case
    $result2->free();
} else {
    echo "Error: " . $conn->error;
}

// Displaying the results
// echo '<h1>D: ' . number_format($tClients, 0, '.', ',') . '</h1>';
// echo '<h1>W: ' . number_format($waybill, 0, '.', ',') . '</h1>';
// echo '<h1>O: ' . number_format($gifts, 0, '.', ',') . '</h1>';

// Calculating total amount (including Waybill)
$totalAmount = $tClients + $gifts + $waybill;
$totalFormatted = number_format($totalAmount, 0, '.', ',');
echo '<h1>' . $totalFormatted . '</h1>';

$conn->close();

?>
