<<<<<<< HEAD
<?php



require '../config.php';

$sql = "SELECT SUM(profitReward) AS amountIn
FROM gbigbe
WHERE shipmentType = 'Delivery'
AND date > DATE_SUB(NOW(), INTERVAL 1 MONTH)";
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

=======
<?php



require '../config.php';

$sql = "SELECT SUM(profitReward) AS amountIn
FROM gbigbe
WHERE shipmentType = 'Delivery'
AND status = 'completed'
AND date > DATE_SUB(NOW(), INTERVAL 1 MONTH)";
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

>>>>>>> 438e7786b64c654f6174992bd89b7813079ba0e1
