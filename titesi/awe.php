<?php
session_start();
if (!isset($_SESSION['userType'])) {
    header("location: ../index.php");
} elseif (($_SESSION['userType']) == "Inventory") {
    header("Location: ../okojooja");
} elseif (($_SESSION['userType']) == "Data_Entry") {
} elseif (($_SESSION['userType']) == "Accountant") {
    header("Location: ../onisiro");
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

    button {
        padding-left: 1rem;
        padding-right: 1rem;
        background-color: #757577;
        height: 1.5rem;
        color: white;
        border-radius: 5px;
    }
    .fillers{
        text-align: center;
        display: flex;
        gap: 1rem;
    }
    .fillers .btn a{
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
                    <h3>Create Shipment</h3>
                </a>

                <a href="records.php">
                    <span class="material-icons-sharp">local_shipping</span>
                    <h3>Active Shipments</h3>
                </a>
                <a href="dapada.php">
                    <span class="material-icons-sharp">assignment_return</span>
                    <h3>Returned Shipments</h3>
                </a>

                <a href="awe.php" class="active">
                    <span class="material-icons-sharp">history</span>
                    <h3>Shipments History</h3>
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
                <h2>Shipments Records</h2>
                <form method="post" action="">
                    <h2>Start</h2>
                    <input type="date" id="start-date" name="start-date" required>
                    <h2>End</h2>
                    <input type="date" id="end-date" name="end-date" required>
                    <button type="submit">Filter</button>
                </form>

                <div class="fillers">
                    <input type="text" id="filterInput" placeholder="Search for shipment by Partner"
                    onkeyup="filterTable()">
                <input type="text" id="filterInput2" placeholder="Search for shipment by Contact"
                    onkeyup="filterTable2()">
                <select id="filterInput1" onchange="filterTable1()">
                    <option value="">Search by Status</option>
                    <option value="Completed">Completed</option>
                    <option value="Pending">Pending</option>
                </select>
                    <div class="btn"><a href="./awe.php">Reset</a></div>
                </div>
                <table id="shipmentTable" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Partner</th>
                            <th>Type</th>
                            <th>Product</th>
                            <th>Avail. Qty</th>
                            <th>Amount</th>
                            <th>Client</th>
                            <th>Destination</th>
                            <th>Contact</th>
                            <th>Captain</th>
                            <th>Status</th>
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
                        $query_string = "SELECT id, partner, shipmentType, product, availableUnit, quantity, unitPrice, amount, customersName, destination, customerContact, captain, status, paymentMethod, date, createdBy, editedBy, recalledBy, confirmedBy
                     FROM gbigbe 
                     WHERE shipmentType = 'Delivery'";

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
                                    $createdBy = $row['createdBy'];
                                    $editedBy = $row['editedBy'];
                                    $recalledBy = $row['recalledBy'];
                                    $confirmedBy = $row['confirmedBy'];
                                ?>
                        <tr>
                            <td><?php echo $serialNumber; ?></td> <!-- Display the serial number -->
                            <td><?php echo $partner; ?></td>
                            <td><?php echo $shipmentType; ?></td>
                            <td><?php echo $product; ?></td>
                            <td><?php echo $availableUnit; ?></td>
                            <td><?php echo $amount; ?></td>
                            <td><?php echo $customersName; ?></td>
                            <td><?php echo $destination; ?></td>
                            <td><?php echo $customerContact; ?></td>
                            <td><?php echo $captain; ?></td>
                            <td><?php echo $status; ?></td>
                                <td><?php echo $createdBy; ?></td>
                                <td><?php echo $editedBy; ?></td>
                                <td><?php echo $recalledBy; ?></td>
                                <td><?php echo $confirmedBy; ?></td>
                            <td><?php echo $date; ?></td>
                        </tr>
                        <?php
                                $serialNumber++;
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
    filterTable1();
}

function filterTable1() {
    // Get the value of the input field
    let input = document.getElementById('filterInput1');
    let filter = input.value.toUpperCase();

    // Get the table and its rows
    let table = document.getElementById('shipmentTable');
    let tr = table.getElementsByTagName('tr');

    // Loop through all table rows, except the first (header) row
    for (let i = 1; i < tr.length; i++) {
        // Apply this filter only to rows that are still visible
        if (tr[i].style.display !== 'none') {
            let td = tr[i].getElementsByTagName('td')[10]; // Adjust index as needed
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
    filterTable2();
}

function filterTable2() {
    // Get the value of the input field
    let input = document.getElementById('filterInput2');
    let filter = input.value.toUpperCase();

    // Get the table and its rows
    let table = document.getElementById('shipmentTable');
    let tr = table.getElementsByTagName('tr');

    // Loop through all table rows, except the first (header) row
    for (let i = 1; i < tr.length; i++) {
        // Apply this filter only to rows that are still visible
        if (tr[i].style.display !== 'none') {
            let td = tr[i].getElementsByTagName('td')[8]; // Adjust index as needed
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
}

</script>