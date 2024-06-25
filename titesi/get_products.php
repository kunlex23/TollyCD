<?php
require '../config.php';

if (isset($_POST['partner'])) {
$partner = $_POST['partner'];
$sql = "SELECT productName FROM products WHERE partner = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $partner);
$stmt->execute();
$result = $stmt->get_result();

$products = [];
if ($result->num_rows > 0) {
while ($row = $result->fetch_assoc()) {
$products[] = $row['productName'];
}
}
echo json_encode($products);
}
?>