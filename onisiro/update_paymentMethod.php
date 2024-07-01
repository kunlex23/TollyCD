<?php
require '../config.php';

if (isset($_POST['id']) && isset($_POST['paymentMethod'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $paymentMethod = mysqli_real_escape_string($conn, $_POST['paymentMethod']);

    $query = "UPDATE gbigbe SET paymentMethod='$paymentMethod' WHERE id='$id'";
    if (mysqli_query($conn, $query)) {
        echo "paymentMethod updated successfully.";
    } else {
        echo "Error updating paymentMethod: " . mysqli_error($conn);
    }
}
?>