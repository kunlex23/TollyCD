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
   

    table,
    th,
    td {
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

                <a href="records.php" class="active">
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

                <a href="../logout.php">
                    <span class="material-icons-sharp">logout</span>
                    <h3>Logout</h3>
                </a>
            </div>
        </aside>
        <!------------ END OF ASIDE ------------>
        <main>
            <!-- Tab navigation -->
            <div class="tab">
                <button class="tablinks" onclick="openTab(event, 'AllShipments')" id="defaultOpen">All
                    Shipments</button>
                <button class="tablinks" onclick="openTab(event, 'UnprocessedShipments')">Unconfirmed</button>
                <button class="tablinks" onclick="openTab(event, 'ProcessedShipments')">Confirmed</button>
                <button class="tablinks" onclick="openTab(event, 'partnerPayment')">Partner Payment</button>
                <button class="tablinks" onclick="openTab(event, 'partnerPayment_M')">Partner Remitting(M)</button>
                <button class="tablinks" onclick="openTab(event, 'partnerPayment_M2')">Partner Remitting(W)</button>
                <button class="tablinks" onclick="openTab(event, 'partnerPayment_W')">Partner Payment(W)</button>
                <button class="tablinks" onclick="openTab(event, 'riderPayment')">Captain Payment</button>
            </div>

            <!-- All Shipments content -->
            <div id="AllShipments" class="tab-content">
                <div class="recent-sales">
                    <div class="spacer"></div>
                    <h2>All Shipments</h2>

                    <input type="text" id="filterInput" placeholder="Search for shipment..." onkeyup="filterTable()">
                    <table id="shipmentTable" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Partner</th>
                                <th>Type</th>
                                <th>Product</th>
                                <th>Qty</th>
                                <th>Amount</th>
                                <th>Client</th>
                                <th>Location</th>
                                <th>Contact</th>
                                <th>Captain</th>
                                <th>Payment Method</th>
                                <th>Date</th>
                                <th>Recall</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                            <?php
                            require '../config.php';

                            $query = mysqli_query($conn, "SELECT id, partner, shipmentType, product, availableUnit, quantity, unitPrice, amount, customersName, destination, customerContact, captain, paymentMethod, date 
                            FROM gbigbe 
                            WHERE status = 'Completed' 
                            ORDER BY partner DESC");

                            if (!$query) {
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
                                <td><?php echo $quantity; ?></td>
                                <td><?php echo $amount; ?></td>
                                <td><?php echo $customersName; ?></td>
                                <td><?php echo $destination; ?></td>
                                <td><?php echo $customerContact; ?></td>
                                <td><?php echo $captain; ?></td>
                                <td><?php echo $paymentMethod; ?></td>
                                <td><?php echo $date; ?></td>
                                <td><button onclick="recaller(<?php echo $id; ?>)"
                                        style="padding:0.5rem; background-color: red; border-radius:0.4rem;"><b>Recall</b></button>
                                </td>
                            </tr>
                            <?php
                                    $serialNumber++; // Increment the serial number
                                }
                            }
                            ?>
                        </tbody>

                    </table>
                </div>
            </div>

            <!-- Unprocessed Shipments content -->
            <div id="UnprocessedShipments" class="tab-content">
                <div class="recent-sales">
                    <div class="spacer"></div>
                    <h2>Unconfirmed Shipments</h2>

                    <table id="shipmentTable" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Partner</th>
                                <th>Type</th>
                                <th>Product</th>
                                <th>Qty</th>
                                <th>Amount</th>
                                <th>Client</th>
                                <th>Location</th>
                                <th>Captain</th>
                                <th>Payment Method</th>
                                <th>Date</th>
                                <th></th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                            <?php
                            require '../config.php';

                            $query = mysqli_query($conn, "SELECT id, partner, shipmentType, product, availableUnit, quantity, unitPrice, amount, 
                            customersName, destination, customerContact, captain, paymentMethod, remitanceKind, date 
                            FROM gbigbe 
                            WHERE status = 'completed' 
                            AND accCaptain = 'rara' 
                            ORDER BY partner DESC");

                            if (!$query) {
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
                                    $remitanceKind = $row['remitanceKind'];
                                    ?>
                            <tr>
                                <td><?php echo $serialNumber; ?></td> <!-- Display the serial number -->
                                <td><?php echo $partner; ?></td>
                                <td><?php echo $shipmentType; ?></td>
                                <td><?php echo $product; ?></td>
                                <td><?php echo $quantity; ?></td>
                                <td><?php echo $amount; ?></td>
                                <td><?php echo $customersName; ?></td>
                                <td><?php echo $destination; ?></td>
                                <td><?php echo $captain; ?></td>
                                <td>
                                    <select class="paymentMethod-dropdown" data-id="<?php echo $id; ?>">
                                        <option value="" <?php if ($paymentMethod == '')
                                                    echo 'selected'; ?>>...</option>
                                        <option value="Transfer" <?php if ($paymentMethod == 'Transfer')
                                                    echo 'selected'; ?>>Transfer</option>
                                        <option value="POS" <?php if ($paymentMethod == 'POS')
                                                    echo 'selected'; ?>>POS</option>
                                        <option value="Cash" <?php if ($paymentMethod == 'Cash')
                                                    echo 'selected'; ?>>Cash</option>
                                        <option value="Cheque" <?php if ($paymentMethod == 'Cheque')
                                                    echo 'selected'; ?>>Cheque</option>
                                    </select>
                                </td>
                                <td><?php echo $date; ?></td>
                                <td>
                                    <select class="partner-dropdown" data-id="<?php echo $id; ?>">
                                        <option value="NORMs" <?php if ($remitanceKind == 'NORMs')
                                            echo 'selected'; ?>>Regular Method</option>
                                        <option value="M2TCD" <?php if ($remitanceKind == 'M2TCD')
                                            echo 'selected'; ?>>Partner remit monthly</option>
                                        <option value="WP2P" <?php if ($remitanceKind == 'WP2P')
                                            echo 'selected'; ?>>Weekly Payment to Partner</option>
                                    </select>
                                </td>
                                <td><button onclick="confirmShipment(<?php echo $id; ?>)"
                                        style="padding:0.5rem; background-color:  #7380ec; border-radius:0.4rem;"><b>Confirm</b></button>
                                </td>
                            </tr>
                            <?php
                                    $serialNumber++; // Increment the serial number
                                }
                            }
                            ?>
                        </tbody>

                    </table>
                </div>

            </div>

            <!-- Processed Shipments content -->
            <div id="ProcessedShipments" class="tab-content">
                <div class="recent-sales">
                    <div class="spacer"></div>
                    <h2>Confirmed Shipments</h2>

                    <table id="shipmentTable" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Partner</th>
                                <th>Type</th>
                                <th>Product</th>
                                <th>Qty</th>
                                <th>Amount</th>
                                <th>Client</th>
                                <th>Location</th>
                                <th>Captain</th>
                                <th>Payment Method</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                            <?php
                            require '../config.php';

                            $query = mysqli_query($conn, "SELECT id, partner, shipmentType, product, availableUnit, quantity, unitPrice, amount, customersName, destination, customerContact, captain, paymentMethod, date FROM gbigbe WHERE status = 'completed' AND accCaptain = 'beni' ORDER BY partner DESC");

                            if (!$query) {
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
                                <td><?php echo $quantity; ?></td>
                                <td><?php echo $amount; ?></td>
                                <td><?php echo $customersName; ?></td>
                                <td><?php echo $destination; ?></td>
                                <td><?php echo $captain; ?></td>
                                <td><?php echo $paymentMethod; ?></td>
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
            </div>

            <div id="partnerPayment" class="tab-content">
                <div class="recent-sales">
                    <div class="spacer"></div>
                    <h2>Partner Payment</h2>

                    <!-- <input type="text" id="filterInput" placeholder="Search for shipment..." onkeyup="filterTable()"> -->
                    <table id="shipmentTable" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Partner</th>
                                <th>Total Amount</th>
                                <th>Account Number</th>
                                <th>Bank</th>
                                <th>Account Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                            <?php
                            require '../config.php';

                            $query = mysqli_query($conn, "SELECT DISTINCT partner 
                            FROM gbigbe 
                            WHERE shipmentType = 'Delivery' 
                            AND status = 'completed' 
                            AND remitanceKind = 'NORMs'
                            AND partnerPayStatus = 'rara'  
                            AND accCaptain = 'beni' 

                            ORDER BY partner DESC");

                            if (!$query) {
                                echo "Error fetching data: " . mysqli_error($conn);
                            } else {
                                $serialNumber = 1; // Initialize the serial number outside the while loop
                            
                                while ($row = mysqli_fetch_array($query)) {
                                    $partner = $row['partner'];

                                    // Query to calculate total partner reward
                                    $sqla = "SELECT SUM(partnerReward) AS totalReward 
                                    FROM gbigbe 
                                    WHERE shipmentType='Delivery'
                                    AND status = 'completed'
                                    AND remitanceKind = 'NORMs'
                                    AND partner = '$partner'  
                                    AND accCaptain = 'beni' 
                                    AND partnerPayStatus = 'rara'";

                                    $resulta = mysqli_query($conn, $sqla);
                                    $rowa = mysqli_fetch_array($resulta);
                                    $partnerReward = $rowa['totalReward'];

                                    // Query to fetch account details
                                    $query2 = "SELECT accountNumber, bank, accountName FROM alabasepo WHERE Name = '$partner'";
                                    $result2 = mysqli_query($conn, $query2);
                                    $row2 = mysqli_fetch_array($result2);

                                    $accountNumber = $row2['accountNumber'];
                                    $bank = $row2['bank'];
                                    $accountName = $row2['accountName'];
                                    ?>
                            <tr>
                                <td><?php echo $serialNumber; ?></td> <!-- Display the serial number -->
                                <td><?php echo $partner; ?></td>
                                <td><?php echo $partnerReward; ?></td>
                                <td><?php echo $accountNumber; ?></td>
                                <td><?php echo $bank; ?></td>
                                <td><?php echo $accountName; ?></td>
                                <td><a href="wiwoIro.php?partner=<?php echo urlencode($partner); ?>">Details</a></td>
                                <!-- <td><a href="save_payment.php?partner=<?php echo urlencode($partner); ?>&totalAmount=<?php echo urlencode($partnerReward); ?>&accountNumber=<?php echo urlencode($accountNumber); ?>&bank=<?php echo urlencode($bank); ?>&accountName=<?php echo urlencode($accountName); ?>">Make Payment</a></td> -->
                            </tr>
                            <?php
                                    $serialNumber++; // Increment the serial number
                                }
                            }
                            ?>
                        </tbody>

                    </table>

                </div>
            </div>
            
            <div id="partnerPayment_M" class="tab-content">
                <div class="recent-sales">
                    <div class="spacer"></div>
                    <h2>Partner Monthly Remittance </h2>

                    <!-- <input type="text" id="filterInput" placeholder="Search for shipment..." onkeyup="filterTable()"> -->

                    <table id="shipmentTable" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Partner</th>
                                <th>Total Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                            <?php
                            require '../config.php';

                            $query = mysqli_query($conn, "SELECT DISTINCT partner 
                                FROM gbigbe 
                                WHERE shipmentType='Delivery'
                                AND remitanceKind = 'M2TCD'
                                AND partnerRemitance = 'rara'
                                AND status = 'completed' 
                                AND accCaptain = 'beni' 
                                AND partnerPayStatus = 'rara'");

                            if (!$query) {
                                echo "Error fetching data: " . mysqli_error($conn);
                            } else {
                                $serialNumber = 1; // Initialize the serial number outside the while loop
                            
                                while ($row = mysqli_fetch_array($query)) {
                                    $partner = $row['partner'];

                                    // Query to calculate total partner reward
                                    $sqla = "SELECT SUM(deliveryFee) AS totalReward 
                                    FROM gbigbe 
                                    WHERE shipmentType='Delivery'
                                    AND remitanceKind = 'M2TCD'
                                    AND status = 'completed' 
                                    AND partner = '$partner' 
                                    AND accCaptain = 'beni' 
                                    AND partnerPayStatus = 'rara'";

                                    $resulta = mysqli_query($conn, $sqla);
                                    $rowa = mysqli_fetch_array($resulta);
                                    $remitance2US = $rowa['totalReward'];

                                    
                                    ?>
                                    <tr>
                                        <td><?php echo $serialNumber; ?></td> <!-- Display the serial number -->
                                        <td><?php echo $partner; ?></td>
                                        <td><?php echo $remitance2US; ?></td>
                                        <td><a href="wiwoIrokeji.php?partner=<?php echo urlencode($partner); ?>">Details</a></td>
                                        
                                    </tr>
                                    <?php
                                    $serialNumber++; // Increment the serial number
                                }
                            }
                            ?>
                        </tbody>
                    
                    </table>


                </div>
            </div>

            <div id="partnerPayment_M2" class="tab-content">
                <div class="recent-sales">
                    <div class="spacer"></div>
                    <h2>Partner Monthly Remittance (Weekly Payments) </h2>

                    <!-- <input type="text" id="filterInput" placeholder="Search for shipment..." onkeyup="filterTable()"> -->

                    <table id="shipmentTable" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Partner</th>
                                <th>Total Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                            <?php
                            require '../config.php';

                            $query = mysqli_query($conn, "SELECT DISTINCT partner 
                                FROM gbigbe 
                                WHERE shipmentType='Delivery'
                                AND remitanceKind = 'WP2P'
                                AND partnerRemitance = 'rara'
                                AND status = 'completed' 
                                AND accCaptain = 'beni' 
                                AND partnerPayStatus = 'rara'");

                            if (!$query) {
                                echo "Error fetching data: " . mysqli_error($conn);
                            } else {
                                $serialNumber = 1; // Initialize the serial number outside the while loop
                            
                                while ($row = mysqli_fetch_array($query)) {
                                    $partner = $row['partner'];

                                    // Query to calculate total partner reward
                                    $sqla = "SELECT SUM(deliveryFee) AS totalReward 
                                    FROM gbigbe 
                                    WHERE shipmentType='Delivery'
                                    AND remitanceKind = 'WP2P'
                                    AND partnerRemitance = 'rara'
                                    AND partner = '$partner'
                                    AND status = 'completed' 
                                    AND accCaptain = 'beni' 
                                    AND partnerPayStatus = 'rara'";

                                    $resulta = mysqli_query($conn, $sqla);
                                    $rowa = mysqli_fetch_array($resulta);
                                    $remitance2US = $rowa['totalReward'];

                                    
                                    ?>
                                    <tr>
                                        <td><?php echo $serialNumber; ?></td> <!-- Display the serial number -->
                                        <td><?php echo $partner; ?></td>
                                        <td><?php echo $remitance2US; ?></td>
                                        <td><a href="wiwoIroket.php?partner=<?php echo urlencode($partner); ?>">Details</a></td>
                                        
                                    </tr>
                                    <?php
                                    $serialNumber++; // Increment the serial number
                                }
                            }
                            ?>
                        </tbody>
                    
                    </table>


                </div>
            </div>

            <div id="partnerPayment_W" class="tab-content">
                <div class="recent-sales">
                    <div class="spacer"></div>
                    <h2>Partner Weekly Payment </h2>

                    <!-- <input type="text" id="filterInput" placeholder="Search for shipment..." onkeyup="filterTable()"> -->
                    <table id="shipmentTable" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Partner</th>
                                <th>Total Amount</th>
                                <th>Account Number</th>
                                <th>Bank</th>
                                <th>Account Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                            <?php
                                require '../config.php';

                                $query = mysqli_query($conn, "SELECT DISTINCT partner 
                                FROM gbigbe 
                                WHERE shipmentType = 'Delivery' 
                                AND status = 'completed' 
                                AND accCaptain = 'beni' 
                                AND remitanceKind = 'WP2P'
                                AND captainPayStatus = 'rara' 
                                ORDER BY partner DESC");

                                if (!$query) {
                                    echo "Error fetching data: " . mysqli_error($conn);
                                } else {
                                    $serialNumber = 1; // Initialize the serial number outside the while loop
                                
                                    while ($row = mysqli_fetch_array($query)) {
                                        $partner = $row['partner'];

                                        // Query to calculate total partner reward
                                        $sqla = "SELECT SUM(amount) AS totalReward 
                                        FROM gbigbe 
                                        WHERE shipmentType='Delivery' 
                                        AND partner = '$partner' 
                                        AND status = 'completed' 
                                        AND accCaptain = 'beni' 
                                        AND remitanceKind = 'WP2P'
                                        AND captainPayStatus = 'rara'";

                                        $resulta = mysqli_query($conn, $sqla);
                                        $rowa = mysqli_fetch_array($resulta);
                                        $partnerReward = $rowa['totalReward'];

                                        // Query to fetch account details
                                        $query2 = "SELECT accountNumber, bank, accountName FROM alabasepo WHERE Name = '$partner'";
                                        $result2 = mysqli_query($conn, $query2);
                                        $row2 = mysqli_fetch_array($result2);

                                        $accountNumber = $row2['accountNumber'];
                                        $bank = $row2['bank'];
                                        $accountName = $row2['accountName'];
                                        ?>
                                        <tr>
                                            <td><?php echo $serialNumber; ?></td> <!-- Display the serial number -->
                                            <td><?php echo $partner; ?></td>
                                            <td><?php echo $partnerReward; ?></td>
                                            <td><?php echo $accountNumber; ?></td>
                                            <td><?php echo $bank; ?></td>
                                            <td><?php echo $accountName; ?></td>
                                            <td><a href="wiwoIroketa.php?partner=<?php echo urlencode($partner); ?>">Details</a></td>
                                            
                                        </tr>
                                        <?php
                                        $serialNumber++; // Increment the serial number
                                    }
                                }
                                ?>
                            </tbody>
                    
                        </table>
                    
                </div>

            </div>

            <div id="riderPayment" class="tab-content">
                <div class="recent-sales">
                    <div class="spacer"></div>
                    <h2>Captain Payment</h2>

                    <table id="shipmentTable" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Captain</th>
                                <th>Total Amount</th>
                                <th>Account Number</th>
                                <th>Bank</th>
                                <th>Account Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                            <?php
                            require '../config.php';

                            $query = mysqli_query($conn, "SELECT DISTINCT captain FROM gbigbe WHERE shipmentType='Delivery' AND status = 'completed' AND captainPayStatus = 'rara' ORDER BY captain DESC ");
                            if (!$query) {
                                echo "Error fetching data: " . mysqli_error($conn);
                            }else{
                                 $serialNumber = 1; // Initialize the serial number outside the while loop
                            while ($row = mysqli_fetch_array($query)) {
                                $captain = $row['captain'];

                                // Query to calculate total partner reward
                                $sqla = "SELECT SUM(riderReward) AS totalReward FROM gbigbe WHERE shipmentType='Delivery' AND captain = '$captain' AND status = 'completed' AND accCaptain = 'beni' AND captainPayStatus = 'rara'";
                                $resulta = mysqli_query($conn, $sqla);
                                $rowa = mysqli_fetch_array($resulta);
                                $riderReward = $rowa['totalReward'];

                                 // Query to fetch account details
                                $query2 = "SELECT accountNumber, bankName, accountName FROM oluwa WHERE fullname = '$captain'";
                                $result2 = mysqli_query($conn, $query2);
                                $row2 = mysqli_fetch_array($result2);

                                $accountNumber = $row2['accountNumber'];
                                $bank = $row2['bankName'];
                                $accountName = $row2['accountName'];
                                ?>
                            <tr>
                                <td><?php echo $serialNumber; ?></td> <!-- Display the serial number -->
                                <td><?php echo $captain; ?></td>
                                <td><?php echo $riderReward; ?></td>
                                <td><?php echo $accountNumber; ?></td>
                                <td><?php echo $bank; ?></td>
                                <td><?php echo $accountName; ?></td>
                                <td><a href="wiwoIroOlugbe.php?olugbe=<?php echo urlencode($captain); ?>">Details</a>
                                </td>

                            </tr>
                            <?php
                            $serialNumber++; // Increment the serial number
                                }
                            }?>
                        </tbody>
                    </table>
                </div>
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


        </div>
    </div>

    <script src="../script/scrip.js"></script>
</body>

</html>


<script>
function filterTable() {
    // Get the value of the input field
    let input = document.getElementById('filterInput');
    let filter = input.value.toUpperCase();

    // Get the table and its rows
    let table = document.getElementById('shipmentTable');
    let tr = table.getElementsByTagName('tr');

    // Loop through all table rows, except the first (header) row
    for (let i = 1; i < tr.length; i++) {
        // Get the first cell (product name) in the row
        let td = tr[i].getElementsByTagName('td')[1];
        if (td) {
            // Check if the product name contains the filter text
            let txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = '';
            } else {
                tr[i].style.display = 'none';
            }
        }
    }
}
</script>
<script>
document.querySelectorAll('.paymentMethod-dropdown').forEach(function(dropdown) {
    dropdown.addEventListener('change', function() {
        var shipmentId = this.getAttribute('data-id');
        var newPaymentMethod = this.value;

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'update_paymentMethod.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                alert('Payment method updated successfully.');
            }
        };
        xhr.send('id=' + shipmentId + '&paymentMethod=' + newPaymentMethod);
    });
});

document.querySelectorAll('.partner-dropdown').forEach(function(dropdown) {
    dropdown.addEventListener('change', function() {
        var shipmentId = this.getAttribute('data-id');
        var newremitanceKind = this.value;

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'remitanceKind.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                alert('Success.');
            }
        };
        xhr.send('id=' + shipmentId + '&remitanceKind=' + newremitanceKind);
    });
});
</script>

<script>
// Function to open a tab
function openTab(evt, tabName) {
    var i, tabcontent, tablinks;

    tabcontent = document.getElementsByClassName("tab-content");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
}

// Set default tab to be opened
document.getElementById("defaultOpen").click();
</script>
<script>
function confirmShipment(id) {
    if (confirm("Please confirm the data is correct before proceeding")) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'update_captain.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                alert('Shipment confirmed');
                // Reload the table data
                window.location.href = 'records.php';
            }
        };
        xhr.send('id=' + id);
    } else {
        alert("Shipment confirmation canceled.");
    }
}
</script>
<script>
function recaller(id) {
    if (confirm("Please confirm recalling before proceeding")) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'recall.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                alert('Shipment recalled');
                // Reload the table data
                window.location.href = 'records.php';
            }
        };
        xhr.send('id=' + id);
    } else {
        alert("Shipment recall canceled.");
    }
}
</script>