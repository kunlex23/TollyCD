<?php
require '../config.php';

// Debug: print POST data
// echo '<pre>';
// print_r($_POST);
// echo '</pre>';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if all required fields are set
    if (isset($_POST['Name'], $_POST['shipmentType'], $_POST['orunoloun'], $_POST['availableUnit'], $_POST['quantity'], $_POST['customersName'], $_POST['destination'], $_POST['customerContact'],  $_POST['status'], $_POST['accPartner'], $_POST['accCaptain'], $_POST['partnerPrice'], $_POST['dispatcherPrice'], $_POST['profit'], $_POST['partnerPayStatus'], $_POST['captainPayStatus'])) {

        // Collect data from the form
        $partner = $_POST['Name'];
        $shipmentType = $_POST['shipmentType'];
        $products = (array) $_POST['orunoloun'];
        $availableUnits = (array) $_POST['availableUnit'];
        $quantities = (array) $_POST['quantity'];
        $customerNames = (array) $_POST['customersName'];
        $destinations = (array) $_POST['destination'];
        $customerContacts = (array) $_POST['customerContact'];
        $statuses = (array) $_POST['status'];
        $accPartner = (array) $_POST['accPartner'];
        $accCaptain = (array) $_POST['accCaptain'];
        $partnerPrices = (array) $_POST['partnerPrice'];
        $dispatcherPrices = (array) $_POST['dispatcherPrice'];
        $profits = (array) $_POST['profit'];
        $partnerPayStatus = (array) $_POST['partnerPayStatus'];
        $captainPayStatus = (array) $_POST['captainPayStatus'];
        $deliveryFee = (array) $_POST['partnerPrice'];

        // Concatenate products and quantities
        $productQuantityList = [];
        for ($i = 0; $i < count($products); $i++) {
            $productQuantityList[] = $products[$i] . ' =' . $quantities[$i] . '';
        }
        $productQuantityString = implode(', ', $productQuantityList);
        // echo $productQuantityString;

        // Concatenate availableUnits
        $avaiList = [];
        for ($i = 0; $i < count($availableUnits); $i++) {
            $avaiList[] = $availableUnits[$i] . ' (' . $quantities[$i] . ')';
        }
        $avaiListString = implode(', ', $avaiList);
        // echo $avaiListString;

        // Prepare the SQL statement for inserting into 'gbigbe' table
        $sqlInsert = "INSERT INTO gbigbe (partner, shipmentType, product, quantity, availableUnit, customersName, destination, customerContact, status, accCaptain, accPartner, partnerReward, deliveryFee, riderReward, profitReward, partnerPayStatus, captainPayStatus) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmtInsert = $conn->prepare($sqlInsert);

        // Check if the statement was prepared successfully
        if ($stmtInsert) {
            // Bind parameters to the insert SQL query
            $stmtInsert->bind_param("sssssssssssssssss", $partner, $shipmentType, $productQuantityString, $productQuantityString, $avaiListString, $customerNames[0], $destinations[0], $customerContacts[0], $statuses[0], $accCaptain[0], $accPartner[0], $partnerPrices[0], $deliveryFee[0], $dispatcherPrices[0], $profits[0], $partnerPayStatus[0], $captainPayStatus[0]);

            // Execute the insert statement
            if (!$stmtInsert->execute()) {
                echo "Error: " . $stmtInsert->error;
                exit;
            }

            // Prepare the SQL statement for updating the 'products' table
            $sqlUpdate = "UPDATE products SET quantity = ? WHERE productName = ?";
            $stmtUpdate = $conn->prepare($sqlUpdate);

            // Check if the statement was prepared successfully
            if ($stmtUpdate) {
                // Loop through the products array to update records
                for ($i = 0; $i < count($products); $i++) {
                    // Calculate the new unit
                    $newUnit = $availableUnits[$i] - $quantities[$i];

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
            echo "<script>alert('New Waybill created successfully!'); window.location.href='records.php';</script>";
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