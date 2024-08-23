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

if (isset($_POST['product'])) {
    $product = $_POST['product'];

    // Prepared statement to prevent SQL injection
    $sql = "SELECT quantity FROM products WHERE productName = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        echo json_encode(['error' => 'Failed to prepare statement']);
        exit();
    }

    $stmt->bind_param("s", $product);
    $stmt->execute();
    $result = $stmt->get_result();

    $quantity = 0;
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $quantity = $row['quantity'];
    }

    echo json_encode(['quantity' => $quantity]);
} else {
    echo json_encode(['error' => 'Product not set']);
}
?>