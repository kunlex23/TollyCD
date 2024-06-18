<?php

require '../config.php';

// SQL query to sum the total quantity
$sql = "SELECT SUM(productName) AS totalQuantity FROM products";

if ($result = $conn->query($sql)) {
  while ($row = $result->fetch_assoc()) {
    $totalQuantity = $row['totalQuantity'];

    echo '
            <h1>' . $totalQuantity . '</h1>
        ';
  }
  $result->free();
}

$conn->close();

?>