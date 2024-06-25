<?php

require '../config.php';

// Get the data from the form
$productName = $_POST['productName'];
$partner = $_POST['Name'];
$quantity = $_POST['quantity'];

// Check if a record with the same productName and partner already exists
$checkQuery = "SELECT * FROM products WHERE productName = '$productName' AND partner = '$partner'";
$checkResult = $conn->query($checkQuery);

if ($checkResult->num_rows > 0) {
    // A record with the same productName and partner already exists
    echo '<script>alert("Product already exists for this user! Try updating the stock instead");</script>';
    echo '<script>window.location.href = "./ojatitun.php";</script>';
} else {
    // The record does not exist, so proceed with inserting the data
    // Prepare and execute the SQL statement to insert the data
    $sql = "INSERT INTO products (partner, productName, quantity)
            VALUES ('$partner', '$productName', '$quantity')";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("New record created successfully!");</script>';
        echo '<script>window.location.href = "./oja.php";</script>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();

?>