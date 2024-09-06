<?php
session_start();
if (!isset($_SESSION['userType'])) {
    header("location: ../index.php");
    exit();
} elseif (($_SESSION['userType']) == "Inventory") {
    header("Location: ../okojooja");
    exit();
} elseif (($_SESSION['userType']) == "Data_Entry") {
    header("Location: ../titesi");
    exit();
} elseif (($_SESSION['userType']) == "Accountant") {
    header("Location: ../onisiro");
    exit();
} elseif ($_SESSION['userType'] != "Admin") {
    header("location: ../index.php");
    exit();
}

require '../config.php';
// echo '<pre>';
// print_r($_POST);
// echo '</pre>';

// Function to sanitize input data
function sanitize_input($data)
{
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize the input values
    $rira = sanitize_input($_POST['rira']);
    $customersName = sanitize_input($_POST['customersName']);
    $customerContact = sanitize_input($_POST['customerContact']);
    $state = sanitize_input($_POST['state']);
    $destination = sanitize_input($_POST['destination']);
    $partner = sanitize_input($_POST['partner']);
    $captain = sanitize_input($_POST['captain']);
    $amount = (float) sanitize_input($_POST['amount'][0]);
    $dispatcherPrice = (float) sanitize_input($_POST['dispatcherPrice'][0]);
    $profit = sanitize_input($_POST['profit'][0]);
    $partnerPrice = sanitize_input($_POST['partnerPrice'][0]);
    $oldProductStr = sanitize_input($_POST['oldProduct'][0]);
    $productz = (array) $_POST['orunoloun'];
    $quantitz = (array) $_POST['quantity'];
    $detailse = $_SESSION['details'];

    // Concatenate products and quantities
    $productQuantityList = [];
    for ($i = 0; $i < count($productz); $i++) {
        $productQuantityList[] = $productz[$i] . ' =' . $quantitz[$i] . '';
    }
    $productQuantityString = implode(', ', $productQuantityList);
    // echo $productQuantityString;


    // Parse oldProduct string into an associative array
    $oldProductArr = [];
    $pairs = explode(',', $oldProductStr);
    foreach ($pairs as $pair) {
        list($key, $value) = explode('=', $pair);
        $oldProductArr[trim($key)] = (int) trim($value);
    }

    // Since some fields like products and quantities are arrays, loop through them
    $products = $_POST['orunoloun'];
    $quantities = $_POST['quantity'];

    // Start a transaction
    mysqli_begin_transaction($conn);

    try {
        // Loop through the products and handle database updates
        foreach ($products as $index => $product) {
            $product = sanitize_input($product);
            $quantity = (int) sanitize_input($quantities[$index]);

            if (isset($oldProductArr[$product])) {
                $oldQuantity = $oldProductArr[$product];
                $difference = $quantity - $oldQuantity;

                if ($difference > 0) {
                    // Increase the quantity in the product table
                    $query = "UPDATE products 
                    SET quantity = quantity - '$difference' 
                    WHERE productName = '$product' AND 
                    partner='$partner'";
                    // echo "Taking $difference units from stock for $product.<br>";
                } elseif ($difference < 0) {
                    // Decrease the quantity in the product table
                    $excess = abs($difference);
                    $query = "UPDATE products 
                    SET quantity = quantity + '$excess' 
                    WHERE productName = '$product' 
                    AND partner='$partner'";

                    // echo "Adding $excess units back to stock for $product.<br>";
                } else {
                    // No change in quantity
                    // echo "No change in quantity for $product.<br>";
                    continue;
                }
            } else {
                // Product not in the old list (new product)
                $query = "UPDATE products 
                          SET quantity = quantity - '$quantity' 
                          WHERE productName = '$product' 
                          AND partner='$partner'";

                // echo "$product is new, with quantity $quantity.<br>";

                // Execute the query
                if (mysqli_query($conn, $query)) {
                    // echo "New product '$product' updated successfully with quantity $quantity.<br>";
                } else {
                    throw new Exception("Error updating $product: " . mysqli_error($conn));
                }
            }

            // Execute the query for existing products
            if (isset($query) && mysqli_query($conn, $query)) {
                // echo "$product updated/inserted successfully.<br>";
            } else {
                throw new Exception("Error updating/inserting $product: " . mysqli_error($conn));
            }
        }

        // Handle old products not in the new list
        foreach ($oldProductArr as $oldProductName => $oldProductQuantity) {
            if (!in_array($oldProductName, $products)) {
                // Add the old product's quantity back to the products table
                $query = "UPDATE products 
                          SET quantity = quantity + '$oldProductQuantity' 
                          WHERE productName = '$oldProductName' 
                          AND partner='$partner'";

                // Execute the query
                if (mysqli_query($conn, $query)) {
                    // echo "Old product '$oldProductName' added back to stock with quantity $oldProductQuantity.<br>";
                } else {
                    throw new Exception("Error updating $oldProductName: " . mysqli_error($conn));
                }
            }
        }

        $newParnerReward = $amount - $partnerPrice;
        echo "Partner Reward: $newParnerReward";
        // update the 'gbigbe' table
        $gbigbeQuery = "UPDATE gbigbe 
                        SET customerContact = '$customerContact', 
                            destination = '$destination', 
                            amount = '$amount',
                            product = '$productQuantityString',
                            partnerReward = '$newParnerReward',
                            deliveryFee = '$partnerPrice',
                            profitReward = '$profit',
                            riderReward = '$dispatcherPrice', 
                            editedBy = '$detailse'
                            
                        WHERE id = '$rira'";

        if (mysqli_query($conn, $gbigbeQuery)) {
            // echo "gbigbe table updated successfully with customer contact '$customerContact', destination '$destination', and amount '$amount'.<br>";
        } else {
            throw new Exception("Error updating gbigbe table: " . mysqli_error($conn));
        }

        // Commit the transaction
        mysqli_commit($conn);
        // echo "All updates successful!";
        echo "<script>window.location.href='records.php';</script>";
    } catch (Exception $e) {
        // Rollback the transaction on error
        mysqli_rollback($conn);
        // echo "Failed to update database: " . $e->getMessage();
    }
}
?>