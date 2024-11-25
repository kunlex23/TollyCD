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

session_start();

// Make sure the user is logged in before changing the password
if (!isset($_SESSION['userId'])) {
    header("Location: ../index.php");
    exit();
}
// echo '<pre>';
// print_r($_POST);
// echo '</pre>';

include_once "../config.php";

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $userId = $_SESSION['userId']; // assuming the user's ID is stored in the session
    $oldPassword = mysqli_real_escape_string($conn, trim($_POST['oldPassword']));
    $newPassword = mysqli_real_escape_string($conn, trim($_POST['newPassword']));
    $confirmPassword = mysqli_real_escape_string($conn, trim($_POST['confirmPassword']));


    // Check if all fields are filled
    if (!empty($oldPassword) && !empty($newPassword) && !empty($confirmPassword)) {
        // Fetch the current password from the database
        $sql = mysqli_query($conn, "SELECT password FROM users WHERE userId = '{$userId}'");
        if (mysqli_num_rows($sql) > 0) {
            $row = mysqli_fetch_assoc($sql);
            $currentPasswordHash = $row['password'];

            // Verify the old password matches the current password
            if (md5($oldPassword) === $currentPasswordHash) {
                // Check if the new password matches the confirm password
                if ($newPassword === $confirmPassword) {
                    // Encrypt the new password
                    $newPasswordHash = md5($newPassword);

                    // Update the password in the database
                    $updateSql = "UPDATE users SET password = '{$newPasswordHash}' WHERE userId = '{$userId}'";
                    if (mysqli_query($conn, $updateSql)) {
                        echo '<script>alert("Password successfully changed!");</script>';
                        echo '<script>window.location.href = "./index.php";</script>';
                    } else {
                        echo "Error updating password. Please try again.";
                    }
                } else {
                    echo "New passwords do not match.";
                }
            } else {
                echo "Old password is incorrect.";
            }
        } else {
            echo "User not found.";
        }
    } else {
        echo "All fields are required.";
    }
}
?>