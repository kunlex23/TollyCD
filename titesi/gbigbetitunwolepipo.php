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
    $shipmentType = (array) $_POST['shipmentType'];
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
    $accPartner = (array) $_POST['accPartner'];
    $accCaptain = (array) $_POST['accCaptain'];

    // Prepare the SQL statement for inserting into 'gbigbe' table
    $sqlInsert = "INSERT INTO gbigbe (partner, shipmentType, product, availableUnit, quantity, amount, customersName, destination, customerContact, captain, status, accCaptain, accPartner) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?)";
    $stmtInsert = $conn->prepare($sqlInsert);

    // Check if the statement was prepared successfully
    if ($stmtInsert) {
        // Prepare the SQL statement for updating the 'products' table
        $sqlUpdate = "UPDATE products SET quantity = ? WHERE productName = ?";
        $stmtUpdate = $conn->prepare($sqlUpdate);

        // Check if the statement was prepared successfully
        if ($stmtUpdate) {
            // Loop through the products array to insert and update records
            for ($i = 0; $i < count($products); $i++) {
                // Calculate the new unit
                $newUnit = $availableUnits[$i] - $quantities[$i];

                // Bind parameters to the insert SQL query
                $stmtInsert->bind_param("sssidssssssss", $partner, $shipmentType[$i], $products[$i], $availableUnits[$i], $quantities[$i], $amounts[$i], $customerNames[$i], $destinations[$i], $customerContacts[$i], $captains[$i], $statuses[$i],  $accCaptain[$i], $accPartner[$i]);

                // Execute the insert statement
                if (!$stmtInsert->execute()) {
                    echo "Error: " . $stmtInsert->error;
                    exit;
                }

                // Bind parameters to the update SQL query
                $stmtUpdate->bind_param("is", $newUnit, $products[$i]);

                // Execute the update statement
                if (!$stmtUpdate->execute()) {
                    echo "Error: " . $stmtUpdate->error;
                    exit;
                }
            }
            // Close the update statement
            $stmtUpdate->close();
        } else {
            echo "Error: " . $conn->error;
            exit;
        }

        // Close the insert statement
        $stmtInsert->close();
        // Redirect to a success page or show a success message
        echo "<script>alert('New Shipment created successfully!'); window.location.href='records.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>