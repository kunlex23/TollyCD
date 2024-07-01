
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
                <a href="index.php" class="active">
                    <span class="material-icons-sharp">grid_view</span>
                    <h3>Dashboard</h3>
                </a>

                <a href="records.php">
                    <span class="material-icons-sharp">local_shipping</span>
                    <h3>Shipments</h3>
                </a>

                <a href="inawo.php">
                    <span class="material-icons-sharp">paid</span>
                    <h3>Expenses</h3>
                </a>

                <a href="#">
                    <span class="material-icons-sharp"></span>
                    <h3></h3>
                </a>
            </div>
        </aside>
        <!------------ END OF ASIDE ------------>
        <main>
            <h1>Accounting</h1>
            <div class="insight">
                <div class="sales">
                    <div class="middle">
                        <div class="left">
                            <h3>Total Income</h3>
                            <div id="link_wrapper">

                            </div>
                        </div>

                    </div>
                    <!-- <small class="tex">Last 7 Days</small> -->
                </div>
                <!-- END OF STUDENTS -->
                <div class="income">
                    <div class="middle">
                        <div class="left">
                            <h3>Total Remittance to Partner</h3>
                            <div id="link_wrapper1">

                            </div>
                        </div>

                    </div>
                    <!-- <small class="text-muted">Last 7 days</small> -->
                </div>

                <div class="expensis">
                    <div class="middle">
                        <div class="left">
                            <h3>Total Payment for Captains</h3>
                            <div id="link_wrapper2">

                            </div>
                        </div>

                    </div>
                    <!-- <small class="text-muted">Last 24hrs</small> -->
                </div>
                <div class="expensis">
                    <div class="middle">
                        <div class="left">
                            <h3>Total Expenses</h3>
                            <div id="link_wrapper3">

                            </div>
                        </div>

                    </div>
                </div>
                    <!-- <small class="text-muted">Last 24hrs</small> -->
                <div class="expensis">
                    <div class="middle">
                        <div class="left">
                            <h3>Total Profit</h3>
                            <div id="link_wrapper4">

                            </div>
                        </div>

                    </div>
                    <!-- <small class="text-muted">Last 24hrs</small> -->
                </div>

            </div>
            <!-- ---------END OF EXAM-------- -->
            <div class="recent-sales">
                <div class="spacer"></div>
                <h2>Recent Sales</h2>
                <table style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Partner</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Amount</th>
                            <th>Customers Name</th>
                            <th>Destination</th>
                            <th>Captain</th>
                            <th>paymentMethod</th>
                            <th>Date</th>


                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <?php
                        require '../config.php';


                        $query = mysqli_query($conn, "SELECT partner, shipmentType, product, quantity, unitPrice, amount, customersName, destination, customerContact, captain, status, paymentMethod, date  FROM gbigbe WHERE status = 'Completed' ORDER BY partner DESC LIMIT 10");
                        while ($row = mysqli_fetch_array($query)) {
                            $partner = $row['partner'];
                            $product = $row['product'];
                            $quantity = $row['quantity'];
                            $unitPrice = $row['unitPrice'];
                            $amount = $row['amount'];
                            $customersName = $row['customersName'];
                            $destination = $row['destination'];
                            $captain = $row['captain'];
                            $paymentMethod = $row['paymentMethod'];
                            $date = $row['date'];
                            ?>
                            <tr>
                                <td><?php echo $partner; ?></td>
                                <td><?php echo $product; ?></td>
                                <td><?php echo $quantity; ?></td>
                                <td><?php echo $unitPrice; ?></td>
                                <td><?php echo $amount; ?></td>
                                <td><?php echo $customersName; ?></td>
                                <td><?php echo $destination; ?></td>
                                <td><?php echo $captain; ?></td>
                                <td><?php echo $paymentMethod; ?></td>
                                <td><?php echo $date; ?></td>
                            </tr>
                
                
                
                        <?php } ?>
                    </tbody>
                </table>
                <a href="records.php">Show all</a>

                <div class="spacer"></div>
                <h2>Recent Expenses</h2>
                <table style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Purpose</th>
                            <th>Unit</th>
                            <th>Unit Price</th>
                            <th>Amount</th>
                            <th>Date</th>


                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <?php
                        require '../config.php';


                        $query = mysqli_query($conn, "SELECT id, purpose, unit, unitPrice, amount, date  FROM inawo ORDER BY purpose  DESC LIMIT 4");
                        while ($row = mysqli_fetch_array($query)) {
                            $purpose = $row['purpose'];
                            $unit = $row['unit'];
                            $unitPrice = $row['unitPrice'];
                            $amount = $row['amount'];
                            $date = $row['date'];
                            ?>
                            <tr>
                                <!-- <td><?php echo $id; ?></td> -->
                                <td><?php echo $purpose; ?></td>
                                <td><?php echo $unit; ?></td>
                                <td><?php echo $unitPrice; ?></td>
                                <td><?php echo $amount; ?></td>
                                <td><?php echo $date; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <a href="inawo.php">Show all</a>
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