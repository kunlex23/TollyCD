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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TCD</title>
    <!-- Material app -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <!-- style -->
    <link rel="stylesheet" href="css/styl.css">
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
                <a href="alabasepo.php" class="active">
                    <span class="material-icons-sharp">groups</span>
                    <h3>Partners</h3>
                </a>
                <a href="oja.php">
                    <span class="material-icons-sharp">inventory</span>
                    <h3>Products</h3>
                </a>

                <a href="gbigbeTitun2.php">
                    <span class="material-icons-sharp">add</span>
                    <h3>Create Waybill</h3>
                </a>

                <a href="records.php">
                    <span class="material-icons-sharp">local_shipping</span>
                    <h3>Active Waybills</h3>
                </a>

                <a href="awe.php" >
                    <span class="material-icons-sharp">history</span>
                    <h3>Waybill History</h3>
                </a>


                <a href="../logout.php">
                    <span class="material-icons-sharp">logout</span>
                    <h3>Logout</h3>
                </a>
            </div>
        </aside>
        <!------------ END OF ASIDE ------------>
        <main>

            <!-- ---------END OF EXAM-------- -->
            <div class="recent-sales">
                <h1>Edit Client Data</h1>
                <?php
                require '../config.php';

                if (isset($_GET['clientID'])) {
                    $clientID = $_GET['clientID'];

                    // Fetch the client data by clientID
                    $sql = "SELECT * FROM alabasepo WHERE id = '$clientID'";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        // Display a form with input fields to edit the data
                        echo '<form method="post" action="gbigbeatunwowole.php">
                    <input type="hidden" Name="id" value="' . $row['id'] . '">
                    <input type="hidden" Name="oldName" value="' . $row['Name'] . '">

                    <div class="tray0">
                        Partner: <input type="text" name="Name" value="' . $row['Name'] . '"><br>
                        Contact: <input type="text" name="Contact" value="' . $row['contact'] . '"><br>
                    </div>

                    <div class="tray1">
                        Account Number: <input type="text" name="accountNumber" value="' . $row['accountNumber'] . '"><br>
                        Bank: <input type="text" name="bank" value="' . $row['bank'] . '"><br>
                    
                    </div>
                    <div class="tray2">
                        Account Name: <input type="text" name="accountName" value="' . $row['accountName'] . '"><br>
                        
                    </div>';

                        // Add more input fields for other data as needed
                        echo '<input type="submit" value="Save Changes">';
                        echo '</form>';
                    } else {
                        echo "Client not found.";
                    }
                } else {
                    echo "Invalid client ID.";
                }

                $conn->close();
                ?>
            </div>
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
            </div> <!-- -----------END OF RECENT UPDATE--------------- -->

            <div class="sales-analytics">
                <a href="ojatitunpipo.php">
                    <div class="item add-product">
                        <div>
                            <span class="material-icons-sharp">add</span>
                            <h3>New Product</h3>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <script src="../script/scrip.js"></script>
</body>

</html>