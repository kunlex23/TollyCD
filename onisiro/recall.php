<?php
require '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    // Update the captain status
    $query = "UPDATE gbigbe SET status = 'Pending', partnerRemitance = 'rara', accCaptain = 'rara', accPartner = 'rara', partnerPayStatus = 'rara', captainPayStatus='rara' WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo "Success";
    } else {
        echo "Error recalling shipment: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>