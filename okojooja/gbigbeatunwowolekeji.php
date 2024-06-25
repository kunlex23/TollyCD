<?php
require '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $partner = $_POST['partner'];
    $productName = $_POST['oja'];
    $quantity = $_POST['quantity'];

    // Prepare the update query to prevent SQL injection
    $clientSql = "UPDATE products SET
                  partner = ?,
                  productName = ?,
                  quantity = quantity + ?
                  WHERE id = ?";

    // Start a database transaction
    $conn->begin_transaction();

    if ($stmt = $conn->prepare($clientSql)) {
        $stmt->bind_param('ssii', $partner, $productName, $quantity, $id);

        if ($stmt->execute()) {
            $conn->commit();
            echo '<script>alert("Record updated successfully!");</script>';
            echo '<script>window.location.href = "./wiwa.php?Name=' . urlencode($partner) . '";</script>';
        } else {
            // If the query fails, roll back the transaction and display an error message
            $conn->rollback();
            echo "Error updating client data: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error preparing the statement: " . $conn->error;
    }
} else {
    echo "Invalid request method.";
}

$conn->close();
?>