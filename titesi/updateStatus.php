<?php
require '../config.php';

if (isset($_POST['id']) && isset($_POST['status']) && isset($_POST['quantity']) && isset($_POST['partner']) && isset($_POST['product'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
    $partner = mysqli_real_escape_string($conn, $_POST['partner']);
    $product = mysqli_real_escape_string($conn, $_POST['product']);
    $returnReason = isset($_POST['returnReason']) ? $_POST['returnReason'] : '';

    if ($status === 'Return' && !empty($returnReason)) {
        $query = "UPDATE gbigbe SET status='Return', returnReason='$returnReason' WHERE id='$id'";
    } else {
        echo "Return reason must be imputed.";
    }

    if (mysqli_query($conn, $query)) {
        echo "Status updated successfully.";
    } else {
        echo "Error updating status: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>