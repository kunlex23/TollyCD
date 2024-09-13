<?php
session_start();
if (!isset($_SESSION['userType'])) {
  header("location: ../index.php");
} elseif (($_SESSION['userType']) == "Inventory") {
  header("Location: ../okojooja");
} elseif (($_SESSION['userType']) == "Data_Entry") {
} elseif (($_SESSION['userType']) == "Accountant") {
  header("Location: ../onisiro");
} elseif (($_SESSION['userType']) == "Admin") {
} else {
  header("location: ../index.php");
}

require '../config.php';

// SQL query to count the number of rows with quantity less than 5
$sql = "SELECT COUNT(*) AS totalLowQuantity FROM gbigbe WHERE status ='completed'";

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