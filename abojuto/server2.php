<?php

require '../config.php';

$sql = "SELECT SUM(riderReward) AS amountIn FROM gbigbe WHERE status = 'Completed' AND captainPayStatus = 'rara'";
// where order_date > now() - interval 1 day;
if ($result = $conn->query($sql)) {
  while ($row = $result->fetch_assoc()) {
    $tClients = $row['amountIn'];

    echo '<h1>' . $tClients . '</h1>';
  }
  $result->free();
}
$conn->close();
?>