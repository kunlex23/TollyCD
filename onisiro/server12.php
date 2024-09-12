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
// Query to sum the records from the last 7 days for Delivery shipments
$sql = "SELECT SUM(profitReward) AS amount 
        FROM gbigbe 
        WHERE status = 'Completed' 
        AND date > DATE_SUB(NOW(), INTERVAL 7 DAY)";

if ($result = $conn->query($sql)) {
    while ($row = $result->fetch_assoc()) {
        $tClients = $row['amount'] ?? 0;  // Handle null case
    }
    $result->free();
}

// Query to sum the records from the last 7 days for others_gifts
$sql1 = "SELECT SUM(amount) AS amount 
        FROM others_gifts  
        WHERE date > DATE_SUB(NOW(), INTERVAL 7 DAY)";

if ($result1 = $conn->query($sql1)) {
    while ($row1 = $result1->fetch_assoc()) {
        $gifts = $row1['amount'] ?? 0;  // Handle null case
    }
    $result1->free();
}


// Displaying the results
// echo '<h1>D: ' . number_format($tClients, 0, '.', ',') . '</h1>';
// echo '<h1>O: ' . number_format($gifts, 0, '.', ',') . '</h1>';

$totalAmount = $tClients + $gifts;
$totalFormatted = number_format($totalAmount, 0, '.', ',');



//------------Profit----------------/
$sql3 = "SELECT SUM(amount) AS expenses 
FROM inawo 
WHERE date > DATE_SUB(NOW(), INTERVAL 7 DAY)";
if ($result3 = $conn->query($sql3)) {
    while ($row = $result3->fetch_assoc()) {
        $tClientsss = $row['expenses'] !== null ? $row['expenses'] : 0;
        $exp = number_format($tClientsss, 0, '.', ',');

    }
    $result3->free();
}
// echo '<h1>' . $totalFormatted . '</h1>';
// echo '<h1>E: ' . $exp . '</h1>';
$netprofit = ($totalAmount - $tClientsss);
$expF = number_format($netprofit, 0, '.', ',');
echo '<h1>' . $expF . '</h1>';
$conn->close();
?>