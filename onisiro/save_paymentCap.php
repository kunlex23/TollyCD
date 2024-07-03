<?php
require '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $captain = $_GET['captain'];
    $amount = $_GET['riderReward'];

    $insertQuery = "INSERT INTO olokadaHistory (captain, amount) 
                    VALUES ('$captain', '$amount')";

    if (mysqli_query($conn, $insertQuery)) {
        // echo '<script>alert("Payment made successfully!");</script>';

    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // update
    $query = "UPDATE gbigbe SET captainPayStatus = 'beni' WHERE captain = '$captain' AND status = 'completed' AND captainPayStatus = 'rara'";
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