<<<<<<< HEAD
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

$sql = "SELECT SUM(amount) AS amountIn
FROM others_gifts
WHERE date > DATE_SUB(NOW(), INTERVAL 1 MONTH)";
if ($result = $conn->query($sql)) {
    while ($row = $result->fetch_assoc()) {
        $tClients = $row['amountIn'] !== null ? $row['amountIn'] : 0;

        $total = number_format($tClients, 0, '.', ',');
        echo '<h1>' . $total . '</h1>';
    }
    $result->free();
}
$conn->close();
=======
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

$sql = "SELECT SUM(amount) AS amountIn
FROM others_gifts
WHERE date > DATE_SUB(NOW(), INTERVAL 1 MONTH)";
if ($result = $conn->query($sql)) {
    while ($row = $result->fetch_assoc()) {
        $tClients = $row['amountIn'] !== null ? $row['amountIn'] : 0;

        $total = number_format($tClients, 0, '.', ',');
        echo '<h1>' . $total . '</h1>';
    }
    $result->free();
}
$conn->close();
>>>>>>> 438e7786b64c654f6174992bd89b7813079ba0e1
?>