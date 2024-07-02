<?php
require '../config.php';

if (isset($_POST['id']) && isset($_POST['status'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];
    $returnReason = isset($_POST['returnReason']) ? $_POST['returnReason'] : '';

    if ($status === 'Return' && !empty($returnReason)) {
        $query = "UPDATE gbigbe SET status='Return', returnReason='$returnReason' WHERE id='$id'";
    } else {
        $query = "UPDATE gbigbe SET status='$status' WHERE id='$id'";
    }

    if (mysqli_query($conn, $query)) {
        echo "Status updated successfully.";
    } else {
        echo "Error updating status: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>