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

                <a href="records.php">
                    <span class="material-icons-sharp">local_shipping</span>
                    <h3>Shipments</h3>
                </a>

                <a href="oroowo.php">
                    <span class="material-icons-sharp">history</span>
                    <h3>Payment History</h3>
                </a>

                <a href="iranse.php">
                    <span class="material-icons-sharp">garage</span>
                    <h3>Waybill</h3>
                </a>


                <a href="owoofe.php">
                    <span class="material-icons-sharp">paid</span>
                    <h3>Other Income</h3>
                </a>

                <a href="inawo.php">
                    <span class="material-icons-sharp">payments</span>
                    <h3>Expenses</h3>
                </a>

                <a href="iroyinowo.php" class="active">
                    <span class="material-icons-sharp">payments</span>
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
                            <h3>Delivery</h3>
                            <div>
                                    <?php
                                    require '../config.php';

                                    // Initialize variables for the date range and sanitize inputs
                                    $start_date = isset($_POST['start-date']) ? mysqli_real_escape_string($conn, $_POST['start-date']) : null;
                                    $end_date = isset($_POST['end-date']) ? mysqli_real_escape_string($conn, $_POST['end-date']) : null;

                                    // Base query
                                    $query_string = "SELECT SUM(profitReward) AS amountIn
                                    FROM gbigbe
                                    WHERE shipmentType = 'Delivery'
                                    AND status = 'Completed'";

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

                <div class="income">
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
                                    $query_string = "SELECT SUM(profitReward) AS amountIn
                                    FROM gbigbe
                                    WHERE shipmentType = 'Waybill'
                                    AND status = 'Completed'";

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
                    <!-- <small class="text-muted">Last 7 Days</small> -->
                </div>

                <div class="expensis">
                    <div class="middle">
                        <div class="left">
                            <h3>Other Income</h3>
                            <div>
                                   <?php
                                        require '../config.php';

                                        // Initialize variables for the date range and sanitize inputs
                                        $start_date = isset($_POST['start-date']) ? mysqli_real_escape_string($conn, $_POST['start-date']) : null;
                                        $end_date = isset($_POST['end-date']) ? mysqli_real_escape_string($conn, $_POST['end-date']) : null;

                                        // Base query
                                        $query_string = "SELECT SUM(amount) AS amountIn FROM others_gifts";

                                        // Check if date range is provided and append a condition using WHERE
                                        if ($start_date && $end_date) {
                                            $query_string .= " WHERE date BETWEEN '$start_date' AND '$end_date'";
                                        }

                                        // Execute the query
                                        $query = mysqli_query($conn, $query_string);

                                        if (!$query) {
                                            // Handle the query error
                                            echo "Error fetching data: " . mysqli_error($conn);
                                        } else {
                                            $row = $query->fetch_assoc(); // Fetch the query result
                                            $tClients = $row['amountIn'] ?? 0; // Handle null case (e.g., no results)
                                            
                                            echo '<h1>' . number_format($tClients, 0, '.', ',') . '</h1>';

                                            $query->free(); // Free the query result
                                        }

                                        $conn->close();
                                    ?>

                            </div>
                        </div>

                    </div>
                    <!-- <small class="text-muted">Last 7 Days</small> -->
                </div>

                <div class="income">
                    <div class="middle">
                        <div class="left">
                            <h3>Partner Payment</h3>
                            <div>
                                    <?php
                                    require '../config.php';

                                    // Initialize variables for the date range and sanitize inputs
                                    $start_date = isset($_POST['start-date']) ? mysqli_real_escape_string($conn, $_POST['start-date']) : null;
                                    $end_date = isset($_POST['end-date']) ? mysqli_real_escape_string($conn, $_POST['end-date']) : null;

                                    // Base query
                                    $query_string = "SELECT SUM(partnerReward) AS amountIn
                                    FROM gbigbe
                                    WHERE status = 'Completed'";

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
                    <!-- <small class="text-muted">Last 7 Days</small> -->
                </div>
                <!-- ================================== -->

                <div class="expensis">
                    <div class="middle">
                        <div class="left">
                            <h3>Captains</h3>
                            <div>
                                    <?php
                                    require '../config.php';

                                    // Initialize variables for the date range and sanitize inputs
                                    $start_date = isset($_POST['start-date']) ? mysqli_real_escape_string($conn, $_POST['start-date']) : null;
                                    $end_date = isset($_POST['end-date']) ? mysqli_real_escape_string($conn, $_POST['end-date']) : null;

                                    // Base query
                                    $query_string = "SELECT SUM(riderReward) AS amountIn
                                    FROM gbigbe
                                    WHERE status = 'Completed'";

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
                    <!-- <small class="text-muted">Last 7 Days</small> -->
                </div>

                <div class="expensis">
                    <div class="middle">
                        <div class="left">
                            <h3>Expenses</h3>
                            <div>
                                   <?php
                                        require '../config.php';

                                        // Initialize variables for the date range and sanitize inputs
                                        $start_date = isset($_POST['start-date']) ? mysqli_real_escape_string($conn, $_POST['start-date']) : null;
                                        $end_date = isset($_POST['end-date']) ? mysqli_real_escape_string($conn, $_POST['end-date']) : null;

                                        // Base query
                                        $query_string = "SELECT SUM(amount) AS amountIn FROM inawo";

                                        // Check if date range is provided and append a condition using WHERE
                                        if ($start_date && $end_date) {
                                            $query_string .= " WHERE date BETWEEN '$start_date' AND '$end_date'";
                                        }

                                        // Execute the query
                                        $query = mysqli_query($conn, $query_string);

                                        if (!$query) {
                                            // Handle the query error
                                            echo "Error fetching data: " . mysqli_error($conn);
                                        } else {
                                            $row = $query->fetch_assoc(); // Fetch the query result
                                            $expen = $row['amountIn'] ?? 0; // Handle null case (e.g., no results)
                                            
                                            echo '<h1>' . number_format($expen, 0, '.', ',') . '</h1>';

                                            $query->free(); // Free the query result
                                        }

                                        $conn->close();
                                    ?>

                            </div>
                        </div>

                    </div>
                    <!-- <small class="text-muted">Last 7 Days</small> -->
                </div>

                <div class="sales">
                    <div class="middle">
                        <div class="left">
                            <h3>Gross Profit</h3>
                            <div>
                                <?php
                                    require '../config.php';

                                    // Initialize variables for the date range and sanitize inputs
                                    $start_date = isset($_POST['start-date']) ? mysqli_real_escape_string($conn, $_POST['start-date']) : null;
                                    $end_date = isset($_POST['end-date']) ? mysqli_real_escape_string($conn, $_POST['end-date']) : null;

                                    // Base query
                                    $query_string = "SELECT SUM(profitReward) AS amountIn
                                    FROM gbigbe
                                    WHERE status = 'Completed'";

                                    // Check if date range is provided and append a condition using AND
                                    if ($start_date && $end_date) {
                                        $query_string .= " AND date BETWEEN '$start_date' AND '$end_date'";
                                    }
                                    // ===============================
                                    $query_string1 = "SELECT SUM(amount) AS other
                                    FROM others_gifts";

                                    // Check if date range is provided and append a condition using AND
                                    if ($start_date && $end_date) {
                                        $query_string1 .= " WHERE date BETWEEN '$start_date' AND '$end_date'";
                                    }   

                                    // Execute the query
                                    $query = mysqli_query($conn, $query_string);
                                    $query1 = mysqli_query($conn, $query_string1);

                                    if (!$query) {
                                        // Handle the query error
                                        echo "Error fetching data: " . mysqli_error($conn);
                                    } else {
                                        $row = $query->fetch_assoc(); // Use $query instead of $result
                                        $tClients = $row['amountIn'] ?? 0; // Handle null case
                                    
                                        // echo '<h1>' . number_format($tClients, 0, '.', ',') . '</h1>';

                                        $query->free(); // Free the query result
                                    }

                                    if (!$query1) {
                                        // Handle the query1 error
                                        echo "Error fetching data: " . mysqli_error($conn);
                                    } else {
                                        $row = $query1->fetch_assoc(); // Use $query1 instead of $result
                                        $others = $row['other'] ?? 0; // Handle null case
                                    
                                        // echo '<h1>' . number_format($others, 0, '.', ',') . '</h1>';

                                        $query1->free(); // Free the query1 result
                                    }
                                    $totalRevenue = $tClients + $others;
                                    echo '<h1>' . number_format($totalRevenue, 0, '.', ',') . '</h1>';

                                    $conn->close();
                                ?>
                            </div>
                        </div>

                    </div>
                    <!-- <small class="tex">Last 7 Days</small> -->
                </div>

                <div class="expensis">
                    <div class="middle">
                        <div class="left">
                            <h3>Net Profit</h3>
                            <div>
                                <?php
                                
                                $netPP = $totalRevenue - $expen;
                                echo '<h1>' . number_format($netPP, 0, '.', ',') . '</h1>';

                                
                                ?>
                            </div>
                        </div>

                    </div>
                    <!-- <small class="text-muted">Last 7 Days</small> -->
                </div>
            </div>

            <br><br>
            <div class="tab">
                <button class="tablinks" onclick="openTab(event, 'AllShipments')" id="defaultOpen">Deliveries</button>
                <button class="tablinks" onclick="openTab(event, 'UnprocessedShipments')">Waybills</button>
                <button class="tablinks" onclick="openTab(event, 'ProcessedShipments')">Other Income</button>
                <button class="tablinks" onclick="openTab(event, 'partnerPayment')">Expenses</button>
            </div>

            <!-- delivery -->
            <div id="AllShipments" class="tab-content">
                <div class="recent-sales"><br>
                    <h2>Deliveries</h2><br>

                    <table id="shipmentTable3" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Partner</th>
                                <th>Product</th>
                                <!--<th>Qty</th>-->
                                <th>Amount</th>
                                <th>Client</th>
                                <th>Location</th>
                                <th>Captain</th>
                                <th>Contact</th>
                                <th>Payment Method</th>
                                <th>Partner Pay</th>
                                <th>Rider Reward</th>
                                <th>Profit Reward</th>
                                <th>Created By</th>
                                <th>Edited By</th>
                                <th>Recalled By</th>
                                <th>Confirmed By</th>
                                
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
                        $query_string ="SELECT id, partner, shipmentType, product, availableUnit, quantity, unitPrice, amount, customersName, destination, 
                                                partnerReward, riderReward, profitReward, customerContact, captain, paymentMethod, date, createdBy, editedBy, recalledBy, confirmedBy 
                        FROM gbigbe 
                        WHERE shipmentType = 'delivery'
                        AND status = 'completed'";

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
                                    $partnerReward = $row['partnerReward'];
                                    $riderReward = $row['riderReward'];
                                    $profitReward = $row['profitReward'];
                                    $date = $row['date'];
                                    $createdBy = $row['createdBy'];
                                    $editedBy = $row['editedBy'];
                                    $recalledBy = $row['recalledBy'];
                                    $confirmedBy = $row['confirmedBy'];
                                    ?>
                            <tr>
                                <td><?php echo $serialNumber; ?></td> <!-- Display the serial number -->
                                <td><?php echo $partner; ?></td>
                                <td><?php echo $product; ?></td>
                                <!--<td><?php echo $quantity; ?></td>-->
                                <td><?php echo $amount; ?></td>
                                <td><?php echo $customersName; ?></td>
                                <td><?php echo $destination; ?></td>
                                <td><?php echo $captain; ?></td>
                                <td><?php echo $customerContact; ?></td>
                                <td><?php echo $paymentMethod; ?></td>
                                <td><?php echo $partnerReward; ?></td>
                                <td><?php echo $riderReward; ?></td>
                                <td><?php echo $profitReward; ?></td>
                                <td><?php echo $createdBy; ?></td>
                                <td><?php echo $editedBy; ?></td>
                                <td><?php echo $recalledBy; ?></td>
                                <td><?php echo $confirmedBy; ?></td>
                                <td><?php echo $date; ?></td>
                            </tr>
                            <?php
                                    $serialNumber++; // Increment the serial number
                                }
                            }
                            ?>
                        </tbody>

                    </table>
                </div>
            </div><br><br>

            <!-- waybill -->
            <div id="UnprocessedShipments" class="tab-content">
                <div class="recent-sales"><br>
                    <h2>Waybills</h2><br>

                    <table id="shipmentTable3" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Partner</th>
                                <th>Product</th>
                                <!--<th>Qty</th>-->
                                <th>Amount</th>
                                <th>Client</th>
                                <th>Location</th>
                                <th>Captain</th>
                                <th>Contact</th>
                                <th>Payment Method</th>
                                <th>Partner Pay</th>
                                <th>Rider Reward</th>
                                <th>Profit Reward</th>
                                <th>Created By</th>
                                <th>Edited By</th>
                                <th>Recalled By</th>
                                <th>Confirmed By</th>
                                
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
                        $query_string ="SELECT id, partner, shipmentType, product, availableUnit, quantity, unitPrice, amount, customersName, destination, 
                                                partnerReward, riderReward, profitReward, customerContact, captain, paymentMethod, date, createdBy, editedBy, recalledBy, confirmedBy 
                        FROM gbigbe 
                        WHERE shipmentType = 'waybill'
                        AND status = 'completed'";

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
                                    $partnerReward = $row['partnerReward'];
                                    $riderReward = $row['riderReward'];
                                    $profitReward = $row['profitReward'];
                                    $date = $row['date'];
                                    $createdBy = $row['createdBy'];
                                    $editedBy = $row['editedBy'];
                                    $recalledBy = $row['recalledBy'];
                                    $confirmedBy = $row['confirmedBy'];
                                    ?>
                            <tr>
                                <td><?php echo $serialNumber; ?></td> <!-- Display the serial number -->
                                <td><?php echo $partner; ?></td>
                                <td><?php echo $product; ?></td>
                                <!--<td><?php echo $quantity; ?></td>-->
                                <td><?php echo $amount; ?></td>
                                <td><?php echo $customersName; ?></td>
                                <td><?php echo $destination; ?></td>
                                <td><?php echo $captain; ?></td>
                                <td><?php echo $customerContact; ?></td>
                                <td><?php echo $paymentMethod; ?></td>
                                <td><?php echo $partnerReward; ?></td>
                                <td><?php echo $riderReward; ?></td>
                                <td><?php echo $profitReward; ?></td>
                                <td><?php echo $createdBy; ?></td>
                                <td><?php echo $editedBy; ?></td>
                                <td><?php echo $recalledBy; ?></td>
                                <td><?php echo $confirmedBy; ?></td>
                                <td><?php echo $date; ?></td>
                            </tr>
                            <?php
                                    $serialNumber++; // Increment the serial number
                                }
                            }
                            ?>
                        </tbody>

                    </table>
                </div>
            </div><br><br>

            <!-- other income -->
            <div id="ProcessedShipments" class="tab-content">
                <div class="recent-sales">
                    <div class="spacer"></div>
                    <h2>Other income</h2>
                    <table id="shipmentTable" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>From</th>
                            <th>Amount</th>
                            <th>Purpose</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <?php
                        require '../config.php';

                        // Initialize variables for the date range and sanitize inputs
                        $start_date = isset($_POST['start-date']) ? mysqli_real_escape_string($conn, $_POST['start-date']) : null;
                        $end_date = isset($_POST['end-date']) ? mysqli_real_escape_string($conn, $_POST['end-date']) : null;

                        // Base query
                        $query_string = "SELECT id, fromW, amount, purpose, date  
                        FROM others_gifts";
                        // Check if date range is provided and add a WHERE clause if necessary
                        if ($start_date && $end_date) {
                            $query_string .= " WHERE date BETWEEN '$start_date' AND '$end_date'";
                        }

                        // Order the results by id in descending order
                        $query_string .= " ORDER BY id DESC";

                        // Execute the query
                        $query = mysqli_query($conn, $query_string);

                        if (!$query) {
                            // Handle the query error
                            echo "Error fetching data: " . mysqli_error($conn);
                        } else {
                            // Initialize a serial number
                            $serialNumber = 1;

                        while ($row = mysqli_fetch_array($query)) {
                            $fromW = $row['fromW'];
                            $amount = $row['amount'];
                            $purpose = $row['purpose'];
                            $date = $row['date'];
                            ?>
                            <tr>
                                <td><?php echo $serialNumber; ?></td>
                                <td><?php echo $fromW; ?></td>
                                <td><?php echo $amount; ?></td>
                                <td><?php echo $purpose; ?></td>
                                <td><?php echo $date; ?></td>
                            </tr>
                                <?php
                                   $serialNumber++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
                </div>
            </div><br><br>

            <div id="partnerPayment" class="tab-content">
                <div class="recent-sales">
                    <div class="spacer"></div>
                    <h2>Expenses</h2>
                    <table id="shipmentTable" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Name</th>
                            <th>Purpose</th>
                            <th>Amount</th>
                            <th>Approved By</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
    <?php
                        require '../config.php';

                        // Initialize variables for the date range and sanitize inputs
                        $start_date = isset($_POST['start-date']) ? mysqli_real_escape_string($conn, $_POST['start-date']) : null;
                        $end_date = isset($_POST['end-date']) ? mysqli_real_escape_string($conn, $_POST['end-date']) : null;

                        // Base query
                        $query_string = "SELECT id, name, purpose, amount, approvedBy, date 
                        FROM inawo";

                        // Check if date range is provided and add a WHERE clause if necessary
                        if ($start_date && $end_date) {
                            $query_string .= " WHERE date BETWEEN '$start_date' AND '$end_date'";
                        }

                        // Order the results by id in descending order
                        $query_string .= " ORDER BY id DESC";

                        // Execute the query
                        $query = mysqli_query($conn, $query_string);

                        if (!$query) {
                            // Handle the query error
                            echo "Error fetching data: " . mysqli_error($conn);
                        } else {
                            // Initialize a serial number
                            $serialNumber = 1;

                            // Fetch and display the results
                            while ($row = mysqli_fetch_array($query)) {
                                $name = $row['name'];
                                $purpose = $row['purpose'];
                                $amount = $row['amount'];
                                $approvedBy = $row['approvedBy'];
                                $date = $row['date'];
                                ?>
                                <tr>
                                    <td><?php echo $serialNumber; ?></td>
                                    <td><?php echo $name; ?></td>
                                    <td><?php echo $purpose; ?></td>
                                    <td><?php echo $amount; ?></td>
                                    <td><?php echo $approvedBy; ?></td>
                                    <td><?php echo $date; ?></td>
                                </tr>
                                <?php
                                $serialNumber++;
                            }
                        }
                        ?>
                    </tbody>

                </table>
                </div><br><br>
            </div>

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

            <?php
            if ($_SESSION['userType'] == "Admin") {
                echo "<div class='navbar'>";
                echo "<a href='../okojooja' class='nav-button'>I</a>";
                echo "<a href='../titesi' class='nav-button'>D</a>";
                echo "<a href='../onisiro' class='nav-button'>A</a>";
                echo "<a href='../abojuto' class='nav-button'>AD</a>";
                echo "</div>";
            }
            ?>
        </div>
    </div>

    <script src="../script/scrip.js"></script>
</body>

</html>
<script>
// Function to open a tab
function openTab(evt, tabName) {
    var i, tabcontent, tablinks;

    // Hide all tab contents
    tabcontent = document.getElementsByClassName("tab-content");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Remove the active class from all tab links
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab content and add the active class to the clicked tab
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";

    // Store the current tab name in localStorage
    localStorage.setItem('activeTab', tabName);
}

// Function to load the last opened tab
function loadLastOpenedTab() {
    var activeTab = localStorage.getItem('activeTab');

    if (activeTab) {
        // If there's a stored tab, open it
        document.getElementById(activeTab).style.display = "block";
        document.querySelector('.tablinks[onclick*="' + activeTab + '"]').className += " active";
    } else {
        // If no tab is stored, open the default tab
        document.getElementById("defaultOpen").click();
    }
}

// Call the loadLastOpenedTab function on page load
window.onload = loadLastOpenedTab;
</script>