`<?php
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

                <a href="oroowo.php">
                    <span class="material-icons-sharp">history</span>
                    <h3>Payment History</h3>
                </a>

                <a href="iranse.php" class="active">
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

            <h2>Waybills</h2><br>
            <div class="tab">
                <button class="tablinks" onclick="openTab(event, 'AllWaybills')" id="defaultOpen">Waybills</button>
                <button class="tablinks" onclick="openTab(event, 'UnprocessedWaybills')">Unconfirmed</button>
                <button class="tablinks" onclick="openTab(event, 'ProcessedWaybills')">Confirmed</button>
                <button class="tablinks" onclick="openTab(event, 'partnerPayment')">Partner Remittance</button>
                <button class="tablinks" onclick="openTab(event, 'agentPayment')">Agent Payments</button>
            </div>
            <!-- ---------END OF EXAM-------- -->
            <div id="AllWaybills" class="tab-content">
                <div class="recent-sales"><br>
                    <h2>All Waybill</h2>

                    <input type="text" id="filterInput" placeholder="Search for waybill by contact" onkeyup="filterTable()">
                    <table id="shipmentTable" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Partner</th>
                                <th>Contact</th>
                                <th>Destination</th>
                                <th>Products</th>
                                <th>Driver Price</th>
                                <th>Profit</th>
                                <th>Partner Price</th>
                                <th>Created By</th>
                                <th>Confirmed By</th>
                                <th>Date</th>

                            </tr>
                        </thead>
                        <tbody id="table-body">
                            <?php
                            require '../config.php';

                            $query = mysqli_query($conn, "SELECT id, partner,  product, availableUnit, quantity, unitPrice, riderReward, customersName, destination, customerContact, profitReward, status, deliveryFee, createdBy, confirmedBy, date  
                            FROM gbigbe 
                            WHERE shipmentType = 'Waybill'
                            ORDER BY partner DESC ");
                            $serialNumber = 1;
                            while ($row = mysqli_fetch_array($query)) {
                                $id = $row['id'];
                                $partner = $row['partner'];
                                $product = $row['product'];
                                $quantity = $row['quantity'];
                                $deliveryFee = $row['deliveryFee'];
                                $riderReward = $row['riderReward'];
                                $destination = $row['destination'];
                                $customerContact = $row['customerContact'];
                                $profitReward = $row['profitReward'];
                                $status = $row['status'];
                                $createdBy = $row['createdBy'];
                                $confirmedBy = $row['confirmedBy'];
                                $date = $row['date'];
                                ?>
                            <tr>
                                <td><?php echo $serialNumber; ?></td>
                                <td><?php echo $partner; ?></td>
                                <td><?php echo $customerContact; ?></td>
                                <td><?php echo $destination; ?></td>
                                <td><?php echo $product; ?></td>
                                <td><?php echo $riderReward; ?></td>
                                <td><?php echo $profitReward; ?></td>
                                <td><?php echo $deliveryFee; ?></td>
                                <td><?php echo $createdBy; ?></td>
                                <td><?php echo $confirmedBy; ?></td>
                                <td><?php echo $date; ?></td>

                            </tr>
                            <?php $serialNumber++;
                            } ?>
                        </tbody>

                    </table>
                </div>
            </div>

            <div id="UnprocessedWaybills" class="tab-content">
                <div class="recent-sales"><br>
                    <h2>Unconfirmed Waybill</h2>
                    <input type="text" id="filterInput" placeholder="Search for Waybill contact..."
                        onkeyup="filterTable()">
                    <table id="shipmentTable" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Partner</th>
                                <th>Contact</th>
                                <th>Destination</th>
                                <th>Products</th>
                                <th>Driver Price</th>
                                <th>Profit</th>
                                <th>Partner Price</th>
                                <th>Created By</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                            <?php
                                    require '../config.php';

                                    $query = mysqli_query($conn, "SELECT id, partner, shipmentType, product, availableUnit, quantity, unitPrice, riderReward, customersName, destination, customerContact, profitReward, status, createdBy, deliveryFee, date  
                                    FROM gbigbe
                                    WHERE shipmentType = 'Waybill' 
                                    AND status ='Completed' 
                                    AND accCaptain='rara' 
                                    ORDER BY partner DESC ");

                                    $serialNumber = 1;
                                    while ($row = mysqli_fetch_array($query)) {
                                        $id = $row['id'];
                                        $partner = $row['partner'];
                                        $product = $row['product'];
                                        $availableUnit = $row['availableUnit'];
                                        $quantity = $row['quantity'];
                                        $deliveryFee = $row['deliveryFee'];
                                        $riderReward = $row['riderReward'];
                                        $customersName = $row['customersName'];
                                        $destination = $row['destination'];
                                        $customerContact = $row['customerContact'];
                                        $profitReward = $row['profitReward'];
                                        $status = $row['status'];
                                        $createdBy = $row['createdBy'];
                                        $date = $row['date'];
                                        ?>
                            <tr>
                                <td><?php echo $serialNumber; ?></td>
                                <td><?php echo $partner; ?></td>
                                <td><?php echo $customerContact; ?></td>
                                <td><?php echo $destination; ?></td>
                                <td><?php echo $product; ?></td>
                                <td><?php echo $riderReward; ?></td>
                                <td><?php echo $profitReward; ?></td>
                                <td><?php echo $deliveryFee; ?></td>
                                <td><?php echo $createdBy; ?></td>
                                <td><?php echo $date; ?></td>
                                <td><button onclick="confirmShipment(<?php echo $id; ?>)"
                                        style="padding:0.5rem; background-color:  #7380ec; border-radius:0.4rem;"><b>Confirm</b></button>
                                </td>
                            </tr>
                            <?php $serialNumber++;
                                    } ?>
                        </tbody>
                    </table>
                    <div id="returnReasonModal" style="display:none;">
                        <div class="modal-content">
                            <span id="closeModal" class="close">&times;</span>
                            <form id="returnReasonForm">
                                <label for="returnReason">Reason for return:</label>
                                <textarea id="returnReason" name="returnReason" required></textarea>
                                <input type="hidden" id="returnShipmentId" name="shipmentId">
                                <button type="submit">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div id="ProcessedWaybills" class="tab-content">
                <div class="recent-sales"><br>
                    <h2>Confirmed Waybill</h2>
                    <input type="text" id="filterInput" placeholder="Search for Waybill contact..."
                        onkeyup="filterTable()">
                    <table id="shipmentTable" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Partner</th>
                                <th>Contact</th>
                                <th>Destination</th>
                                <th>Products</th>
                                <th>Driver Price</th>
                                <th>Profit</th>
                                <th>Partner Price</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                            <?php
                            require '../config.php';

                            $query = mysqli_query($conn, "SELECT id, partner, shipmentType, product, availableUnit, quantity, unitPrice, riderReward, customersName, destination, customerContact, profitReward, status, deliveryFee, date  
                            FROM gbigbe 
                            WHERE shipmentType = 'Waybill' 
                            AND status ='Completed' 
                            AND accCaptain='beni' 
                            ORDER BY partner DESC ");
                            $serialNumber = 1;
                            while ($row = mysqli_fetch_array($query)) {
                                $id = $row['id'];
                                $partner = $row['partner'];
                                $product = $row['product'];
                                $availableUnit = $row['availableUnit'];
                                $quantity = $row['quantity'];
                                $deliveryFee = $row['deliveryFee'];
                                $riderReward = $row['riderReward'];
                                $customersName = $row['customersName'];
                                $destination = $row['destination'];
                                $customerContact = $row['customerContact'];
                                $profitReward = $row['profitReward'];
                                $status = $row['status'];
                                $date = $row['date'];
                                ?>
                                <tr>
                                    <td><?php echo $serialNumber; ?></td>
                                    <td><?php echo $partner; ?></td>
                                    <td><?php echo $customerContact; ?></td>
                                    <td><?php echo $destination; ?></td>
                                    <td><?php echo $product; ?></td>
                                    <td><?php echo $riderReward; ?></td>
                                    <td><?php echo $profitReward; ?></td>
                                    <td><?php echo $deliveryFee; ?></td>
                                    <td><?php echo $date; ?></td>
                                    
                                </tr>
                                <?php $serialNumber++;
                            } ?>
                        </tbody>
                    </table>
                    <div id="returnReasonModal" style="display:none;">
                        <div class="modal-content">
                            <span id="closeModal" class="close">&times;</span>
                            <form id="returnReasonForm">
                                <label for="returnReason">Reason for return:</label>
                                <textarea id="returnReason" name="returnReason" required></textarea>
                                <input type="hidden" id="returnShipmentId" name="shipmentId">
                                <button type="submit">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div id="partnerPayment" class="tab-content">
                <div class="recent-sales"><br>
                    <h2>Partner Remittance</h2>
                    <input type="text" id="filterInput" placeholder="Search for Waybill contact..."
                        onkeyup="filterTable()">
                    <table id="shipmentTable" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Partner</th>
                                <th>Total Amount</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                            <?php
                            require '../config.php';

                            $query = mysqli_query($conn, "SELECT DISTINCT partner 
                                FROM gbigbe 
                                WHERE shipmentType = 'Waybill' 
                                AND status ='Completed' 
                                AND partnerRemitance = 'rara'
                                AND accCaptain='beni' 
                                ");

                            if (!$query) {
                                echo "Error fetching data: " . mysqli_error($conn);
                            } else {
                                $serialNumber = 1; // Initialize the serial number outside the while loop
                            
                                while ($row = mysqli_fetch_array($query)) {
                                    $partner = $row['partner'];

                                    // Query to calculate total partner reward
                                    $sqla = "SELECT SUM(deliveryFee) AS totalReward 
                                    FROM gbigbe 
                                    WHERE shipmentType = 'Waybill' 
                                    AND status ='Completed' 
                                    AND partnerRemitance = 'rara'
                                    AND partner = '$partner'";

                                    $resulta = mysqli_query($conn, $sqla);
                                    $rowa = mysqli_fetch_array($resulta);
                                    $remitance2US = $rowa['totalReward'];

                                    
                                    ?>
                                    <tr>
                                        <td><?php echo $serialNumber; ?></td> <!-- Display the serial number -->
                                        <td><?php echo $partner; ?></td>
                                        <td><?php echo $remitance2US; ?></td>
                                        <td><a href="waybillWiwi.php?partner=<?php echo urlencode($partner); ?>">Details</a></td>
                                        
                                    </tr>
                                    <?php
                                    $serialNumber++; // Increment the serial number
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                    <div id="returnReasonModal" style="display:none;">
                        <div class="modal-content">
                            <span id="closeModal" class="close">&times;</span>
                            <form id="returnReasonForm">
                                <label for="returnReason">Reason for return:</label>
                                <textarea id="returnReason" name="returnReason" required></textarea>
                                <input type="hidden" id="returnShipmentId" name="shipmentId">
                                <button type="submit">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div id="agentPayment" class="tab-content">
                <div class="recent-sales">
                    <div class="spacer"></div>
                    <h2>Agent Payment</h2>
                    
                    <input type="text" id="filterInput7" placeholder="Search for shipment by agent" onkeyup="filterTable7()">
                    <table id="shipmentTable7" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Agent</th>
                                <th>Total Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                            <?php
                            require '../config.php';

                            $query = mysqli_query($conn, "SELECT DISTINCT agentName
                            FROM gbigbe 
                            WHERE shipmentType='Waybill' 
                            AND status = 'Completed' 
                            AND captainPayStatus = 'rara' 
                            
                            ORDER BY captain DESC ");
                            if (!$query) {
                                echo "Error fetching data: " . mysqli_error($conn);
                            } else {
                                $serialNumber = 1; // Initialize the serial number outside the while loop
                                while ($row = mysqli_fetch_array($query)) {
                                    $agentName = $row['agentName'];

                                    // Query to calculate total partner reward
                                    $sqla = "SELECT SUM(riderReward) AS totalReward 
                                    FROM gbigbe 
                                    WHERE shipmentType='Waybill' 
                                    AND agentName = '$agentName' 
                                    AND status = 'completed' 
                                    AND accCaptain = 'beni' 
                                    AND captainPayStatus = 'rara'
                                    
                                    ";
                                    $resulta = mysqli_query($conn, $sqla);
                                    $rowa = mysqli_fetch_array($resulta);
                                    $riderReward = $rowa['totalReward'];

                                    
                                    ?>
                                    <tr>
                                        <td><?php echo $serialNumber; ?></td> <!-- Display the serial number -->
                                        <td><?php echo $agentName; ?></td>
                                        <td><?php echo $riderReward; ?></td>
                                        <td><a href="wiwoIroOlugbe1.php?olugbe=<?php echo urlencode($agentName); ?>">Details</a>
                                        </td>
            
                                    </tr>
                                    <?php
                                    $serialNumber++; // Increment the serial number
                                }
                            } ?>
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
        let td = tr[i].getElementsByTagName('td')[2];
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
document.querySelectorAll('.status-dropdown').forEach(function(dropdown) {
    dropdown.addEventListener('change', function() {
        var shipmentId = this.getAttribute('data-id');
        var newStatus = this.value;
        var partner = this.getAttribute('data-partner');
        var product = this.getAttribute('data-product');
        var quantity = this.getAttribute('data-quantity');

        if (newStatus === 'Return') {
            // Show the modal
            var modal = document.getElementById('returnReasonModal');
            modal.style.display = 'block';
            document.getElementById('returnShipmentId').value = shipmentId;

            // Set data attributes on the modal
            modal.setAttribute('data-partner', partner);
            modal.setAttribute('data-product', product);
            modal.setAttribute('data-quantity', quantity);
        } else {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'update_status.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    alert('Status updated successfully.');
                    window.location.href = 'records.php';
                }
            };
            xhr.send('id=' + shipmentId + '&status=' + newStatus);
        }
    });
});

// Handle modal close
document.getElementById('closeModal').addEventListener('click', function() {
    document.getElementById('returnReasonModal').style.display = 'none';
});

// Handle form submission
document.getElementById('returnReasonForm').addEventListener('submit', function(e) {
    e.preventDefault();

    var modal = document.getElementById('returnReasonModal');
    var shipmentId = document.getElementById('returnShipmentId').value;
    var returnReason = document.getElementById('returnReason').value;
    var quantity = modal.getAttribute('data-quantity');
    var partner = modal.getAttribute('data-partner');
    var product = modal.getAttribute('data-product');

    console.log(partner, product, quantity);
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'updateStatus.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            alert('Return reason saved successfully.');
            modal.style.display = 'none';
            window.location.href = 'records.php';
        }
    };
    xhr.send('id=' + shipmentId + '&status=Return&returnReason=' + encodeURIComponent(returnReason) +
        '&quantity=' + quantity + '&partner=' + partner + '&product=' + product);
});
</script>
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
<script>
function confirmShipment(id) {
    if (confirm("Please confirm the data is correct before proceeding")) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'update_captain1.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                alert('Shipment confirmed');
                // Reload the table data
                window.location.href = 'iranse.php';
            }
        };
        xhr.send('id=' + id);
    } else {
        alert("Shipment confirmation canceled.");
    }
}
</script>