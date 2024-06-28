<?php

include_once "config.php";

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate inputs
    $fname = mysqli_real_escape_string($conn, trim($_POST['fullName']));
    $userId = mysqli_real_escape_string($conn, trim($_POST['userId']));
    $password = mysqli_real_escape_string($conn, trim($_POST['password']));
    $user = mysqli_real_escape_string($conn, trim($_POST['user']));

    if (!empty($fname) && !empty($userId) && !empty($password)) {
        // Check if the user already exists
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE userId = '{$userId}'");
        if (mysqli_num_rows($sql) > 0) {
            echo "This account already exists! Kindly sign in.";
        } else {
            // Encrypt the password
            $encrypt_pass = md5($password);

            // Prepare the insert statement
            $stmt = $conn->prepare("INSERT INTO users (fullName, userId, password, userType) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $fname, $userId, $encrypt_pass, $user);

            // Execute the statement
            if ($stmt->execute()) {
                echo "Account successfully created!";
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        }
    } else {
        echo "All fields are required.";
    }
} else {
    echo "Invalid request method.";
}

// Close the database connection
$conn->close();
?>