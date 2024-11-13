<?php
session_start();
if (!isset($_SESSION['userType'])) {
    header("location: ../index.php");
} elseif (($_SESSION['userType']) == "Inventory") {
    header("Location: ../okojooja");
} elseif (($_SESSION['userType']) == "Data_Entry") {
} elseif (($_SESSION['userType']) == "Accountant") {
    header("Location: ../onisiro");
} elseif (($_SESSION['userType']) == "Admin") {
} else {
    header("location: ../index.php");
}

require '../config.php';

if (isset($_POST['getLocations']) && $_POST['getLocations'] === 'true') {
    // Retrieve all locations in alphabetical order
    $sql = "SELECT DISTINCT location FROM ninawo ORDER BY location ASC";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        echo json_encode(['error' => 'Failed to prepare statement']);
        exit();
    }

    $stmt->execute();
    $result = $stmt->get_result();

    $locations = [];
    while ($row = $result->fetch_assoc()) {
        $locations[] = $row['location'];
    }

    $stmt->close();
    $conn->close();

    echo json_encode($locations);
    exit();
}

if (isset($_POST['location'])) {
    $location = $_POST['location'];

    // Prepared statement to fetch price details for a specific location
    $sql = "SELECT location, partnerPrice, dispatcherPrice, profit FROM ninawo WHERE location = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        echo json_encode(['error' => 'Failed to prepare statement']);
        exit();
    }

    $stmt->bind_param("s", $location);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $response = [
            'partnerPrice' => $row['partnerPrice'],
            'dispatcherPrice' => $row['dispatcherPrice'],
            'profit' => $row['profit']
        ];
    } else {
        $response = ['error' => 'No prices found for the selected location.'];
    }

    $stmt->close();
    $conn->close();

    echo json_encode($response);
}
?>
