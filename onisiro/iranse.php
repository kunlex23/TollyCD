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

                <a href="sisanwo.php">
                    <span class="material-icons-sharp">history</span>
                    <h3>Partner Payment History</h3>
                </a>

                <a href="sisanwokeji.php">
                    <span class="material-icons-sharp">history</span>
                    <h3>Captain Payment History</h3>
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

            <!-- ---------END OF EXAM-------- -->
            <div class="recent-sales">
                <div class="spacer"></div>
                <h2>Waybills</h2>
                <div class="spacer"></div>
                <input type="text" id="filterInput" placeholder="Search for Waybill contact..." onkeyup="filterTable()">
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
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <?php
                        require '../config.php';

                        $query = mysqli_query($conn, "SELECT id, partner, shipmentType, product, availableUnit, quantity, unitPrice, riderReward, customersName, destination, customerContact, profitReward, status, deliveryFee, date  FROM gbigbe WHERE shipmentType = 'Waybill' AND status ='Completed' AND captainPayStatus='rara' ORDER BY partner DESC ");
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
                                <td><?php echo $customersName; ?></td>
                                <td><?php echo $customerContact; ?></td>
                                <td><?php echo $destination; ?></td>
                                <td><?php echo $product; ?></td>
                                <td><?php echo $riderReward; ?></td>
                                <td><?php echo $profitReward; ?></td>
                                <td><?php echo $deliveryFee; ?></td>
                                <td><?php echo $date; ?></td>
                                <td><a href="owowole.php?olubasepo=<?php echo urlencode($partner); ?>&eni=<?php echo urlencode($id); ?>&owo=<?php echo urlencode($profitReward); ?>">Confirm Payment</a></td>
                                </tr>
                        <?php $serialNumber++;  } ?>
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
    xhr.send('id=' + shipmentId + '&status=Return&returnReason=' + encodeURIComponent(returnReason) + '&quantity=' + quantity + '&partner=' + partner + '&product=' + product);
});

</script>