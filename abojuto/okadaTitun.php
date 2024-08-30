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
// Retrieve and sanitize form data
$fullnames = $_POST['fullname'];
$contacts = $_POST['contact'];
$addresses = $_POST['Address'];
$accountNumbers = $_POST['accountNumber'];
$accountNames = $_POST['accountName'];
$bankNames = $_POST['bankName'];
$gFullnames = $_POST['gFullname'];
$gContacts = $_POST['gFontact'];
$gAddresses = $_POST['gAddress'];
$occupations = $_POST['occupation'];
$relationships = $_POST['relationship'];

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO oluwa (fullname, contact, address, accountNumber, accountName, bankName, gFullname, gContact, gAddress, occupation, relationship) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param("sssssssssss", $fullname, $contact, $address, $accountNumber, $accountName, $bankName, $gFullname, $gContact, $gAddress, $occupation, $relationship);

// Loop through the arrays and insert each record
for ($i = 0; $i < count($fullnames); $i++) {
    $fullname = $fullnames[$i];
    $contact = $contacts[$i];
    $address = $addresses[$i];
    $accountNumber = $accountNumbers[$i];
    $accountName = $accountNames[$i];
    $bankName = $bankNames[$i];
    $gFullname = $gFullnames[$i];
    $gContact = $gContacts[$i];
    $gAddress = $gAddresses[$i];
    $occupation = $occupations[$i];
    $relationship = $relationships[$i];

    $stmt->execute();
}

// Close statement and connection
$stmt->close();
$conn->close();

// Redirect or display a success message
echo '<script>alert("New Captain added successfully!");</script>';
echo '<script>window.location.href = "./newCaptain.php";</script>';
?>