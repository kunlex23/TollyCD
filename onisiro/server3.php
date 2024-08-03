<?php

require '../config.php';

$sql = "SELECT SUM(amount) AS amountIn 
FROM inawo
WHERE date > DATE_SUB(NOW(), INTERVAL 7 DAY)";
if ($result = $conn->query($sql)) {
  while ($row = $result->fetch_assoc()) {
    $tClients = $row['amountIn'] !== null ? $row['amountIn'] : 0;

    echo '<h1>' . $tClients . '</h1>';
  }
  $result->free();
}
$conn->close();
?>