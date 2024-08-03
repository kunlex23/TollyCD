<?php

require '../config.php';

$sql = "SELECT SUM(partnerReward) AS amountIn 
      FROM gbigbe 
      WHERE shipmentType= 'Delivery' 
      AND status = 'Completed' 
      AND partnerPayStatus = 'rara'
      AND date > DATE_SUB(NOW(), INTERVAL 7 DAY)";

if ($result = $conn->query($sql)) {
  while ($row = $result->fetch_assoc()) {
    $tClients = $row['amountIn'] !== null ? $row['amountIn'] : 0;

    echo '<h1>' . $tClients . '</h1>';
  }
  $result->free();
}
$conn->close();
?>