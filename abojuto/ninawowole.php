<?php

require '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $locations = $_POST['location'];
    $partnerPrices = $_POST['partnerPrice'];
    $dispatcherPrices = $_POST['dispatcherPrice'];
    $profits = $_POST['profit'];

    // Prepare the SQL statements
    $checkStmt = $conn->prepare("SELECT 1 FROM ninawo WHERE location = ?");
    $insertStmt = $conn->prepare("INSERT INTO ninawo (location, partnerPrice, dispatcherPrice, profit) VALUES (?, ?, ?, ?)");

    if ($checkStmt === false || $insertStmt === false) {
        die("Error preparing statements: " . $conn->error);
    }

    // Bind parameters for insert statement
    $insertStmt->bind_param("ssss", $location, $partnerPrice, $dispatcherPrice, $profit);

    // Insert each set of form data
    for ($i = 0; $i < count($locations); $i++) {
        $location = $locations[$i];
        $partnerPrice = $partnerPrices[$i];
        $dispatcherPrice = $dispatcherPrices[$i];
        $profit = $profits[$i];

        // Input validation (example: check if prices and profit are numeric)
        if (!is_numeric($partnerPrice) || !is_numeric($dispatcherPrice) || !is_numeric($profit)) {
            echo '<script>alert("Invalid data format for prices or profit.");</script>';
            continue;  // Skip this entry and continue with the next one
        }

        // Check if the location already exists
        $checkStmt->bind_param("s", $location);
        $checkStmt->execute();
        $checkStmt->store_result();

        if ($checkStmt->num_rows > 0) {
            echo '<script>alert("Location ' . htmlspecialchars($location) . ' already exists.");</script>';
            continue;  // Skip this entry and continue with the next one
        }

        // Insert the new location
        $insertStmt->execute();

        if ($insertStmt->error) {
            echo "Error executing statement: " . $insertStmt->error;
        }
    }

    $checkStmt->close();
    $insertStmt->close();
    $conn->close();

    echo '<script>alert("New location(s) added successfully!");</script>';
    echo '<script>window.location.href = "./ninan.php";</script>';

    exit();
} else {
    echo "Invalid request method.";
}
?>