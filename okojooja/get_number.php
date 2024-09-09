<?php
session_start();
if (!isset($_SESSION['userType'])) {
    header("location: ../index.php");
} elseif (($_SESSION['userType']) == "Inventory") {
} elseif (($_SESSION['userType']) == "Data_Entry") {
    header("Location: ../titesi");
} elseif (($_SESSION['userType']) == "Accountant") {
    header("Location: ../onisiro");
} elseif (($_SESSION['userType']) == "Admin") {
    // echo "<button>check</button>";
} else {
    header("location: ../index.php");
}

require '../config.php';

if (isset($_POST['agentName'])) {
    $agentName = $_POST['agentName'];

    $sql = "SELECT location FROM agent WHERE agentName = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $agentName);
    $stmt->execute();
    $result = $stmt->get_result();

    $locations = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $locations[] = $row['location']; // Fetch the 'location'
        }
    }
    echo json_encode($locations); // Return the array of locations
}
?>