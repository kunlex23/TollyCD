<?php
require '../config.php';

// Debug: print POST data
// echo '<pre>';
// print_r($_POST);
// echo '</pre>';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if all required fields are set
    if (isset($_POST['Name'], $_POST['shipmentType'], $_POST['orunoloun'], $_POST['availableUnit'], $_POST['quantity'], $_POST['amount'], $_POST['customersName'], $_POST['destination'], $_POST['customerContact'], $_POST['captain'], $_POST['status'], $_POST['accPartner'], $_POST['accCaptain'], $_POST['partnerPrice'], $_POST['dispatcherPrice'], $_POST['profit'], $_POST['partnerPayStatus'], $_POST['captainPayStatus'])) {

        // Collect data from the form
        $partner = $_POST['Name'];
        $shipmentType = (array) $_POST['shipmentType'];
        $products = (array) $_POST['orunoloun'];
        $availableUnits = (array) $_POST['availableUnit'];
        $quantities = (array) $_POST['quantity'];
        $amounts = (array) $_POST['amount'];
        $customerNames = (array) $_POST['customersName'];
        $destinations = (array) $_POST['destination'];
        $customerContacts = (array) $_POST['customerContact'];
        $captains = (array) $_POST['captain'];
        $statuses = (array) $_POST['status'];
        $accPartner = (array) $_POST['accPartner'];
        $accCaptain = (array) $_POST['accCaptain'];
        $partnerPrices = (array) $_POST['partnerPrice'];
        $deliveryFee = (array) $_POST['partnerPrice'];
        $dispatcherPrices = (array) $_POST['dispatcherPrice'];
        $profits = (array) $_POST['profit'];
        $partnerPayStatus = (array) $_POST['partnerPayStatus'];
        $captainPayStatus = (array) $_POST['captainPayStatus'];
        $state = (array) $_POST['state'];

        // Ensure amounts and partnerPrices are numeric
        $amounts = array_map('floatval', $amounts);
        $partnerPrices = array_map('floatval', $partnerPrices);

        // Calculate the partnerPrice
        $partnerPrices = array_map(function ($amount, $partnerPrice) {
            return $amount - $partnerPrice;
        }, $amounts, $partnerPrices);

        // Prepare the SQL statement for inserting into 'gbigbe' table
        $sqlInsert = "INSERT INTO gbigbe (partner, shipmentType, product, availableUnit, quantity, amount, customersName, SOD, destination, customerContact, captain, status, accCaptain, accPartner, partnerReward, deliveryFee, riderReward, profitReward, partnerPayStatus, captainPayStatus) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

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
                    $stmtInsert->bind_param("sssidsssssssssssssss", $partner, $shipmentType[$i], $products[$i], $availableUnits[$i], $quantities[$i], $amounts[$i], $customerNames[$i], $state[$i], $destinations[$i], $customerContacts[$i], $captains[$i], $statuses[$i], $accCaptain[$i], $accPartner[$i], $partnerPrices[$i], $deliveryFee[$i], $dispatcherPrices[$i], $profits[$i], $partnerPayStatus[$i], $captainPayStatus[$i]);

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