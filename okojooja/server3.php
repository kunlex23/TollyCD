<?php

require '../config.php';

// SQL query to count the number of rows with quantity less than 5
$sql = "SELECT COUNT(*) AS totalLowQuantity FROM products WHERE quantity = 0";

if ($result = $conn->query($sql)) {
  while ($row = $result->fetch_assoc()) {
    $totalLowQuantity = $row['totalLowQuantity'];

    echo '
            <h1>' . $totalLowQuantity . '</h1>
        ';
  }
  $result->free();
}

$conn->close();

?>