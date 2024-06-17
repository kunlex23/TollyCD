<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zibah</title>
    <!-- Material app -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <!-- style -->
    <link rel="stylesheet" href="css/style.css">
    <style>
       table, th, td {
  /* border: 1px solid black; */
  /* border-collapse: collapse; */
    padding: 8px;
}

tr:nth-child(even) {
  background-color: rgba(150, 212, 212, 0.4);
}

td:nth-child(even) {
  background-color: rgba(150, 212, 212, 0.4);
}
    </style>
</head>

<body>
    <div class="container">
        <aside>
            <div class="top">
                <div class="logo">
                <img src="./images/logo.png">
                    <!-- <h2>ZIB<span class="compel">AH</span></h2> -->
                    <!-- <h2>Name</h2> -->
                </div>
                <div class="closeBTN" id="close-btn"><span class="material-icons-sharp">close</span>
                </div>
            </div>
            <div class="sideBar">
                <a href="index.php">
                    <span class="material-icons-sharp">grid_view</span>
                    <h3>Dashboard</h3>
                </a>
                <a href="client_records.php">
                    <span class="material-icons-sharp">local_library</span>
                    <h3>Client Records</h3>
                </a>
                <a href="newClient.php">
                    <span class="material-icons-sharp">person_outline</span>
                    <h3>New Client</h3>
                </a>
                <a href="workRecord.php" class="active">
                    <span class="material-icons-sharp">local_library</span>
                    <h3>Work Records</h3>
                </a>
                <a href="newWorkentry.php">
                    <span class="material-icons-sharp">checkroom</span>
                    <h3>New Work</h3>
                </a>
                <a href="#">
                    <span class="material-icons-sharp"></span>
                    <h3></h3>
                </a>
            </div>
            </aside>
        <!------------ END OF ASIDE ------------>
        <main>

            <!-- ---------END OF EXAM-------- -->
            <div class="recent-sales">
                <h1>Searched Records</h1>
                <?php
require 'config.php';
$fullname = $_GET['fullname'];

if (isset($_GET['delete_id'])) {
    $deleteId = $_GET['delete_id'];
    // Perform the deletion query here
    $deleteSql = "DELETE FROM work WHERE workID = $deleteId";

    if ($conn->query($deleteSql) === TRUE) {
        echo "Record deleted successfully.";
        // You can add a redirect here if needed
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

if (isset($_GET['status_id'])) {
    $status_id = $_GET['status_id'];

    // Perform the update query here
    $statusSql = "UPDATE work SET Status = '0', StatusC = 'Done' WHERE workID = $status_id";

    if ($conn->query($statusSql) === TRUE) {
        echo "Record updated successfully.";
        // You can add a redirect here if needed
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

if (isset($_GET['fullname'])) {
    $fullname = $conn->real_escape_string($_GET['fullname']);

    $sql = "SELECT * FROM work WHERE fullname = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $fullname);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo '<table border="1">';
        echo '<tr>
            <th>Fullname</th>
            <th>Style</th>
            <th>Status</th>
            <th>Entry Date</th>
            <th>Delivery Date</th>
            <th>Status</th>
            <th>Delete</th>
            <th>Action</th>
            <th>Edit</th>
            </tr>';
        
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row["fullname"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["style"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["StatusC"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["Entry_date"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["Due_Date"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["StatusC"]) . '</td>';
                // Delete link
                echo '<td><a href="?fullname=$fullname&delete_id=' . $row['workID'] . '" onclick="return confirm(\'Are you sure you want to delete this record? This action is NOT reversible\')">Delete</a></td>';
                // Done link
                echo '<td><a href="?fullname=$fullname&status_id=' . $row['workID'] . '" onclick="return confirm(\'By clicking Ok you confirm that this work is completed. This action is NOT reversible\')">Done</a></td>';    
                // Add an anchor tag for editing
                echo '<td><a href="editRecord.php?id=' . $row["workID"] . '">Edit</a></td>';
                
                echo '</tr>';
            }
            
        
        echo '</table>';
    } else {
        // echo "No record found!";
    }

    $stmt->close();
    $conn->close();
}
?>



                 </main>
                <!-- ----------END OF MAIN----------- -->
                <div class="right">
                <div class="top">
                <button id="menu-btn">
                    <span class="material-icons-sharp">menu</span>
                </button>
                <div class="theme-toggler">
                    <span class="material-icons-sharp active">light_mode</span>
                    <span class="material-icons-sharp">dark_mode</span>
                </div>
                </div>            <!-- -----------END OF RECENT UPDATE--------------- -->
                <div class="sales-analytics">

                <a href="newWorkentry.php">
                    <div class="item add-product">
                        <div>
                            <span class="material-icons-sharp">add</span>
                            <h3>New Work</h3>
                        </div>
                    </div>
                </a>
                
             </div><div class="sales-analytics">

                <a href="newClient.php">
                    <div class="item add-product">
                        <div>
                            <span class="material-icons-sharp">add</span>
                            <h3>New Client</h3>
                        </div>
                    </div>
                </a>
                
            </div>
            <form action="/fashion-app/search.php" method="GET">

            <label for="fullname">Full Name:</label>
                            <select name="fullname" required>
                                <option value="">Select a client</option>
                                <?php
                        require 'config.php';
                        $sql = "SELECT fullname, contact FROM client_info";
                        $result = $conn->query($sql);
                    
                        // Generate options for the combo box
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<option value="' . $row["fullname"] . '">' . $row["fullname"] . ' - ' . $row["contact"] . '</option>';
                            }
                        }
                    
                        ?>
                <input type="submit" value="Search">
            </form>
        </div>
    </div>
    <script src="script/scrip.js"></script>
</body>

</html>
