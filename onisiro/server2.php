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
        WHERE shipmentType = 'Delivery' 
        AND status = 'Completed' 
        AND date > DATE_SUB(NOW(), INTERVAL 1 MONTH)";

if ($result = $conn->query($sql)) {
    if ($row = $result->fetch_assoc()) {
        $riderRewardTotal = $row['amountIn'] !== null ? $row['amountIn'] : 0;
        $formattedTotal = number_format($riderRewardTotal, 0, '.', ',');
        echo '<h1>' . $formattedTotal . '</h1>';
    }
    $result->free();
} else {
    echo "Error: " . $conn->error;
}

$conn->close();

?>