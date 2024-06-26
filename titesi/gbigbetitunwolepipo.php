<?php
require '../config.php';

// Debug: print POST data
// echo '<pre>';
// print_r($_POST);
// echo '</pre>';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect data from the form
    $partner = $_POST['Name'];
    $products = (array) $_POST['orunoloun'];
    $availableUnits = (array) $_POST['availableUnit'];
    $quantities = (array) $_POST['quantity'];
    $unitPrices = (array) $_POST['unitPrice'];
    $amounts = (array) $_POST['amount'];
    $customerNames = (array) $_POST['customersName'];
    $destinations = (array) $_POST['destination'];
    $customerContacts = (array) $_POST['customerContact'];
    $captains = (array) $_POST['captain'];
    $statuses = (array) $_POST['status'];
    $paymentMethods = (array) $_POST['paymentMethod'];

    // Prepare the SQL statement
    $sql = "INSERT INTO gbigbe (partner, product, availableUnit, quantity, unitPrice, amount, customersName, destination, customerContact, captain, status, paymentMethod) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Check if the statement was prepared successfully
    if ($stmt) {
        // Loop through the products array to insert multiple records
        for ($i = 0; $i < count($products); $i++) {
            // Bind parameters to the SQL query
            $stmt->bind_param("ssiidsssssss", $partner, $products[$i], $availableUnits[$i], $quantities[$i], $unitPrices[$i], $amounts[$i], $customerNames[$i], $destinations[$i], $customerContacts[$i], $captains[$i], $statuses[$i], $paymentMethods[$i]);

            // Execute the statement
            if (!$stmt->execute()) {
                echo "Error: " . $stmt->error;
                exit;
            }
        }
        // Close the statement
        $stmt->close();
        // Redirect to a success page or show a success message
        echo "<script>alert('New Shipment  created successfully!'); window.location.href='records.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>