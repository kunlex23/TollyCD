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

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect data from the form
    $names = $_POST['name'];
    $purposes = $_POST['purpose'];
    $amounts = $_POST['amount'];
    $approvedBys = $_POST['approvedBy'];

    $sqlInsert = "INSERT INTO inawo (name, purpose, amount, approvedBy) VALUES (?, ?, ?, ?)";
    $stmtInsert = $conn->prepare($sqlInsert);

    // Check if the statement was prepared successfully
    if ($stmtInsert) {
        for ($i = 0; $i < count($names); $i++) {
            // Bind parameters to the insert SQL query
            $stmtInsert->bind_param("ssss", $names[$i], $purposes[$i], $amounts[$i], $approvedBys[$i]);

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