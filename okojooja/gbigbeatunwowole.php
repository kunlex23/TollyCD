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
    // Retrieve and sanitize input
    $id = $_POST['id'];
    $Name = mysqli_real_escape_string($conn, $_POST['Name']);
    $Contact = mysqli_real_escape_string($conn, $_POST['Contact']);
    $accountNumber = mysqli_real_escape_string($conn, $_POST['accountNumber']);
    $bank = mysqli_real_escape_string($conn, $_POST['bank']);
    $accountName = mysqli_real_escape_string($conn, $_POST['accountName']);
    $oldName = mysqli_real_escape_string($conn, $_POST['oldName']);

    // Prepare the update queries to prevent SQL injection
    $clientSql = "UPDATE alabasepo SET
                  Name = ?,
                  Contact = ?,
                  accountNumber = ?,
                  bank = ?,
                  accountName = ?
                  WHERE id = ?";
    $updateProductsQuery = "UPDATE products SET partner = ? WHERE partner = ?";

    // Start a database transaction
    $conn->begin_transaction();

    try {
        // Update products table
        $stmtProducts = $conn->prepare($updateProductsQuery);
        $stmtProducts->bind_param('ss', $Name, $oldName);
        if (!$stmtProducts->execute()) {
            throw new Exception("Error updating products: " . $stmtProducts->error);
        }
        $stmtProducts->close();

        // Update alabasepo table
        $stmtClient = $conn->prepare($clientSql);
        $stmtClient->bind_param('sssssi', $Name, $Contact, $accountNumber, $bank, $accountName, $id);
        if (!$stmtClient->execute()) {
            throw new Exception("Error updating client data: " . $stmtClient->error);
        }
        $stmtClient->close();

        // Commit transaction if all queries succeed
        $conn->commit();
        echo '<script>alert("Record updated successfully!");</script>';
        echo '<script>window.location.href = "./alabasepo.php";</script>';
    } catch (Exception $e) {
        // Rollback transaction on error
        $conn->rollback();
        echo "Transaction failed: " . $e->getMessage();
    }
} else {
    echo "Invalid request method.";
}

$conn->close();
?>