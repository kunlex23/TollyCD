<<<<<<< HEAD
<?php
session_start();
if (!isset($_SESSION['userType'])) {
    header("location: ../index.php");
} elseif (($_SESSION['userType']) == "Inventory") {
    header("Location: ../okojooja");
} elseif (($_SESSION['userType']) == "Data_Entry") {
    header("Location: ../titesi");
} elseif (($_SESSION['userType']) == "Accountant") {
} elseif (($_SESSION['userType']) == "Admin") {
} else {
    header("location: ../index.php");
}

require '../config.php';

// echo '<pre>';
// print_r($_POST);
// echo '</pre>';

// Function to generate a unique payID
function generatePaymentId()
{
    $timestamp = microtime(true); // Current timestamp with microseconds
    $randomNumber = mt_rand(100000, 999999); // Random number within a specified range

    // Concatenate timestamp and random number
    $paymentId = $timestamp . $randomNumber;

    // Remove any decimal point from the timestamp
    $paymentId = str_replace('.', '', $paymentId);

    return $paymentId;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $oluwa = $_POST['oluwa'];
    $accountNumber = $_POST['accountNumber'];
    $bank = $_POST['bank'];
    $accountName = $_POST['accountName'];
    $selectedShipments = $_POST['selectedShipments'];

    // Generate the unique payID
    $payID = generatePaymentId();

    // Calculate total amount for the selected shipments
    $totalAmount = 0;
    foreach ($selectedShipments as $shipmentId) {
        $query = "SELECT riderReward FROM gbigbe WHERE id = '$shipmentId'";
        $result = mysqli_query($conn, $query);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $totalAmount += $row['riderReward'];
        }
    }
    // echo $totalAmount;
    $insertQuery = "INSERT INTO olokadahistory (captain, amount, accountNumber, bank, accountName, payID) 
                    VALUES ('$oluwa', '$totalAmount', '$accountNumber', '$bank', '$accountName', '$payID')";

    if (mysqli_query($conn, $insertQuery)) {
        foreach ($selectedShipments as $shipmentId) {
            $updateQuery = "UPDATE gbigbe 
            SET captainPayStatus = 'beni', 
            payID4 = '$payID' 
                            WHERE id = '$shipmentId'";
            mysqli_query($conn, $updateQuery);
        }
        // echo '<script>alert("Payment made successfully!");</script>';
        echo '<script>window.location.href = "./records.php";</script>';

    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request method.";
}
=======
<?php
session_start();
if (!isset($_SESSION['userType'])) {
    header("location: ../index.php");
} elseif (($_SESSION['userType']) == "Inventory") {
    header("Location: ../okojooja");
} elseif (($_SESSION['userType']) == "Data_Entry") {
    header("Location: ../titesi");
} elseif (($_SESSION['userType']) == "Accountant") {
} elseif (($_SESSION['userType']) == "Admin") {
} else {
    header("location: ../index.php");
}

require '../config.php';

// echo '<pre>';
// print_r($_POST);
// echo '</pre>';

// Function to generate a unique payID
function generatePaymentId()
{
    $timestamp = microtime(true); // Current timestamp with microseconds
    $randomNumber = mt_rand(100000, 999999); // Random number within a specified range

    // Concatenate timestamp and random number
    $paymentId = $timestamp . $randomNumber;

    // Remove any decimal point from the timestamp
    $paymentId = str_replace('.', '', $paymentId);

    return $paymentId;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $oluwa = $_POST['oluwa'];
    $accountNumber = $_POST['accountNumber'];
    $bank = $_POST['bank'];
    $accountName = $_POST['accountName'];
    $selectedShipments = $_POST['selectedShipments'];

    // Generate the unique payID
    $payID = generatePaymentId();

    // Calculate total amount for the selected shipments
    $totalAmount = 0;
    foreach ($selectedShipments as $shipmentId) {
        $query = "SELECT riderReward FROM gbigbe WHERE id = '$shipmentId'";
        $result = mysqli_query($conn, $query);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $totalAmount += $row['riderReward'];
        }
    }
    // echo $totalAmount;
    $insertQuery = "INSERT INTO olokadahistory (captain, amount, accountNumber, bank, accountName, payID) 
                    VALUES ('$oluwa', '$totalAmount', '$accountNumber', '$bank', '$accountName', '$payID')";

    if (mysqli_query($conn, $insertQuery)) {
        foreach ($selectedShipments as $shipmentId) {
            $updateQuery = "UPDATE gbigbe 
            SET captainPayStatus = 'beni', 
            payID4 = '$payID' 
                            WHERE id = '$shipmentId'";
            mysqli_query($conn, $updateQuery);
        }
        // echo '<script>alert("Payment made successfully!");</script>';
        echo '<script>window.location.href = "./records.php";</script>';

    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request method.";
}
>>>>>>> 438e7786b64c654f6174992bd89b7813079ba0e1
?>