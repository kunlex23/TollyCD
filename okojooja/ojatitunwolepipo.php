<?php
session_start();
if (!isset($_SESSION['userType'])) {
    header("location: ../index.php");
} elseif (($_SESSION['userType']) == "Inventory") {
} elseif (($_SESSION['userType']) == "Data_Entry") {
    header("Location: ../titesi");
} elseif (($_SESSION['userType']) == "Accountant") {
    header("Location: ../onisiro");
} elseif (($_SESSION['userType']) == "Admin") {
    // echo "<button>check</button>";
} else {
    header("location: ../index.php");
}

require '../config.php';

// echo '<pre>';
// print_r($_POST);
// echo '</pre>';

// Get the data from the form
$partner = $_POST['Name'];
$productNames = $_POST['productName'];
$quantities = $_POST['quantity'];
$rQuantity = $_POST['rQuantity'];
$bQuantity = $_POST['bQuantity'];

$errors = [];
$successCount = 0;

foreach ($productNames as $index => $productName) {
    $quantity = $quantities[$index];
    $rQty = $rQuantity[$index]; // Make sure you're getting the corresponding rQuantity
    $bQty = $bQuantity[$index]; // Make sure you're getting the corresponding bQuantity

    // Check if a record with the same productName and partner already exists
    $checkQuery = "SELECT * FROM products WHERE productName = '$productName' AND partner = '$partner'";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        // A record with the same productName and partner already exists
        $errors[] = "Product '$productName' already exists for this user! Try updating the stock instead.";
    } else {
        // The record does not exist, so proceed with inserting the data into the products table
        $sql = "INSERT INTO products (partner, productName, quantity)
                VALUES ('$partner', '$productName', '$rQty')";

        // Insert into the afikun table
        $insertSql = "INSERT INTO afikun (partner, productName, oQuantity, rQuantity, bQuantity, quantity)
                      VALUES ('$partner', '$productName', '0', '$rQty','$bQty', '$quantity')";

        if ($conn->query($sql) === TRUE && $conn->query($insertSql) === TRUE) {
            $successCount++;
        } else {
            $errors[] = "Error inserting product '$productName' or into afikun: " . $conn->error;
        }
    }
}

// Display the results
if ($successCount > 0) {
    echo '<script>alert("' . $successCount . ' new record(s) created successfully!");</script>';
}
if (count($errors) > 0) {
    foreach ($errors as $error) {
        echo '<script>alert("' . $error . '");</script>';
    }
}
echo '<script>window.location.href = "./oja.php";</script>';

// Close the database connection
$conn->close();
?>