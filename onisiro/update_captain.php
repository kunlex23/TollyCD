<?php
require 'config.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Debugging: Log the received ID
    error_log("Received ID: " . $id);

    // Prepare the update query
    $query = "UPDATE gbigbe SET accCaptain = 'beni' WHERE id = $id";

    // Debugging: Log the query
    error_log("Executing query: " . $query);

    // Execute the query and check for errors
    if (mysqli_query($conn, $query)) {
        echo "Shipment confirmed successfully.";
    } else {
        // Debugging: Log the MySQL error
        error_log("MySQL error: " . mysqli_error($conn));
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "ID not set.";
}
?>