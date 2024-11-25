<?php
session_start();
if (!isset($_SESSION['userType'])) {
    header("location: ../index.php");
} elseif ($_SESSION['userType'] == "Inventory") {
    header("Location: ../okojooja");
} elseif ($_SESSION['userType'] == "Data_Entry") {
    header("Location: ../titesi");
} elseif ($_SESSION['userType'] == "Accountant") {
    header("Location: ../onisiro");
} elseif ($_SESSION['userType'] == "Admin") {
    // Admin is allowed, no redirection
} else {
    header("location: ../index.php");
}

include_once "config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sods = $_POST['sod'];
    $locations = $_POST['location'];
    $partnerPrices = $_POST['partnerPrice'];
    $dispatcherPrices = $_POST['dispatcherPrice'];
    $profits = $_POST['profit'];

    // Prepare the SQL statements
    $checkStmt = $conn->prepare("SELECT 1 FROM ninawo WHERE location = ? AND sod = ?");
    $insertStmt = $conn->prepare("INSERT INTO ninawo (sod, location, partnerPrice, dispatcherPrice, profit) VALUES (?, ?, ?, ?, ?)");

    if ($checkStmt === false || $insertStmt === false) {
        die("Error preparing statements: " . $conn->error);
    }

    // Bind parameters for insert statement
    $insertStmt->bind_param("sssss", $sod, $location, $partnerPrice, $dispatcherPrice, $profit);

    // Insert each set of form data
    for ($i = 0; $i < count($sods); $i++) {
        $sod = $sods[$i];
        $location = $locations[$i];
        $partnerPrice = $partnerPrices[$i];
        $dispatcherPrice = $dispatcherPrices[$i];
        $profit = $profits[$i];

        // Input validation (example: check if prices and profit are numeric)
        if (!is_numeric($partnerPrice) || !is_numeric($dispatcherPrice) || !is_numeric($profit)) {
            echo '<script>alert("Invalid data format for prices or profit.");</script>';
            continue;  // Skip this entry and continue with the next one
        }

        // Check if the sod and location already exist
        $checkStmt->bind_param("ss", $location, $sod);
        $checkStmt->execute();
        $checkStmt->store_result();

        if ($checkStmt->num_rows > 0) {
            echo '<script>alert("Location ' . htmlspecialchars($location) . ' with ' . htmlspecialchars($sod) . ' already exists.");</script>';
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

    // echo '<script>alert("New location(s) added successfully!");</script>';
    echo '<script>window.location.href = "./ninan.php";</script>';

    exit();
} else {
    echo "Invalid request method.";
}
?>