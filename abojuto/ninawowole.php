<?php

require '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $locations = $_POST['location'];
    $partnerPrices = $_POST['partnerPrice'];
    $dispatcherPrices = $_POST['dispatcherPrice'];
    $profits = $_POST['profit'];

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO ninawo (location, partnerPrice, dispatcherPrice, profit) VALUES (?, ?, ?, ?)");

    // Bind parameters
    $stmt->bind_param("ssss", $location, $partnerPrice, $dispatcherPrice, $profit);

    // Insert each set of form data
    for ($i = 0; $i < count($locations); $i++) {
        $location = $locations[$i];
        $partnerPrice = $partnerPrices[$i];
        $dispatcherPrice = $dispatcherPrices[$i];
        $profit = $profits[$i];
        $stmt->execute();
    }

    $stmt->close();
    $conn->close();

    echo '<script>alert("New location added successfully!");</script>';
    echo '<script>window.location.href = "./ninan.php";</script>';

    exit();
} else {
    echo "Invalid request method.";
}
?>