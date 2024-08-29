<?php
session_start();
if (!isset($_SESSION['userType'])) {
    header("location: ../index.php");
} elseif (($_SESSION['userType']) == "Inventory") {
} elseif (($_SESSION['userType']) == "Data_Entry") {
    header("Location: ../titesi");
} elseif (($_SESSION['userType']) == "Accountant") {
    header("Location: ../onisiro");
} elseif (($_SESSION['userType']) == "Admin") {
    // echo "<button>check</button>";
} else {
    header("location: ../index.php");
}


require '../config.php'; 

// Get the data from the form
$Name = $_POST['Name'];

// Check if a record with the same Name already exists
$checkQuery = "SELECT * FROM alabasepo WHERE Name = '$Name'";
$checkResult = $conn->query($checkQuery);

if ($checkResult->num_rows > 0) {
    // A record with the same Name already exists
    echo '<script>alert("A record with the same Name already exists!");</script>';
    echo '<script>window.location.href = "./newalabasepo.php";</script>';
} else {
    // The record does not exist, so proceed with inserting the data
    $Name = $_POST['Name'];
    $contact = $_POST['contact'];
    $accountNumber = $_POST['accountNumber'];
    $bank = $_POST['bank'];
    $accountName = $_POST['accountName'];
    $pLocation = $_POST['pLocation'];
  

    // Prepare and execute the SQL statement to insert the data
    $sql = "INSERT INTO alabasepo (Name, contact, accountNumber, bank, accountName, location)
            VALUES ('$Name', '$contact','$accountNumber','$bank','$accountName','$pLocation')";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("New record created successfully!");</script>';
        echo '<script>window.location.href = "./alabasepo.php";</script>';

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();

?>
