<?php
session_start();
if (!isset($_SESSION['userType'])) {
    header("location: ../index.php");
}elseif (($_SESSION['userType']) == "Inventory"){
}elseif (($_SESSION['userType']) == "Data_Entry"){
header("Location: ../titesi");
 }elseif (($_SESSION['userType']) == "Accountant"){
header("Location: ../onisiro");
}elseif (($_SESSION['userType']) == "Admin"){
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
    <link rel="stylesheet" href="css/styler.css">
    <style>
    table,
    th,
    td {
        border: 1px solid blanchedalmond;
        border-collapse: collapse;
        padding: 2px;
    }

    tr:nth-child(even) {
        background-color: rgba(150, 212, 212, 0.4);
    }

    td:nth-child(even) {
        background-color: rgba(150, 212, 212, 0.4);
    }

    .navbar {
        display: flex;
        justify-content: center;
        margin-top: 2rem;
        margin-bottom: 2rem;
        gap: 1rem;
    }

    /* Styling for individual navigation buttons */
    .nav-button {
        padding: 0.6rem;
        font-size: 16px;
        color: white;
        background-color: #007BFF;
        border: none;
        border-radius: 2rem;
        text-align: center;
        text-decoration: none;
        cursor: pointer;
        width: 3rem;
        height: 3rem;
    }

    /* Styling for button hover effect */
    .nav-button:hover {
        background-color: #0056b3;
    }

    .form1 {
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

    button {
        padding-left: 1rem;
        padding-right: 1rem;
        background-color: #757577;
        height: 1.5rem;
        color: white;
        border-radius: 5px;
    }
    </style>
</head>

<body>
    <div class="container">
        <aside>
            <div class="top">
                <div class="logo">
                    <img src="./images/logo.png">
                </div>
                <div class="closeBTN" id="close-btn"><span class="material-icons-sharp">close</span>
                </div>
            </div>
            <div class="sideBar">
                <a href="index.php">
                    <span class="material-icons-sharp">grid_view</span>
                    <h3>Dashboard</h3>
                </a>
                <a href="alabasepo.php">
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


                <a href="abawole.php">
                    <span class="material-icons-sharp">manage_accounts</span>
                    <h3>Change Password</h3>
                </a>


                <a href="iroyin.php" class="active">
                    <span class="material-icons-sharp">history</span>
                    <h3>Report</h3>
                </a>
                
                <a href="../logout.php">
                    <span class="material-icons-sharp">logout</span>
                    <h3>Logout</h3>
                </a>
            </div>
        </aside>
        <!------------ END OF ASIDE ------------>
        <main>
            <h1>Report</h1><br>
            <form method="post" action="" class="form1">
                <h2>Start</h2>
                <input type="date" id="start-date" name="start-date" required>
                <h2>End</h2>
                <input type="date" id="end-date" name="end-date" required>
                <button type="submit">Filter</button>
            </form><br>
            <div class="insight">

                
                
                <div class="sales">
                    <div class="middle">
                        <div class="left">
                            <h3>Waybill</h3>
                            <div>
                                    <?php
                                    require '../config.php';

                                    // Initialize variables for the date range and sanitize inputs
                                    $start_date = isset($_POST['start-date']) ? mysqli_real_escape_string($conn, $_POST['start-date']) : null;
                                    $end_date = isset($_POST['end-date']) ? mysqli_real_escape_string($conn, $_POST['end-date']) : null;

                                    // Base query
                                    // SELECT COUNT(*) AS totalClients
                                    $query_string = "SELECT COUNT(*) AS amountIn
                                    FROM gbigbe
                                    WHERE shipmentType = 'waybill'";

                                    // Check if date range is provided and append a condition using AND
                                    if ($start_date && $end_date) {
                                        $query_string .= " AND date BETWEEN '$start_date' AND '$end_date'";
                                    }

                                    // Execute the query
                                    $query = mysqli_query($conn, $query_string);

                                    if (!$query) {
                                        // Handle the query error
                                        echo "Error fetching data: " . mysqli_error($conn);
                                    } else {
                                        $row = $query->fetch_assoc(); // Use $query instead of $result
                                        $tClients = $row['amountIn'] ?? 0; // Handle null case
                                    
                                        echo '<h1>' . number_format($tClients, 0, '.', ',') . '</h1>';

                                        $query->free(); // Free the query result
                                    }

                                    $conn->close();
                                    ?>
                            </div>
                           
                        </div>

                    </div>
                    <!-- <small class="tex">Last 7 Days</small> -->
                </div>
                
                
            </div><br><br>

            <table id="shipmentTable3" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Partner</th>
                                <th>Type</th>
                                <th>Product</th>
                                <!--<th>Qty</th>-->
                                <!--<th>Amount</th>-->
                                <th>Client</th>
                                <th>Location</th>
                                <th>Captain</th>
                                <th>Contact</th>
                                <!--<th>Payment Method</th>-->
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                            <?php
                            require '../config.php';

                             // Initialize variables for the date range
                        $start_date = isset($_POST['start-date']) ? $_POST['start-date'] : null;
                        $end_date = isset($_POST['end-date']) ? $_POST['end-date'] : null;

                        // Create a query to sum different columns: rQuantity, bQuantity, and quantity
                        $query_string ="SELECT id, partner, shipmentType, product, availableUnit, quantity, unitPrice, amount, customersName, destination, customerContact, captain, paymentMethod, date 
                        FROM gbigbe 
                        WHERE shipmentType = 'waybill'";

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
                                <td><?php echo $partner; ?></td>
                                <td><?php echo $shipmentType; ?></td>
                                <td><?php echo $product; ?></td>
                                <!--<td><?php echo $quantity; ?></td>-->
                                <!--<td><?php echo $amount; ?></td>-->
                                <td><?php echo $customersName; ?></td>
                                <td><?php echo $destination; ?></td>
                                <td><?php echo $captain; ?></td>
                                <td><?php echo $customerContact; ?></td>
                                <!--<td><?php echo $paymentMethod; ?></td>-->
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
                    <span id="light-mode-icon" class="material-icons-sharp active">light_mode</span>
                    <span id="dark-mode-icon" class="material-icons-sharp">dark_mode</span>
                </div>
                <div class="profile">
                    <div class="info">
                        <p> <b></b></p>
                        <!-- <small class="text-muted">Admin</small> -->
                    </div>
                </div>

            </div>

        </div>
    </div>

    <script src="../script/scrip.js"></script>
</body>

</html>