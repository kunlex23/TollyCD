<?php
session_start();

require '../config.php';


//------------expenses----------------/
$sql3 = "SELECT SUM(amount) AS expenses 
FROM inawo 
WHERE date > DATE_SUB(NOW(), INTERVAL 1 MONTH)";
if ($result3 = $conn->query($sql3)) {
    while ($row = $result3->fetch_assoc()) {
        $tClientsss = $row['expenses'] !== null ? $row['expenses'] : 0;
        $exp = number_format($tClientsss, 0, '.', ',');

    }
    $result3->free();
}
// echo '<h1>' . $totalFormatted . '</h1>';
// echo '<h1>E: ' . $exp . '</h1>';
$expF = number_format($tClientsss, 0, '.', ',');
echo '<h1>' . $expF . '</h1>';
$conn->close();
?>