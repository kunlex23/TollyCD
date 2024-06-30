<?php

require '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $locations = $_POST['location'];
    $partnerPrices = $_POST['partnerPrice'];
    $dispatcherPrices = $_POST['dispatcherPrice'];
    $profits = $_POST['profit'];

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO ninawo (location, partnerPrice, dispatcherPrice, profit) VALUES (?, ?, ?, ?)");

    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("ssss", $location, $partnerPrice, $dispatcherPrice, $profit);

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

        $stmt->execute();

        if ($stmt->error) {
            echo "Error executing statement: " . $stmt->error;
        }
    }

    $stmt->close();
    $conn->close();

    echo '<script>alert("New location(s) added successfully!");</script>';
    echo '<script>window.location.href = "./ninan.php";</script>';

    exit();
} else {
    echo "Invalid request method.";
}
?>
