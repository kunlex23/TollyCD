<?php
// session_start();
// if ($_SESSION['userType'] === 'eru') {
//     header("Location: ../okojooja");
// // } elseif ($_SESSION['userType'] === 'fifisi') {
// //     header("Location: ../titesi");
// } elseif ($_SESSION['userType'] === 'olowo') {
//     header("Location: ../onisiro");
// } elseif ($_SESSION['userType'] === 'alamojuto') {
//     header("Location: ../abojuto");
// }
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

    /* Center the modal content */
    #returnReasonModal {
        padding-top: 15%;
        padding-left: 35%;
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1;
        /* Sit on top */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgba(0, 0, 0, 0.4);
        /* Black w/ opacity */
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        background-color: #fefefe;
        padding: 20px;
        border: 1px solid #888;
        width: 40%;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
        border-radius: 8px;
        /* Rounded corners for a modern look */
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    .modal-content form {
        display: flex;
        flex-direction: column;
    }

    .modal-content textarea {
        resize: vertical;
        min-height: 100px;
        margin-bottom: 20px;
    }

    .modal-content button {
        align-self: flex-end;
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

                <a href="gbigbeTitun.php">
                    <span class="material-icons-sharp">add_circle</span>
                    <h3>New Shipment</h3>
                </a>

                <a href="records.php" class="active">
                    <span class="material-icons-sharp">local_shipping</span>
                    <h3>Shipments</h3>
                </a>

                <a href="inawo.php">
                    <span class="material-icons-sharp">paid</span>
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
                <h2>Shipments Records</h2>
                <div class="spacer"></div>
                <input type="text" id="filterInput" placeholder="Search for shipment..." onkeyup="filterTable()">
                <table id="shipmentTable" style="width: 100%;">
                    <thead>
                        <tr>
                            <!-- <th>ID</th> -->
                            <th>Partner</th>
                            <th>Type</th>
                            <th>Product</th>
                            <th>Avail. Qty</th>
                            <th>Qty</th>
                            <th>Unit Price</th>
                            <th>Amount</th>
                            <th>Client</th>
                            <th>Destination</th>
                            <th>Contact</th>
                            <th>Captain</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <?php
                        require '../config.php';

                        $query = mysqli_query($conn, "SELECT id, partner, shipmentType, product, availableUnit, quantity, unitPrice, amount, customersName, destination, customerContact, captain, status, paymentMethod, date  FROM gbigbe WHERE status ='pending' ORDER BY partner DESC ");
                        while ($row = mysqli_fetch_array($query)) {
                            $partner = $row['partner'];
                            $shipmentType = $row['shipmentType'];
                            $product = $row['product'];
                            $availableUnit = $row['availableUnit'];
                            $quantity = $row['quantity'];
                            $unitPrice = $row['unitPrice'];
                            $amount = $row['amount'];
                            $customersName = $row['customersName'];
                            $destination = $row['destination'];
                            $customerContact = $row['customerContact'];
                            $captain = $row['captain'];
                            $status = $row['status'];
                            $date = $row['date'];
                            ?>
                        <tr>
                            <!-- <td><?php echo $id; ?></td> -->
                            <td><?php echo $partner; ?></td>
                            <td><?php echo $shipmentType; ?></td>
                            <td><?php echo $product; ?></td>
                            <td><?php echo $availableUnit; ?></td>
                            <td><?php echo $quantity; ?></td>
                            <td><?php echo $unitPrice; ?></td>
                            <td><?php echo $amount; ?></td>
                            <td><?php echo $customersName; ?></td>
                            <td><?php echo $destination; ?></td>
                            <td><?php echo $customerContact; ?></td>
                            <td><?php echo $captain; ?></td>
                            <td>
                                <select class="status-dropdown" data-id="<?php echo $row['id']; ?>">
                                    <option value="Pending" <?php if ($status == 'Pending')
                                            echo 'selected'; ?>>Out for delivery</option>
                                    <option value="Completed" <?php if ($status == 'Completed')
                                            echo 'selected'; ?>>Delivered</option>
                                    <option value="Return" <?php if ($status == 'Return')
                                            echo 'selected'; ?>>Return</option>
                                </select>
                            </td>
                            <td><?php echo $date; ?></td>
                        </tr>
                        <?php } ?>
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
        let td = tr[i].getElementsByTagName('td')[0];
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

        if (newStatus === 'Return') {
            // Show the modal
            document.getElementById('returnReasonModal').style.display = 'block';
            document.getElementById('returnShipmentId').value = shipmentId;
        } else {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'update_status.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    alert('Status updated successfully.');
                    window.location.href='records.php';
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

    var shipmentId = document.getElementById('returnShipmentId').value;
    var returnReason = document.getElementById('returnReason').value;

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'updateStatus.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            alert('Return reason saved successfully.');
            document.getElementById('returnReasonModal').style.display = 'none';
        }
    };
    xhr.send('id=' + shipmentId + '&status=Return&returnReason=' + encodeURIComponent(returnReason));
});
</script>