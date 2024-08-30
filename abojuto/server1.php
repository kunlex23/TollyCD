<?php
session_start();
if (!isset($_SESSION['userType'])) {
  header("location: ../index.php");
} elseif (($_SESSION['userType']) == "Inventory") {
  header("Location: ../okojooja");
} elseif (($_SESSION['userType']) == "Data_Entry") {
  header("Location: ../titesi");
} elseif (($_SESSION['userType']) == "Accountant") {
  header("Location: ../onisiro");
} elseif (($_SESSION['userType']) == "Admin") {
} else {
  header("location: ../index.php");
}

require '../config.php';

$sql = "SELECT SUM(partnerReward) AS amountIn FROM gbigbe WHERE status = 'Completed' AND partnerPayStatus = 'rara'";
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