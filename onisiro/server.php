<?php

require '../config.php';

// Query to sum the records from the last 7 days for Delivery shipments
$sql = "SELECT SUM(amount) AS amount 
        FROM gbigbe 
        WHERE shipmentType= 'Delivery' 
        AND status = 'Completed' 
        AND (remitanceKind = 'NORMs' OR remitanceKind = 'WP2P')
        AND date > DATE_SUB(NOW(), INTERVAL 7 DAY)";

if ($result = $conn->query($sql)) {
  while ($row = $result->fetch_assoc()) {
    $tClients = $row['amount'] ?? 0;  // Handle null case
  }
  $result->free();
}

// Query to sum the records from the last 7 days for others_gifts
$sql1 = "SELECT SUM(amount) AS amount 
        FROM others_gifts  
        WHERE date > DATE_SUB(NOW(), INTERVAL 7 DAY)";

if ($result1 = $conn->query($sql1)) {
  while ($row1 = $result1->fetch_assoc()) {
    $gifts = $row1['amount'] ?? 0;  // Handle null case
  }
  $result1->free();
}

// Query to sum the records from the last 7 days for Waybill shipments
$sql2 = "SELECT SUM(deliveryFee) AS amount 
        FROM gbigbe 
        WHERE shipmentType= 'Waybill' 
        AND status = 'Completed' 
        AND remitanceKind = 'NORMs' 
        AND date > DATE_SUB(NOW(), INTERVAL 7 DAY)";

if ($result2 = $conn->query($sql2)) {
  while ($row2 = $result2->fetch_assoc()) {
    $waybill = $row2['amount'] ?? 0;  // Handle null case
  }
  $result2->free();
}

// Displaying the results
// echo '<h1>D: ' . number_format($tClients, 0, '.', ',') . '</h1>';
// echo '<h1>W: ' . number_format($waybill, 0, '.', ',') . '</h1>';
// echo '<h1>O: ' . number_format($gifts, 0, '.', ',') . '</h1>';

$totalAmount = $tClients + $gifts + $waybill;
$totalFormatted = number_format($totalAmount, 0, '.', ',');
echo '<h1>' . $totalFormatted . '</h1>';

$conn->close();

?>