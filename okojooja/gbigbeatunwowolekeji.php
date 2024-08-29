<?php
session_start();
if (!isset($_SESSION['userType'])) {
    header("location: ../index.php");
} elseif (($_SESSION['userType']) == "Inventory") {
} elseif (($_SESSION['userType']) == "Data_Entry") {
    header("Location: ../titesi");
} elseif (($_SESSION['userType']) == "Accountant") {
    header("Location: ../onisiro");
} elseif (($_SESSION['userType']) == "Admin") {
    // echo "<button>check</button>";
} else {
    header("location: ../index.php");
}

require '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $partner = $_POST['partner'];
    $productName = $_POST['oja'];
    $rQuantity = $_POST['rQuantity'];
    $bQuantity = $_POST['bQuantity'];
    $quantity = $_POST['quantity'];
    $oQuantity = $_POST['oQuantity'];

    // Prepare the update query to prevent SQL injection
    $updateSql = "UPDATE products SET
                  partner = ?,
                  productName = ?,
                  quantity = quantity + ?
                  WHERE id = ?";

    // Prepare the insert query for the afikun table
    $insertSql = "INSERT INTO afikun (partner, productName, oQuantity, rQuantity, bQuantity, quantity)
                  VALUES (?, ?, ?, ?, ?, ?)";

    // Start a database transaction
    $conn->begin_transaction();

    try {
        // Prepare and execute the update statement
        if ($updateStmt = $conn->prepare($updateSql)) {
            $updateStmt->bind_param('ssii', $partner, $productName, $quantity, $id);
            if (!$updateStmt->execute()) {
                throw new Exception("Error updating client data: " . $updateStmt->error);
            }
            $updateStmt->close();
        } else {
            throw new Exception("Error preparing the update statement: " . $conn->error);
        }

        // Prepare and execute the insert statement
        if ($insertStmt = $conn->prepare($insertSql)) {
            $insertStmt->bind_param('ssiiii', $partner, $productName, $oQuantity, $rQuantity, $bQuantity, $quantity,);
            if (!$insertStmt->execute()) {
                throw new Exception("Error inserting into afikun: " . $insertStmt->error);
            }
            $insertStmt->close();
        } else {
            throw new Exception("Error preparing the insert statement: " . $conn->error);
        }

        // Commit the transaction
        $conn->commit();
        echo '<script>alert("Record updated and inserted successfully!");</script>';
        echo '<script>window.location.href = "./wiwa.php?Name=' . urlencode($partner) . '";</script>';
    } catch (Exception $e) {
        // Rollback the transaction and display an error message if something goes wrong
        $conn->rollback();
        echo "Transaction failed: " . $e->getMessage();
    }
} else {
    echo "Invalid request method.";
}

$conn->close();
?>