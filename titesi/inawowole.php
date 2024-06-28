<?php
require '../config.php';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect data from the form
    $purposes = $_POST['purpose'];
    $units = $_POST['quantity'];
    $unitPrices = $_POST['unitPrice'];
    $amounts = $_POST['amount'];

    $sqlInsert = "INSERT INTO inawo (purpose, unit, unitPrice, amount) VALUES (?, ?, ?, ?)";
    $stmtInsert = $conn->prepare($sqlInsert);

    // Check if the statement was prepared successfully
    if ($stmtInsert) {
        for ($i = 0; $i < count($units); $i++) {
            // Bind parameters to the insert SQL query
            $stmtInsert->bind_param("siis", $purposes[$i], $units[$i], $unitPrices[$i], $amounts[$i]);

            // Execute the insert statement
            if (!$stmtInsert->execute()) {
                echo "Error: " . $stmtInsert->error;
                exit;
            }
        }

        $stmtInsert->close();

        // Redirect to a success page or show a success message
        echo "<script>alert('Record created successfully!'); window.location.href='inawo.php';</script>";
    } else {
        echo "Error: Could not prepare the statement.";
    }

    // Close the database connection
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>