<?php
session_start();
if (!isset($_SESSION['userType'])) {
    header("location: ../index.php");
} elseif (($_SESSION['userType']) == "Inventory") {
    header("Location: ../okojooja");
} elseif (($_SESSION['userType']) == "Data_Entry") {
    header("Location: ../titesi");
} elseif (($_SESSION['userType']) == "Accountant") {
    header("Location: ../onisiro");
} elseif (($_SESSION['userType']) == "Admin") {
} else {
    header("location: ../index.php");
}

require '../config.php';

// Check if 'location' is passed in the URL
if (isset($_GET['location'])) {
    // Sanitize the input
    $location = urldecode($_GET['location']);

    // Prepare the delete statement
    $deleteStmt = $conn->prepare("DELETE FROM ninawo WHERE id = ?");
    if ($deleteStmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    // Bind the location parameter
    $deleteStmt->bind_param("s", $location);

    // Execute the statement
    if ($deleteStmt->execute()) {
        // Check if a row was affected (i.e., deleted)
        if ($deleteStmt->affected_rows > 0) {
            echo '<script>alert("Record deleted successfully.");</script>';
        } else {
            echo '<script>alert("No matching record found.");</script>';
        }
    } else {
        echo "Error executing statement: " . $deleteStmt->error;
    }

    // Close the statement and connection
    $deleteStmt->close();
    $conn->close();

    // Redirect after deletion
    echo '<script>window.location.href = "./ninan.php";</script>';
} else {
    echo '<script>alert("Invalid request.");</script>';
    echo '<script>window.location.href = "./ninan.php";</script>';
    exit();
}
?>