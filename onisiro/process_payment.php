<?php
require '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $partner = $_POST['partner'];

    // Update the partnerPayStatus to 'beni'
    $query = "UPDATE gigbe SET partnerPayStatus = 'beni' WHERE partner = '$partner' AND status = 'completed' AND partnerPayStatus = 'rara'";
    if (mysqli_query($conn, $query)) {
        echo "Payment status updated successfully.";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>