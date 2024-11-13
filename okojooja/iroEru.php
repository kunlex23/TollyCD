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
    <style>
    form {
        display: flex;
        padding-left: 30%;
        padding-right: 30%;
        gap: 0.5rem;
    }
      input[type="date"] {
            font-size: 16px;
            padding: 10px;
            width: 200px;
            height: 1rem;
        }
button{
    padding-left: 1rem;
    padding-right: 1rem;
    background-color: #757577;
    height: 1.5rem;
    color: white;
    border-radius: 5px;
}
    .breakDown {
        display: flex;
        gap: 25%;
        text-align: center;
    }

    .breakOne {
        gap: 4rem;
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
            echo "Available Unit: <h2>" . $availableUnit . "</h2><br>";
            echo "Product: <h2>" . $eruwo . "</h2><br>";
            ?><br>

            <form method="post" action="">
                <h2>Start</h2>
                <input type="date" id="start-date" name="start-date" required>
                <h2>End</h2>
                <input type="date" id="end-date" name="end-date" required>
                <button type="submit">Filter</button>
            </form><br>
            <div class="breakDown">
                <div class="breakOne">
                    <?php
                    require '../config.php';

                    // Initialize variables for the date range
                    $start_date = isset($_POST['start-date']) ? $_POST['start-date'] : null;
                    $end_date = isset($_POST['end-date']) ? $_POST['end-date'] : null;

                    // Create a query to sum different columns: rQuantity, bQuantity, and quantity
                    $query_string = "SELECT SUM(rQuantity) AS totalReceived, 
                            SUM(bQuantity) AS totalBad, 
                            SUM(quantity) AS totalGood
                     FROM afikun 
                     WHERE partner = '$partner' AND productName = '$eruwo'";

                    if ($start_date && $end_date) {
                        $query_string .= " AND date BETWEEN '$start_date' AND '$end_date'";
                    }

                    $query_string .= " ORDER BY partner DESC";

                    // Execute the query
                    $query = mysqli_query($conn, $query_string);

                    if (!$query) {
                        echo "Error fetching data: " . mysqli_error($conn);
                    } else {
                        while ($row = mysqli_fetch_array($query)) {
                            $totalReceived = $row['totalReceived'];
                            $totalBad = $row['totalBad'];
                            $totalGood = $row['totalGood'];

                            echo "Received: <h1>" . ($totalReceived ? $totalReceived : 0) . "</h1><br>";
                           
                        }
                    }
                    ?>
                </div>
                <div class="breakOne">
                   <?php echo "Bad: <h1>" . ($totalBad ? $totalBad : 0) . "</h1><br>";?>

                </div>
                <div class="breakOne">
                    <?php echo "Good: <h1>" . ($totalGood ? $totalGood : 0) . "</h1><br>";?>
                </div>
                <div class="breakTwo">
                    <?php
                // Sanitize input to prevent SQL injection
                $partner = mysqli_real_escape_string($conn, $partner);
                $eruwo = mysqli_real_escape_string($conn, $eruwo);

                // Build the base query to get the product
                $query_string = "SELECT product
                     FROM gbigbe 
                     WHERE partner = '$partner' AND product LIKE '$eruwo%'";

                // Add date filtering if start_date and end_date are set
                if (!empty($start_date) && !empty($end_date)) {
                    $start_date = mysqli_real_escape_string($conn, $start_date);
                    $end_date = mysqli_real_escape_string($conn, $end_date);
                    $query_string .= " AND date BETWEEN '$start_date' AND '$end_date'";
                }

                // Order the results by partner in descending order
                $query_string .= " ORDER BY partner DESC";

                // Execute the query
                $query = mysqli_query($conn, $query_string);

                // Check for query execution errors
                if (!$query) {
                    echo "Error fetching data: " . mysqli_error($conn);
                } else {
                    // Initialize total quantity
                    $total_quantity = 0;

                    // Fetch and process the product(s)
                    while ($row = mysqli_fetch_array($query)) {
                        // Extract product and quantity
                        $product_data = explode('=', $row['product']);
                        $quantity = isset($product_data[1]) ? (int) trim($product_data[1]) : 0; // Convert quantity to integer
                
                        // Add to total quantity
                        $total_quantity += $quantity;
                    }

                    // Display the total quantity delivered
                    echo "Total Delivered: <h1>$total_quantity</h1>";
                }
                ?>

                </div>
            </div><br>
            <table id="shipmentTable3" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Type</th>
                                <th>Product</th>
                                <th>Receiver</th>
                                <th>Location</th>
                                <th>Agent</th>
                                <th>Contact</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                            <?php
                            require '../config.php';

                             // Initialize variables for the date range
                        $start_date = isset($_POST['start-date']) ? $_POST['start-date'] : null;
                        $end_date = isset($_POST['end-date']) ? $_POST['end-date'] : null;

                            $productName = explode('=', $eruwo)[0];  // Get the product name before the '='
                            
                            $query_string = "SELECT id, partner, shipmentType, product, availableUnit, quantity, unitPrice, amount, customersName, destination, customerContact, captain, paymentMethod, date 
                            FROM gbigbe 
                            WHERE status = 'completed' 
                            AND product LIKE '$productName%'";


                            // Check if date range is provided and add an additional condition to the WHERE clause
                            if ($start_date && $end_date) {
                                $query_string .= " AND date BETWEEN '$start_date' AND '$end_date'";
                            }

                            // Order the results by partner in descending order
                            $query_string .= " ORDER BY partner DESC";

                            // Execute the query
                            $query = mysqli_query($conn, $query_string);

                            if (!$query) {
                                // Handle the query error
                                echo "Error fetching data: " . mysqli_error($conn);
                            } else {
                                $serialNumber = 1; // Initialize the serial number outside the while loop
                            
                                while ($row = mysqli_fetch_array($query)) {
                                    $id = $row['id'];
                                    $partner = $row['partner'];
                                    $shipmentType = $row['shipmentType'];
                                    $product = $row['product'];
                                    $quantity = $row['quantity'];
                                    $unitPrice = $row['unitPrice'];
                                    $amount = $row['amount'];
                                    $customersName = $row['customersName'];
                                    $destination = $row['destination'];
                                    $customerContact = $row['customerContact'];
                                    $captain = $row['captain'];
                                    $paymentMethod = $row['paymentMethod'];
                                    $date = $row['date'];
                                    ?>
                            <tr>
                                <td><?php echo $serialNumber; ?></td> <!-- Display the serial number -->
                                <td><?php echo $shipmentType; ?></td>
                                <td><?php echo $product; ?></td>
                                <td><?php echo $customersName; ?></td>
                                <td><?php echo $destination; ?></td>
                                <td><?php echo $captain; ?></td>
                                <td><?php echo $customerContact; ?></td>
                                <td><?php echo $date; ?></td>
                            </tr>
                            <?php
                                    $serialNumber++; // Increment the serial number
                                }
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