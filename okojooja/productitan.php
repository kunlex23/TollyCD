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
                <a href="alabasepo.php">
                    <span class="material-icons-sharp">groups</span>
                    <h3>Partners</h3>
                </a>
                <a href="oja.php" class="active">
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

                <a href="awe.php" >
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
            <div class="recent-sales">
                <div class="spacer"></div>
                <h2>Product History</h2>

                <input type="text" id="filterInput" placeholder="Search for product..." onkeyup="filterTable()">
                <table id="shipmentTable" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Partner</th>
                            <th>Product</th>
                            <th>Previous Qty</th>
                            <th>Received Qty</th>
                            <th>Bad Product</th>
                            <th>Good Product</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <?php
                        require '../config.php';

                        $query = mysqli_query($conn, "SELECT id, partner, productName, oQuantity, rQuantity, bQuantity, quantity, date FROM afikun ORDER BY partner DESC");

                        if (!$query) {
                            echo "Error fetching data: " . mysqli_error($conn);
                        } else {
                            $serialNumber = 1; // Initialize the serial number outside the while loop
                        
                            while ($row = mysqli_fetch_array($query)) {
                                $id = $row['id'];
                                $partner = $row['partner'];
                                $productName = $row['productName'];
                                $oQuantity = $row['oQuantity'];
                                $rQuantity = $row['rQuantity'];
                                $bQuantity = $row['bQuantity'];
                                $quantity = $row['quantity'];
                                $date = $row['date'];
                                ?>
                        <tr>
                            <td><?php echo $serialNumber; ?></td> <!-- Display the serial number -->
                            <td><?php echo $partner; ?></td>
                            <td><?php echo $productName; ?></td>
                            <td><?php echo $oQuantity; ?></td>
                            <td><?php echo $rQuantity; ?></td>
                            <td><?php echo $bQuantity; ?></td>
                            <td><?php echo $quantity; ?></td>
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
        </main>

        <div class="right">
            <div class="top">
                <button id="menu-btn">
                    <span class="material-icons-sharp">menu</span>
                </button>
                <div class="theme-toggler">
                    <span class="material-icons-sharp active">light_mode</span>
                    <span class="material-icons-sharp">dark_mode</span>
                </div>
            </div>
            <div class="sales-analytics">
                <a href="ojatitunpipo.php">
                    <div class="item add-product">
                        <div>
                            <span class="material-icons-sharp">add</span>
                            <h3>New Product</h3>
                        </div>
                    </div>
                </a>
            </div>

            <div class="sales-analytics">
                <a href="productitan.php">
                    <div class="item add-product">
                        <div>
                            <span class="material-icons-sharp">history</span>
                            <h3>Restock History</h3>
                        </div>
                    </div>
                </a>
            </div>
            <form action="./wiwa.php" method="GET">
                <label for="Name">Partner:</label>
                <select name="Name" required>
                    <option value="">Select a Partner</option>
                    <?php
                    require '../config.php';
                    $sql = "SELECT Name, contact FROM alabasepo";
                    $result = $conn->query($sql);
                    // Generate options for the combo box
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row["Name"] . '">' . $row["Name"] . '</option>';
                        }
                    }
                    ?>
                </select>
                <input type="submit" value="Search">
            </form>
        </div>
    </div>

    <script src="../script/scrip.js"></script>
</body>

</html>

<script>
var tbody = document.getElementById('table-body');
var rows = tbody.querySelectorAll('tr');

rows.forEach(function(row) {
    var fullnameLink = row.querySelector('td:first-child a');

    fullnameLink.addEventListener('click', function(event) {
        event.preventDefault();

        var fullname = fullnameLink.textContent;

        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'update_status.php?fullname=' + encodeURIComponent(fullname), true);

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    var statusCell = row.querySelector('td:nth-child(7)');
                    statusCell.textContent = 'Updated Status';
                } else {
                    console.error('Error updating status:', xhr.statusText);
                }
            }
        };

        xhr.send();
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var statusFilter = document.getElementById('statusFilter');
    var tableRows = document.querySelectorAll('#table-body tr');

    statusFilter.addEventListener('change', function() {
        var selectedStatus = statusFilter.value.toLowerCase();

        tableRows.forEach(function(row) {
            var rowStatus = row.querySelector('td:nth-child(6)').textContent.toLowerCase();

            if (selectedStatus === 'all' || (selectedStatus === 'done' && rowStatus ===
                'done') || (selectedStatus === 'progress' && rowStatus.includes('progress'))) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
});
</script>
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