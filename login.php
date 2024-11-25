<?php
session_start();

include_once "config.php";

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate inputs
    $uname = mysqli_real_escape_string($conn, trim($_POST['uname']));
    $password = mysqli_real_escape_string($conn, trim($_POST['psw']));

    if (!empty($uname) && !empty($password)) {
        // Encrypt the password
        $encrypt_pass = md5($password);

        // Prepare the select statement
        $stmt = $conn->prepare("SELECT userType, fullName FROM users WHERE userId = ? AND password = ?");
        $stmt->bind_param("ss", $uname, $encrypt_pass);

        // Execute the statement
        $stmt->execute();
        $stmt->store_result();

        // Check if the user exists
        if ($stmt->num_rows > 0) {
        $stmt->bind_result($userType, $fullName); // Fetch both userType and fullName
        $stmt->fetch();
        
        // Set session variables
            $_SESSION['userType'] = $userType;
            $_SESSION['fullName'] = $fullName;
            $details = "$fullName ($userType)";
            $_SESSION['details'] = $details;
            $_SESSION['userId'] = $uname;


            // Redirect based on userType
        if ($_SESSION['userType'] == "Inventory") {
            header("Location: ./okojooja");
        } elseif ($_SESSION['userType'] == "Data_Entry") {
            header("Location: ./titesi");
        } elseif ($_SESSION['userType'] == "Accountant") {
            header("Location: ./onisiro");
        } elseif ($_SESSION['userType'] == "Admin") {
            header("Location: ./abojuto");
        }
        
        exit();


        } else {
            echo "Invalid username or password.";
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "All fields are required.";
    }
} else {
    echo "Invalid request method.";
}

// Close the database connection
$conn->close();
?>