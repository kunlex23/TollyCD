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

                <a href="records.php">
                    <span class="material-icons-sharp">local_shipping</span>
                    <h3>Shipments</h3>
                </a>

                <a href="oroowo.php" class="active">
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
                <button class="tablinks" onclick="openTab(event, 'partnerPayments')" id="defaultOpen">Partner</button>
                <button class="tablinks" onclick="openTab(event, 'monthlyRemitance')">Partner Remitting(M)</button>
                <button class="tablinks" onclick="openTab(event, 'partnerPayment')">Partner Payment</button>
                <button class="tablinks" onclick="openTab(event, 'partnerPayment_M')">Partner Remitting(M)</button>
                <button class="tablinks" onclick="openTab(event, 'partnerPayment_M2')">Partner Remitting(M2)</button>
            </div>

            <!-- All Shipments content -->
            <div id="partnerPayments" class="tab-content">
                <div class="recent-sales">
                <div class="spacer"></div>
                <h2>Partner Payment History</h2>

                <!-- Date Range Form -->
                <div class="spacer"></div>
                <form method="post" action="">
                    <label for="start-date">Start Date:</label>
                    <input type="date" id="start-date" name="start-date" required>
                    <label for="end-date">End Date:</label>
                    <input type="date" id="end-date" name="end-date" required>
                    <button type="submit">Filter</button>
                </form>

                <div class="spacer"></div>
                <table style="width: 100%;">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Partner</th>
                            <th>Amount</th>
                            <th>Account Number</th>
                            <th>Bank</th>
                            <th>Account Name</th>
                            <th>Date</th>
                            <th>View</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <?php
                            require '../config.php';

                            // Initialize variables for the date range
                            $start_date = isset($_POST['start-date']) ? $_POST['start-date'] : null;
                            $end_date = isset($_POST['end-date']) ? $_POST['end-date'] : null;

                            // Debugging: Print the received dates
                            //echo "Start Date: $start_date, End Date: $end_date";
                            
                            // Build the query based on the date range
                            $query_string = "SELECT partner, totalAmount, accountNumber, bank, accountName, date, payID FROM owoalabasepohistory";
                            if ($start_date && $end_date) {
                                $query_string .= " WHERE date BETWEEN '$start_date' AND '$end_date'";
                            }
                            $query_string .= " ORDER BY partner DESC";

                            // Debugging: Print the query string
                            //echo $query_string;
                            
                            $query = mysqli_query($conn, $query_string);

                            if (!$query) {
                                // Debugging: Print the MySQL error
                                //echo "Error: " . mysqli_error($conn);
                            }
                        $serialNumber = 1;
                            while ($row = mysqli_fetch_array($query)) {
                                $partner = $row['partner'];
                                $totalAmount = $row['totalAmount'];
                                $accountNumber = $row['accountNumber'];
                                $bank = $row['bank'];
                                $accountName = $row['accountName'];
                                $date = $row['date'];
                                $payID = $row['payID'];
                                ?>
                                <tr>
                                    <td><?php echo $serialNumber; ?></td>
                                    <td><?php echo $partner; ?></td>
                                    <td><?php echo $totalAmount; ?></td>
                                    <td><?php echo $accountNumber; ?></td>
                                    <td><?php echo $bank; ?></td>
                                    <td><?php echo $accountName; ?></td>
                                    <td><?php echo $date; ?></td>
                                    <td><a
                                            href="eri.php?partner=<?php echo urlencode($partner); ?>&eri=<?php echo urlencode($payID); ?>">View</a>
                                    </td>
                                </tr>
                            <?php $serialNumber++; } ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Unprocessed Shipments content -->
            <div id="monthlyRemitance" class="tab-content">
                <div class="recent-sales">
                <div class="spacer"></div>
                <h2>Partner Monthly Remittance </h2>


                <!-- Date Range Form -->
                <div class="spacer"></div>
                <form method="post" action="">
                    <label for="start-date">Start Date:</label>
                    <input type="date" id="start-date" name="start-date" required>
                    <label for="end-date">End Date:</label>
                    <input type="date" id="end-date" name="end-date" required>
                    <button type="submit">Filter</button>
                </form>

                <div class="spacer"></div>
                <table style="width: 100%;">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Partner</th>
                            <th>Amount</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <?php
                            require '../config.php';

                            // Initialize variables for the date range
                            $start_date = isset($_POST['start-date']) ? $_POST['start-date'] : null;
                            $end_date = isset($_POST['end-date']) ? $_POST['end-date'] : null;

                            // Debugging: Print the received dates
                            //echo "Start Date: $start_date, End Date: $end_date";
                            
                            // Build the query based on the date range
                            $query1_string = "SELECT partner, totalAmount, date, payID
                            FROM owoalabasepowahistory";
                            if ($start_date && $end_date) {
                                $query1_string .= " WHERE date BETWEEN '$start_date' AND '$end_date'";
                            }
                            $query1_string .= " ORDER BY partner DESC";

                            // Debugging: Print the query1 string
                            //echo $query1_string;
                            
                            $query1 = mysqli_query($conn, $query1_string);

                            if (!$query1) {
                                // Debugging: Print the MySQL error
                                //echo "Error: " . mysqli_error($conn);
                            }
                        $serialNumber1 = 1;
                            while ($row = mysqli_fetch_array($query1)) {
                                $partner1 = $row['partner'];
                                $totalAmount = $row['totalAmount'];
                                $date = $row['date'];
                                $payID1 = $row['payID'];
                                ?>
                                <tr>
                                    <td><?php echo $serialNumber1; ?></td>
                                    <td><?php echo $partner1; ?></td>
                                    <td><?php echo $totalAmount; ?></td>
                                    <td><?php echo $date; ?></td>
                                    <td><a
                                            href="eria.php?partner=<?php echo urlencode($partner1); ?>&eri=<?php echo urlencode($payID1); ?>">View</a>
                                    </td>
                                </tr>
                            <?php $serialNumber1++; } ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Processed Shipments content -->
            <div id="ProcessedShipments" class="tab-content">
                
            </div>

            <div id="partnerPayment" class="tab-content">
                
            </div>

            <div id="partnerPayment_M" class="tab-content">
                
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
    document.querySelectorAll('.paymentMethod-dropdown').forEach(function (dropdown) {
        dropdown.addEventListener('change', function () {
            var shipmentId = this.getAttribute('data-id');
            var newPaymentMethod = this.value;

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'update_paymentMethod.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    alert('Payment method updated successfully.');
                }
            };
            xhr.send('id=' + shipmentId + '&paymentMethod=' + newPaymentMethod);
        });
    });

    document.querySelectorAll('.partner-dropdown').forEach(function (dropdown) {
        dropdown.addEventListener('change', function () {
            var shipmentId = this.getAttribute('data-id');
            var newremitanceKind = this.value;

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'remitanceKind.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
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
            xhr.onreadystatechange = function () {
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