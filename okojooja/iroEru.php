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
                    <h3>New Waybill</h3>
                </a>

                <a href="records.php">
                    <span class="material-icons-sharp">local_shipping</span>
                    <h3>Waybills</h3>
                </a>

                <a href="awe.php">
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
            <h2>Product History</h2><br>
            <?php
               
           if (isset($_GET['ewo']) && isset($_GET['tani'])) {
                $productID = $_GET['ewo'];
                $partner = $_GET['tani'];
                $availableUnit = $_GET['loku'];
                $eruwo = $_GET['eruwo'];
           }
                echo "Partner: <b>" . $partner . "</b><br>";
                echo "Available Unit: <b>" . $availableUnit . "</b><br>";
                echo "Product ID: <b>" . $productID . "</b><br>";
                echo "Product: <b>" . $eruwo . "</b><br>";
                ?>
            <table id="shipmentTable" style="width: 100%;">
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Product</th>
                        <th>Shipment Type</th>
                        <!-- <th>Avl. Qty</th> -->
                        <th>Destination</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    <?php
        require '../config.php';

        // Prepare the statement
        $stmt = $conn->prepare("SELECT shipmentType, product, availableUnit, destination, date  
                                FROM gbigbe 
                                WHERE partner = ? 
                                AND product LIKE ?");

        // Prepare the parameters
        $likeEruwo = "%$eruwo%";
        
        // Bind the parameters to the SQL query
        $stmt->bind_param("ss", $partner, $likeEruwo);
        
        // Execute the query
        $stmt->execute();
        
        // Get the result
        $result = $stmt->get_result();

        // Initialize the serial number
        $serialNumber = 1;

        // Fetch and display the results in the table
        while ($row = $result->fetch_assoc()) {
            $shipmentType = $row['shipmentType'];
            $availableUnit = $row['availableUnit'];
            $destination = $row['destination'];
            $date = $row['date'];
            $product = $row['product'];
            ?>
                    <tr>
                        <td><?php echo $serialNumber; ?></td>
                        <td><?php echo htmlspecialchars($product); ?></td>
                        <td><?php echo htmlspecialchars($shipmentType); ?></td>
                        <!-- <td><?php echo htmlspecialchars($availableUnit); ?></td> -->
                        <td><?php echo htmlspecialchars($destination); ?></td>
                        <td><?php echo htmlspecialchars($date); ?></td>
                    </tr>
                    <?php
            $serialNumber++;
        }
        ?>
                </tbody>
            </table>

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