<?php
require '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $Name = $_POST['Name'];
    $Contact = $_POST['Contact'];
    $accountNumber = $_POST['accountNumber'];
    $bank = $_POST['bank'];
    $accountName = $_POST['accountName'];

    // Prepare the update query to prevent SQL injection
    $clientSql = "UPDATE alabasepo SET
                  Name = ?,
                  Contact = ?,
                  accountNumber = ?,
                  bank = ?,
                  accountName = ?
                  WHERE id = ?";

    // Start a database transaction
    $conn->begin_transaction();

    if ($stmt = $conn->prepare($clientSql)) {
        $stmt->bind_param('sssssi', $Name, $Contact, $accountNumber, $bank, $accountName, $id);

        if ($stmt->execute()) {
            $conn->commit();
            echo '<script>alert("Record updated successfully!");</script>';
            echo '<script>window.location.href = "./alabasepo.php";</script>';
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