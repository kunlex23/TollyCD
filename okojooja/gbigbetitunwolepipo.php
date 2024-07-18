<?php
require '../config.php';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if all required fields are set
    if (
        isset(
        $_POST['Name'],
        $_POST['shipmentType'],
        $_POST['orunoloun'],
        $_POST['availableUnit'],
        $_POST['quantity'],
        $_POST['amount'],
        $_POST['customersName'],
        $_POST['location'],
        $_POST['customerContact'],
        $_POST['status'],
        $_POST['accPartner'],
        $_POST['accCaptain'],
        $_POST['partnerPrice'],
        $_POST['driverFee'],
        $_POST['waybillFee'],
        $_POST['partnerPayStatus'],
        $_POST['captainPayStatus']
    )
    ) {
        // Collect data from the form
        $partner = $_POST['Name'];
        $shipmentType = $_POST['shipmentType'];
        $products = (array) $_POST['orunoloun'];
        $availableUnits = (array) $_POST['availableUnit'];
        $quantities = (array) $_POST['quantity'];
        $amounts = (array) $_POST['amount'];
        $customerNames = (array) $_POST['customersName'];
        $destinations = (array) $_POST['location'];
        $customerContacts = (array) $_POST['customerContact'];
        $statuses = (array) $_POST['status'];
        $accPartner = $_POST['accPartner'];
        $accCaptain = $_POST['accCaptain'];
        $partnerPrices = (array) $_POST['partnerPrice'];
        $dispatcherPrices = (array) $_POST['driverFee'];
        $partnerPayStatus = $_POST['partnerPayStatus'];
        $captainPayStatus = $_POST['captainPayStatus'];
        $waybillFee = (array) $_POST['waybillFee'];

        // Prepare the SQL statement for inserting into 'gbigbe' table
        $sqlInsert = "INSERT INTO gbigbe (partner, shipmentType, product, availableUnit, quantity, amount, customersName, destination, customerContact, status, accCaptain, accPartner, partnerReward, riderReward, profitReward, partnerPayStatus, captainPayStatus) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

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
                    $stmtInsert->bind_param("sssidssssssssssss", $partner, $shipmentType, $products[$i], $availableUnits[$i], $quantities[$i], $amounts[$i], $customerNames[$i], $destinations[$i], $customerContacts[$i], $statuses[$i], $accCaptain, $accPartner, $partnerPrices[$i], $dispatcherPrices[$i], $profits[$i], $partnerPayStatus, $captainPayStatus);

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
        echo "Missing required form fields.";
    }
} else {
    echo "Invalid request method.";
}
?>