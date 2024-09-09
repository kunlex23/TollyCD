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

if (isset($_POST['sod'])) {
$sod = $_POST['sod'];

$sql = "SELECT location FROM ninawo WHERE sod = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $sod);
$stmt->execute();
$result = $stmt->get_result();

$locations = [];
if ($result->num_rows > 0) {
while ($row = $result->fetch_assoc()) {
$locations[] = $row['location']; // Fetch the 'location'
}
}
echo json_encode($locations); // Return the array of locations
}
?>