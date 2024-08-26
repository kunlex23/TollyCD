<?php
session_start();
if (!isset($_SESSION['userType'])) {
    header("location: ../index.php");
} elseif (($_SESSION['userType']) == "Inventory") {
    header("Location: ../okojooja");
} elseif (($_SESSION['userType']) == "Data_Entry") {
    header("Location: ../titesi");
} elseif (($_SESSION['userType']) == "Accountant") {
    header("Location: ../onisiro");
} elseif (($_SESSION['userType']) == "Admin") {
} else {
    header("location: ../index.php");
}

require '../config.php';

// Debug: print POST data
// echo '<pre>';
// print_r($_POST);
// echo '</pre>';


// Function to sanitize input data
function sanitize_input($data) {
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
    $dispatcherPrice = sanitize_input($_POST['dispatcherPrice'][0]);
    $profit = sanitize_input($_POST['profit'][0]);
    $partnerPrice = sanitize_input($_POST['partnerPrice'][0]);

    // Since some fields like products, available units, and quantities are arrays, loop through them
    $products = $_POST['orunoloun'];
    $availableUnits = $_POST['availableUnit'];
    $quantities = $_POST['quantity'];
    $amounts = $_POST['amount'];

    // Print each of the received and sanitized data
    echo "Rira: $rira<br>";
    echo "Customer Name: $customersName<br>";
    echo "Customer Contact: $customerContact<br>";
    echo "State: $state<br>";
    echo "Destination: $destination<br>";
    echo "Partner: $partner<br>";
    echo "Captain: $captain<br>";
    echo "Dispatcher Price: $dispatcherPrice<br>";
    echo "Profit: $profit<br>";
    echo "Partner Price: $partnerPrice<br>";

    // Loop through the products array and print each product with its associated values
    foreach ($products as $index => $product) {
        $product = sanitize_input($product);
        $availableUnit = sanitize_input($availableUnits[$index]);
        $quantity = sanitize_input($quantities[$index]);
        $amount = sanitize_input($amounts[$index]);

        echo "<br>Product " . ($index + 1) . ": $product<br>";
        echo "Available Unit: $availableUnit<br>";
        echo "Quantity: $quantity<br>";
        echo "Amount: $amount<br>";
    }
}
?>
