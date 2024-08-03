<?php

require '../config.php';

// Modify the query to sum the records from the last 30 days
$sql = "SELECT SUM(amount) AS amount 
        FROM gbigbe 
        WHERE shipmentType= 'Delivery' 
        AND status = 'Completed' 
        AND partnerPayStatus = 'rara'
        AND date > DATE_SUB(NOW(), INTERVAL 7 DAY)";

if ($result = $conn->query($sql)) {
  while ($row = $result->fetch_assoc()) {
    $tClients = $row['amount'] !== null ? $row['amount'] : 0;  // Handle null case

    echo '<h1>' . $tClients . '</h1>';
  }
  $result->free();
}
$conn->close();

?>