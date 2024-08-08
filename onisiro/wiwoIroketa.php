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
    /* Tab styles */
    .tab {
        overflow: hidden;
        border-bottom: 1px solid #ccc;
        background-color: #f1f1f1;
    }

    .tab button {
        background-color: inherit;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        transition: 0.3s;
    }

    .tab button:hover {
        background-color: #ddd;
    }

    .tab button.active {
        background-color: #ccc;
    }

    .tab-content {
        display: none;
        padding: 6px 12px;
        border-top: none;
    }

    .tab-content.active {
        display: block;
    }

    table,
    th,
    td {
        /* border: 1px solid black; */
        /* border-collapse: collapse; */
        padding: 8px;
        text-align: left;
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

                <a href="records.php" class="active">
                    <span class="material-icons-sharp">local_shipping</span>
                    <h3>Shipments</h3>
                </a>

                <a href="sisanwo.php">
                    <span class="material-icons-sharp">history</span>
                    <h3>Partner Payment History</h3>
                </a>

                <a href="sisanwokeji.php">
                    <span class="material-icons-sharp">history</span>
                    <h3>Captain Payment History</h3>
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

                <a href="../logout.php">
                    <span class="material-icons-sharp">logout</span>
                    <h3>Logout</h3>
                </a>
            </div>
        </aside>
        <!------------ END OF ASIDE ------------>
        <main>
            <h2></h2><br>
            <div class="spacer"></div>
            <h2>Payment Details</h2><br>

            <!-- <input type="text" id="filterInput" placeholder="Search for shipment..." onkeyup="filterTable()"> -->
            <?php
            require '../config.php'; // Ensure the database connection is properly set up
            
            if (isset($_GET['partner'])) {
                $partner = mysqli_real_escape_string($conn, $_GET['partner']); // Sanitize input
            
                // Query to calculate total partner reward
                $sqla = "SELECT SUM(COALESCE(amount, 0)) AS totalReward 
             FROM gbigbe 
             WHERE shipmentType='Delivery' 
             AND partner = '$partner' 
             AND status = 'completed' 
             AND accCaptain = 'beni' 
             AND remitanceKind = 'WP2P'
             AND captainPayStatus = 'rara'";

                $resulta = mysqli_query($conn, $sqla);

                if ($resulta) {
                    $rowa = mysqli_fetch_array($resulta);
                    $partnerReward = $rowa['totalReward'] ?? 0; // Default to 0 if no result
            
                    // Query to fetch account details
                    $query2 = "SELECT accountNumber, bank, accountName 
                   FROM alabasepo 
                   WHERE Name = '$partner'";
                    $result2 = mysqli_query($conn, $query2);

                    if ($result2) {
                        $row2 = mysqli_fetch_array($result2);

                        $accountNumber = $row2['accountNumber'] ?? 'N/A'; // Default to 'N/A' if no result
                        $bank = $row2['bank'] ?? 'N/A'; // Default to 'N/A' if no result
                        $accountName = $row2['accountName'] ?? 'N/A'; // Default to 'N/A' if no result
                        ?>
            <div class="productDetails">
                <div class="itemPD">
                    Partner: <b><?php echo htmlspecialchars($partner); ?></b>
                </div>
                <div class="itemPD">
                    Total Amount: <b><?php echo htmlspecialchars(number_format($partnerReward, 2)); ?></b>
                </div>
                <div class="itemPD">
                    Account Number: <b><?php echo htmlspecialchars($accountNumber); ?></b>
                </div>
                <div class="itemPD">
                   Bank:  <b><?php echo htmlspecialchars($bank); ?></b>
                </div>
                <div class="itemPD">
                  Account Name:   <b><?php echo htmlspecialchars($accountName); ?></b>
                </div>
                <div class="payBTN">
                    <a
                        href="kagbokeji.php?partner=<?php echo urlencode($partner); ?>&totalAmount=<?php echo urlencode($partnerReward); ?>&accountNumber=<?php echo urlencode($accountNumber); ?>&bank=<?php echo urlencode($bank); ?>&accountName=<?php echo urlencode($accountName); ?>">Make
                        Payment</a>
                </div>
            </div>
            <?php
                    } else {
                        echo "Error fetching account details: " . mysqli_error($conn);
                    }
                } else {
                    echo "Error fetching partner reward: " . mysqli_error($conn);
                }
            } else {
                echo "No partner specified.";
            }
            ?>



            <!-- ========================================================================= -->
            <table id="shipmentTable" style="padding-left:5%; width: 90%;">
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Product</th>
                        <th>Location</th>
                        <th>Cost</th>
                        <th>Partners Pay</th>
                        <th>Delivery fee</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    <?php
                    require '../config.php'; // Ensure the database connection is properly set up
                    
                    if (isset($_GET['partner'])) {
                        $partner = mysqli_real_escape_string($conn, $_GET['partner']); // Sanitize input
                    
                        // Get data
                        $sqlb = "SELECT product, amount, destination, deliveryFee, partnerReward, date 
                        FROM gbigbe 
                        WHERE shipmentType='Delivery' 
                        AND partner = '$partner' 
                        AND status = 'completed' 
                        AND accCaptain = 'beni' 
                        AND remitanceKind = 'WP2P'
                        AND captainPayStatus = 'rara'";

                        $result = mysqli_query($conn, $sqlb); // Execute the query
                    
                        if ($result) {
                            $serialNumber = 1; // Initialize the serial number outside the while loop
                    
                            while ($row = mysqli_fetch_array($result)) { // Fetch the results
                                $product = $row['product'];
                                $amount = $row['amount'];
                                $destination = $row['destination'];
                                $deliveryFee = $row['deliveryFee'];
                                $partnerRew = $row['partnerReward'];
                                $date = $row['date'];
                                ?>
                    <tr>
                        <td><?php echo $serialNumber; ?></td> <!-- Display the serial number -->
                        <td><?php echo htmlspecialchars($product); ?></td>
                        <td><?php echo htmlspecialchars($destination); ?></td>
                        <td><?php echo htmlspecialchars($amount); ?></td>
                        <td><?php echo htmlspecialchars($partnerRew); ?></td>
                        <td><?php echo htmlspecialchars($deliveryFee); ?></td>
                        <td><?php echo htmlspecialchars($date); ?></td>
                    </tr>
                    <?php
                                $serialNumber++; // Increment the serial number
                            }
                        } else {
                            echo "Error fetching shipment data: " . mysqli_error($conn);
                        }
                    } else {
                        echo "No partner specified.";
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