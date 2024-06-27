<?php

require '../config.php';

$sql = "SELECT COUNT(*) AS totalClients FROM gbigbe WHERE status ='Pending'";
// where order_date > now() - interval 1 day;
if ($result = $conn->query($sql)) {
  while ($row = $result->fetch_assoc()) {
    $tClients = $row['totalClients'];

    echo '
                                     <h1>' . $tClients . '</h1>
                                 ';
  }
  $result->free();
}
$conn->close();
?>