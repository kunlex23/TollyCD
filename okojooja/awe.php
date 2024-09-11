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
    <link rel="stylesheet" href="css/styls.css">
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
     .fillers {
        text-align: center;
        display: flex;
        gap: 1rem;
    }

    .fillers .btn a {
        margin-top: 0;
        padding: 0.6rem;
        background-color: #757577;
        height: 2.5rem;
        color: white;
        border-radius: 5px;
        margin-left: 1rem;
        font-size: 16px;
        text-decoration: none;
        color: white;
    }
     form {
        display: flex;
        padding-left: 30%;
        padding-right: 30%;
        gap: 0.5rem;
    }

    input[type="date"],
    option {
        font-size: 16px;
        padding: 10px;
        width: 200px;
        height: 1rem;
    }

    form button {
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
                <div class="closeBTN" id="close-btn"><span class="material-icons-sharp">close</span></div>
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
                    <h3>New Waybill</h3>
                </a>

                <a href="records.php">
                    <span class="material-icons-sharp">local_shipping</span>
                    <h3>Waybills</h3>
                </a>

                <a href="awe.php"  class="active">
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

            <!-- ---------END OF EXAM-------- -->
            <div class="recent-sales">
                <div class="spacer"></div>
                <h2>Waybills History</h2>
                <form method="post" action="">
                    <label for="start-date">Start Date:</label>
                    <input type="date" id="start-date" name="start-date" required>
                    <label for="end-date">End Date:</label>
                    <input type="date" id="end-date" name="end-date" required>
                    <button type="submit">Filter</button>
                </form>
                <div class="fillers">
                        <input type="text" id="filterInput2" placeholder="Search for shipment by Partner"
                            onkeyup="filterTable2()">
                        <input type="text" id="filterInput3" placeholder="Search for shipment by Agent"
                            onkeyup="filterTable3()">
                        <input type="text" id="filterInput4" placeholder="Search for shipment by Receiver"
                            onkeyup="filterTable4()">
                        <div class="btn"><a href="./awe.php">Reset</a></div>
                    </div>
                <table id="shipmentTable" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Partner</th>
                            <th>Receiver</th>
                            <th>Contact</th>
                            <th>Destination</th>
                            <th>Agent</th>
                            <th>Products</th>
                            <th>Avl Qty</th>
                            <th>Driver Price</th>
                            <th>Profit</th>
                            <th>Partner Price</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <?php
                        require '../config.php';

                        // Initialize variables for the date range
                        $start_date = isset($_POST['start-date']) ? $_POST['start-date'] : null;
                        $end_date = isset($_POST['end-date']) ? $_POST['end-date'] : null;


                        $query_string = "SELECT id, partner, shipmentType, product, availableUnit, quantity, unitPrice, riderReward, customersName, destination, customerContact, profitReward, status, deliveryFee, agentName, date  
                        FROM gbigbe 
                        WHERE shipmentType = 'Waybill'";

                        if ($start_date && $end_date) {
                            $query_string .= " AND date BETWEEN '$start_date' AND '$end_date'";
                        }

                        $query_string .= " ORDER BY partner DESC";

                        // Execute the query
                        $query = mysqli_query($conn, $query_string);

                        if (!$query) {
                            echo "Error fetching data: " . mysqli_error($conn);
                        } else {
                        $serialNumber = 1;
                        while ($row = mysqli_fetch_array($query)) {
                            $id = $row['id'];
                            $partner = $row['partner'];
                            $product = $row['product'];
                            $availableUnit = $row['availableUnit'];
                            $quantity = $row['quantity'];
                            $deliveryFee = $row['deliveryFee'];
                            $agentName = $row['agentName'];
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
                                <td><?php echo $agentName; ?></td>
                                <td><?php echo $product; ?></td>
                                <td><?php echo $availableUnit; ?></td>
                                <td><?php echo $riderReward; ?></td>
                                <td><?php echo $profitReward; ?></td>
                                <td><?php echo $deliveryFee; ?></td>
                                <td><?php echo $status; ?></td>
                                <td><?php echo $date; ?></td>
                                </tr>
                        <?php $serialNumber++;  } }?>
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
function filterTable2() {
    // Get the value of the input field
    let input = document.getElementById('filterInput2');
    let filter = input.value.toUpperCase();

    // Get the table and its rows
    let table = document.getElementById('shipmentTable');
    let tr = table.getElementsByTagName('tr');

    // Loop through all table rows, except the first (header) row
    for (let i = 1; i < tr.length; i++) {
        let td = tr[i].getElementsByTagName('td')[1]; // First column (adjust index as needed)
        if (td) {
            let txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = ''; // Show row
            } else {
                tr[i].style.display = 'none'; // Hide row
            }
        }
    }
    // Call the next filter to act on the filtered results
    filterTable3();
}

function filterTable3() {
    // Get the value of the input field
    let input = document.getElementById('filterInput3');
    let filter = input.value.toUpperCase();

    // Get the table and its rows
    let table = document.getElementById('shipmentTable');
    let tr = table.getElementsByTagName('tr');

    // Loop through all table rows, except the first (header) row
    for (let i = 1; i < tr.length; i++) {
        // Apply this filter only to rows that are still visible
        if (tr[i].style.display !== 'none') {
            let td = tr[i].getElementsByTagName('td')[5]; // Adjust index as needed
            if (td) {
                let txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = ''; // Show row
                } else {
                    tr[i].style.display = 'none'; // Hide row
                }
            }
        }
    }
    // Call the next filter to act on the filtered results
    // filterTable2();
}function filterTable4() {
    // Get the value of the input field
    let input = document.getElementById('filterInput4');
    let filter = input.value.toUpperCase();

    // Get the table and its rows
    let table = document.getElementById('shipmentTable');
    let tr = table.getElementsByTagName('tr');

    // Loop through all table rows, except the first (header) row
    for (let i = 1; i < tr.length; i++) {
        // Apply this filter only to rows that are still visible
        if (tr[i].style.display !== 'none') {
            let td = tr[i].getElementsByTagName('td')[2]; // Adjust index as needed
            if (td) {
                let txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = ''; // Show row
                } else {
                    tr[i].style.display = 'none'; // Hide row
                }
            }
        }
    }
    // Call the next filter to act on the filtered results
    // filterTable2();
}

</script>