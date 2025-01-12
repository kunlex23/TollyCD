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

$sql = "SELECT SUM(profitreward) AS amountIn 
      FROM gbigbe 
      WHERE shipmentType= 'Delivery' 
      AND remitanceKind = 'WP2P' 
      AND status = 'Completed' 
      AND date > DATE_SUB(NOW(), INTERVAL 1 MONTH)";
// AND partnerPayStatus = 'rara'

if ($result = $conn->query($sql)) {
    while ($row = $result->fetch_assoc()) {
        $tClients = $row['amountIn'] !== null ? $row['amountIn'] : 0;
        $total = number_format($tClients, 0, '.', ',');
        echo '<h1>' . $total . '</h1>';
    }
    $result->free();
}
$conn->close();
?>