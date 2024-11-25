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
    <link rel="stylesheet" href="css/style.css">
    <style>
        .date-filter-form {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .date-filter-form label,
        .date-filter-form input {
            margin-right: 10px;
        }

        .date-filter-form button {
            padding: 10px 20px;
            background-color: #4CAF50;
            /* Green background */
            color: white;
            /* White text */
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .date-filter-form button:hover {
            background-color: #45a049;
            /* Darker green background on hover */
        }

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
            <h2></h2><br>
            <div class="spacer"></div>
            <h2>Payment History</h2><br>

            <!-- <input type="text" id="filterInput" placeholder="Search for shipment..." onkeyup="filterTable()"> -->
            <?php
            require '../config.php'; // Ensure the database connection is properly set up
            
            if (isset($_GET['partner'])) {
                $partner = mysqli_real_escape_string($conn, $_GET['partner']); // Sanitize input
                $eri = mysqli_real_escape_string($conn, $_GET['eri']); // Sanitize input
                $oro = mysqli_real_escape_string($conn, $_GET['oro']); // Sanitize input
            
                // Query to calculate total partner reward
                $sqla = "SELECT SUM(profitReward) AS totalReward 
                FROM gbigbe 
                WHERE partner = '$partner' 
                AND status = 'completed' 
                AND payID2 = '$eri' ";
                $resulta = mysqli_query($conn, $sqla);

                if ($resulta) {
                    $rowa = mysqli_fetch_array($resulta);
                    $partnerReward = $rowa['totalReward'] ?? 0; // Default to 0 if no result
            
                    // Query to fetch account details
                    $query2 = "SELECT accountNumber, bank, accountName 
                    FROM alabasepo WHERE Name = '$partner'";
                    $result2 = mysqli_query($conn, $query2);

                    if ($result2) {
                        $row2 = mysqli_fetch_array($result2);

                        $accountNumber = $row2['accountNumber'] ?? 'N/A'; // Default to 'N/A' if no result
                        $bank = $row2['bank'] ?? 'N/A'; // Default to 'N/A' if no result
                        $accountName = $row2['accountName'] ?? 'N/A'; // Default to 'N/A' if no result
                        ?>
                        <div class="productDetails">
                            <div class="itemPD">
                                <b>Partner: <?php echo htmlspecialchars($partner); ?></b>
                            </div>
                            <div class="itemPD">
                                <b>Total Amount:<?php echo htmlspecialchars($oro); ?></b>
                            </div><br>

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
            <table id="shipmentTable" style="padding-left:10%; width: 90%;">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Cost</th>
                        <th>Location</th>
                        <th>Delivery fee</th>
                                <th>Created By</th>
                                <th>Edited By</th>
                                <th>Recalled By</th>
                                <th>Confirmed By</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    <?php
                    require '../config.php'; // Ensure the database connection is properly set up
                    
                    if (isset($_GET['partner'])) {
                        $partner = mysqli_real_escape_string($conn, $_GET['partner']); // Sanitize input
                        $payID = mysqli_real_escape_string($conn, $_GET['eri']); // Sanitize input
                    
                        // Get data
                        $sqlb = "SELECT product, amount, destination, deliveryFee, date, createdBy, editedBy, recalledBy, confirmedBy
                        FROM gbigbe 
                        WHERE partner = '$partner' 
                        AND payID5=$payID";

                        $result = mysqli_query($conn, $sqlb); // Execute the query
                    
                        if ($result) {
                            while ($row = mysqli_fetch_array($result)) { // Fetch the results
                                $product = $row['product'];
                                $customersName = $row['customersName'];
                                $amount = $row['amount'];
                                $destination = $row['destination'];
                                $deliveryFee = $row['deliveryFee'];
                                    $createdBy = $row['createdBy'];
                                    $editedBy = $row['editedBy'];
                                    $recalledBy = $row['recalledBy'];
                                    $confirmedBy = $row['confirmedBy'];
                                $date = $row['date'];
                                ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($product); ?></td>
                                    <td><?php echo htmlspecialchars($customersName); ?></td>
                                    <td><?php echo htmlspecialchars($amount); ?></td>
                                    <td><?php echo htmlspecialchars($destination); ?></td>
                                    <td><?php echo htmlspecialchars($deliveryFee); ?></td>
                                <td><?php echo $createdBy; ?></td>
                                <td><?php echo $editedBy; ?></td>
                                <td><?php echo $recalledBy; ?></td>
                                <td><?php echo $confirmedBy; ?></td>
                                    <td><?php echo htmlspecialchars($date); ?></td>

                                </tr>
                                <?php
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

<!-- live data -->
<script>
    function loadXMLDoc() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("link_wrapper").innerHTML =
                    this.responseText;
            }
        };
        xhttp.open("GET", "server.php", true);
        xhttp.send();
    }
    setInterval(function () {
        loadXMLDoc();
        // 1sec
    }, 1000);

    window.onload = loadXMLDoc;
</script>
<!-- Maximum reading -->
<script>
    function loadXMLDoc1() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("link_wrapper1").innerHTML =
                    this.responseText;
            }
        };
        xhttp.open("GET", "server1.php", true);
        xhttp.send();
    }
    setInterval(function () {
        loadXMLDoc1();
        // 1sec
    }, 1000);

    window.onload = loadXMLDoc1;
</script>
<!-- Minimum reading -->
<script>
    function loadXMLDoc2() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("link_wrapper2").innerHTML =
                    this.responseText;
            }
        };
        xhttp.open("GET", "server2.php", true);
        xhttp.send();
    }
    setInterval(function () {
        loadXMLDoc2();
        // 1sec
    }, 1000);

    window.onload = loadXMLDoc2;
</script>

</script>
<!-- Minimum reading -->
<script>
    function loadXMLDoc3() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("link_wrapper3").innerHTML =
                    this.responseText;
            }
        };
        xhttp.open("GET", "server3.php", true);
        xhttp.send();
    }
    setInterval(function () {
        loadXMLDoc3();
        // 1sec
    }, 1000);

    window.onload = loadXMLDoc3;
</script>
<script>
    function loadXMLDoc4() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("link_wrapper4").innerHTML =
                    this.responseText;
            }
        };
        xhttp.open("GET", "server4.php", true);
        xhttp.send();
    }
    setInterval(function () {
        loadXMLDoc4();
        // 1sec
    }, 1000);

    window.onload = loadXMLDoc4;
</script>