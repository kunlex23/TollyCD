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