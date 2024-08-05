<?php
require '../config.php';

if (isset($_POST['id']) && isset($_POST['remitanceKind'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $remitanceKind = mysqli_real_escape_string($conn, $_POST['remitanceKind']);

    $query = "UPDATE gbigbe SET remitanceKind='$remitanceKind' WHERE id='$id'";
    if (mysqli_query($conn, $query)) {
        echo "remitanceKind updated successfully.";
    } else {
        echo "Error updating remitanceKind: " . mysqli_error($conn);
    }
}
?>1 b