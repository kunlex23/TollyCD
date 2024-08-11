<?php

require '../config.php';

$sql = "SELECT SUM(amount) AS amountIn 
FROM others_gifts
WHERE date > DATE_SUB(NOW(), INTERVAL 7 DAY)";
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