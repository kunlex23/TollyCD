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

$sql = "SELECT SUM(riderReward) AS amountIn 
FROM gbigbe 
WHERE shipmentType= 'Delivery' 
AND status = 'Completed' 
AND date > DATE_SUB(NOW(), INTERVAL 7 DAY)";

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