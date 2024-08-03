<?php

require '../config.php';

$sql = "SELECT SUM(profitReward) AS amountIn FROM gbigbe WHERE shipmentType= 'Delivery' AND status = 'Completed'";
// where order_date > now() - interval 1 day;
if ($result = $conn->query($sql)) {
  while ($row = $result->fetch_assoc()) {
    $tClients = $row['amountIn'] !== null ? $row['amountIn'] : 0;

    echo '<h1>' . $tClients . '</h1>';
  }
  $result->free();
}
$conn->close();
?>