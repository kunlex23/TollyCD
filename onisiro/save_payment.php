
<?php
require '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $partner = $_GET['partner'];
    $totalAmount = $_GET['totalAmount'];
    $accountNumber = $_GET['accountNumber'];
    $bank = $_GET['bank'];
    $accountName = $_GET['accountName'];

    $insertQuery = "INSERT INTO owoAlabasepoHistory (partner, totalAmount, accountNumber, bank, accountName) 
                    VALUES ('$partner', '$totalAmount', '$accountNumber', '$bank', '$accountName')";

    if (mysqli_query($conn, $insertQuery)) {
        // echo '<script>alert("Payment made successfully!");</script>';
        
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // update
    $query = "UPDATE gbigbe SET partnerPayStatus = 'beni' WHERE partner = '$partner' AND status = 'completed' AND partnerPayStatus = 'rara'";
    if (mysqli_query($conn, $query)) {
        echo "Payment made successfully.";
        echo '<script>window.location.href = "./records.php";</script>';
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    //----------------------
} else {
    echo "Invalid request method.";
}
?>