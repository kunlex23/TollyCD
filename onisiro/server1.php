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

// Query to sum the records for 'NORMs' shipments in the last month
$sql = "SELECT SUM(partnerReward) AS amountIn 
        FROM gbigbe 
        WHERE shipmentType = 'Delivery' 
        AND remitanceKind = 'NORMs' 
        AND status = 'Completed' 
        AND date > DATE_SUB(NOW(), INTERVAL 1 MONTH)";

$tClients = 0;
if ($result = $conn->query($sql)) {
  $row = $result->fetch_assoc();
  $tClients = $row['amountIn'] ?? 0;  // Correct alias 'amountIn'
  $result->free();
}

// Query to sum the records for 'WP2P' shipments in the last month
$sql1 = "SELECT SUM(amount) AS amount 
         FROM gbigbe  
         WHERE shipmentType = 'Delivery' 
         AND remitanceKind = 'WP2P' 
         AND status = 'Completed' 
         AND date > DATE_SUB(NOW(), INTERVAL 1 MONTH)";

$w2p2 = 0;
if ($result1 = $conn->query($sql1)) {
  $row1 = $result1->fetch_assoc();
  $w2p2 = $row1['amount'] ?? 0;  // Correct alias 'amount'
  $result1->free();
}

// Calculate and display the total amount
$totalAmount = $tClients + $w2p2;
// echo $tClients;
// echo $w2p2;
$totalFormatted = number_format($totalAmount, 0, '.', ',');
echo '<h1>' . $totalFormatted . '</h1>';

$conn->close();
?>