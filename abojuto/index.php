<?php
session_start();
if (!isset($_SESSION['userType'])) {
    header("location: ../index.php");
} elseif (($_SESSION['userType']) == "Inventory") {
    header("Location: ../okojooja");
} elseif (($_SESSION['userType']) == "Data_Entry") {
    header("Location: ../titesi");
} elseif (($_SESSION['userType']) == "Accountant") {
    header("Location: ../onisiro");
} elseif (($_SESSION['userType']) == "Admin") {
}else{
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
                <a href="index.php" class="active">
                    <span class="material-icons-sharp">grid_view</span>
                    <h3>Dashboard</h3>
                </a>

                <a href="ninan.php">
                    <span class="material-icons-sharp">inventory</span>
                    <h3>Pricing</h3>
                </a>
                <a href="newUser.php">
                    <span class="material-icons-sharp">manage_accounts</span>
                    <h3>Users</h3>
                </a>
                <a href="newCaptain.php">
                    <span class="material-icons-sharp">manage_accounts</span>
                    <h3>Captain</h3>
                </a>
                <a href="agent.php">
                    <span class="material-icons-sharp">manage_accounts</span>
                    <h3>Agent</h3>
                </a>

                <a href="iroeri.php">
                    <span class="material-icons-sharp">bar_chart</span>
                    <h3>Reports</h3>
                </a>

                <a href="abawole.php">
                    <span class="material-icons-sharp">manage_accounts</span>
                    <h3>Change Password</h3>
                </a>

                <a href="../logout.php">
                    <span class="material-icons-sharp">pedal_bike</span>
                    <h3>Logout</h3>
                </a>
            </div>
        </aside>
        <!------------ END OF ASIDE ------------>
        <main>
            <h1>Admin Dashboard</h1>
            <div class="insight">
                <div class="sales">
                    <div class="middle">
                        <div class="left">
                            <h3>Gross Profit</h3>
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
                            <h3>Partner Remittance</h3>
                            <div id="link_wrapper1">

                            </div>
                        </div>

                    </div>
                    <!-- <small class="text-muted">Last 7 days</small> -->
                </div>

                <div class="expensis">
                    <div class="middle">
                        <div class="left">
                            <h3>Captains Payment</h3>
                            <div id="link_wrapper2">

                            </div>
                        </div>

                    </div>
                    <!-- <small class="text-muted">Last 24hrs</small> -->
                </div>
                <div class="expensis">
                    <div class="middle">
                        <div class="left">
                            <h3>Total Profit</h3>
                            <div id="link_wrapper4">

                            </div>
                        </div>

                    </div>
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
                <div class="sales">
                    <div class="middle">
                        <div class="left">
                            <h3>Partners</h3>
                            <div id="link_wrapper5">

                            </div>
                        </div>

                    </div>
                    <!-- <small class="tex">Last 7 Days</small> -->
                </div>
                <!-- END OF STUDENTS -->
                <div class="income">
                    <div class="middle">
                        <div class="left">
                            <h3>Products</h3>
                            <div id="link_wrapper6">

                            </div>
                        </div>

                    </div>
                    <!-- <small class="text-muted">Last 7 days</small> -->
                </div>

                <div class="expensis">
                    <div class="middle">
                        <div class="left">
                            <h3>Low Stocks</h3>
                            <div id="link_wrapper7">

                            </div>
                        </div>

                    </div>
                    <!-- <small class="text-muted">Last 24hrs</small> -->
                </div>

                
                <div class="expensis">
                    <div class="middle">
                        <div class="left">
                            <h3>Out of Stock</h3>
                            <div id="link_wrapper10">

                            </div>
                        </div>

                    </div>
                </div>

                <div class="expensis">
                    <div class="middle">
                        <div class="left">
                            <h3>Shipments</h3>
                            <div id="link_wrapper8">

                            </div>
                        </div>

                    </div>
                </div>

                <div class="expensis">
                    <div class="middle">
                        <div class="left">
                            <h3>Returned Shipments</h3>
                            <div id="link_wrapper9">

                            </div>
                        </div>

                    </div>
                </div>


            </div><br>

            <h2>Recent Shipments</h2>
            <table style="width: 100%;">
                <thead>
                    <tr>
                        <th>Partner</th>
                        <th>Type</th>
                        <th>Product</th>
                        <th>Amount</th>
                        <th>Customers</th>
                        <th>Destination</th>
                        <th>Captain</th>
                        <th>Status</th>
                        <th>Date</th>


                    </tr>
                </thead>
                <tbody id="table-body">
                    <?php
                        require '../config.php';

                        // $query = mysqli_query($conn, "SELECT partner, product, availableUnit, quantity, unitPrice, amount, customersName, destination, customerContact, captain, status, paymentMethod, date  FROM gbigbe ORDER BY partner DESC LIMIT 10");

                        $query = mysqli_query($conn, "SELECT partner, shipmentType, product, quantity, unitPrice, amount, customersName, destination, customerContact, captain, status, paymentMethod, date  FROM gbigbe ORDER BY partner DESC LIMIT 10");
                        while ($row = mysqli_fetch_array($query)) {
                            $partner = $row['partner'];
                            $shipmentType = $row['shipmentType'];
                            $product = $row['product'];
                            $quantity = $row['quantity'];
                            $amount = $row['amount'];
                            $customersName = $row['customersName'];
                            $destination = $row['destination'];
                            $customerContact = $row['customerContact'];
                            $captain = $row['captain'];
                            $status = $row['status'];
                            $paymentMethod = $row['paymentMethod'];
                            $date = $row['date'];
                            ?>
                    <tr>
                        <td><?php echo $partner; ?></td>
                        <td><?php echo $shipmentType; ?></td>
                        <td><?php echo $product; ?></td>
                        <td><?php echo $amount; ?></td>
                        <td><?php echo $customersName; ?></td>
                        <td><?php echo $destination; ?></td>
                        <td><?php echo $captain; ?></td>
                        <td><?php echo $status; ?></td>
                        <td><?php echo $date; ?></td>
                    </tr>



                    <?php } ?>
                </tbody>
            </table>
            <a href="records.php">Show all</a>
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

            <div class="sales-analytics">
                <a href="../okojooja">
                    <div class="item add-product">
                        <div>
                            <span class="material-icons-sharp">source</span>
                            <h3>Inventory</h3>
                        </div>
                    </div>
                </a>
                <a href="../titesi">
                    <div class="item add-product">
                        <div>
                            <span class="material-icons-sharp">description</span>
                            <h3>Data Entry</h3>
                        </div>
                    </div>
                </a>

            <div class="sales-analytics">
                <a href="../onisiro">
                    <div class="item add-product">
                        <div>
                            <span class="material-icons-sharp">account_balance_wallet</span>
                            <h3>Account</h3>
                        </div>
                    </div>
                </a>

                <span>
                    <center>
                        <h2>Products running low</h2>
                    </center>
                </span>
                <table style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Partner</th>
                            <th>Product</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <?php
                        require '../config.php';

                        $query = mysqli_query($conn, "SELECT partner, productName, quantity FROM products WHERE quantity < 5 ORDER BY partner DESC LIMIT 10");

                        while ($row = mysqli_fetch_array($query)) {
                            $partner = $row['partner'];
                            $productName = $row['productName'];
                            $quantity = $row['quantity'];
                            ?>
                        <tr>
                            <td> <?php echo $partner; ?></td>
                            <td><?php echo $productName; ?></td>
                            <td><?php echo $quantity; ?></td>

                        </tr>



                        <?php } ?>
                    </tbody>
                </table>
                <div class="item-online">
                    <div class="right">
                        <table style="width: 100%;" class="due_client">


                        </table>

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
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("link_wrapper").innerHTML =
                this.responseText;
        }
    };
    xhttp.open("GET", "server.php", true);
    xhttp.send();
}
setInterval(function() {
    loadXMLDoc();
    // 1sec
}, 1000);

window.onload = loadXMLDoc;
</script>
<!-- Maximum reading -->
<script>
function loadXMLDoc1() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("link_wrapper1").innerHTML =
                this.responseText;
        }
    };
    xhttp.open("GET", "server1.php", true);
    xhttp.send();
}
setInterval(function() {
    loadXMLDoc1();
    // 1sec
}, 1000);

window.onload = loadXMLDoc1;
</script>
<!-- Minimum reading -->
<script>
function loadXMLDoc2() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("link_wrapper2").innerHTML =
                this.responseText;
        }
    };
    xhttp.open("GET", "server2.php", true);
    xhttp.send();
}
setInterval(function() {
    loadXMLDoc2();
    // 1sec
}, 1000);

window.onload = loadXMLDoc2;
</script>
<script>
function loadXMLDoc3() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("link_wrapper3").innerHTML =
                this.responseText;
        }
    };
    xhttp.open("GET", "server3.php", true);
    xhttp.send();
}
setInterval(function() {
    loadXMLDoc3();
    // 1sec
}, 1000);

window.onload = loadXMLDoc3;
</script>
<script>
function loadXMLDoc4() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("link_wrapper4").innerHTML =
                this.responseText;
        }
    };
    xhttp.open("GET", "server4.php", true);
    xhttp.send();
}
setInterval(function() {
    loadXMLDoc4();
    // 1sec
}, 1000);

window.onload = loadXMLDoc4;
</script>

<!-- live data -->
<script>
function loadXMLDoc5() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("link_wrapper5").innerHTML =
                this.responseText;
        }
    };
    xhttp.open("GET", "server5.php", true);
    xhttp.send();
}
setInterval(function() {
    loadXMLDoc5();
    // 1sec
}, 1000);

window.onload = loadXMLDoc5;
</script>
<!-- Maximum reading -->
<script>
function loadXMLDoc6() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("link_wrapper6").innerHTML =
                this.responseText;
        }
    };
    xhttp.open("GET", "server6.php", true);
    xhttp.send();
}
setInterval(function() {
    loadXMLDoc6();
    // 1sec
}, 1000);

window.onload = loadXMLDoc6;
</script>
<!-- Minimum reading -->
<script>
function loadXMLDoc7() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("link_wrapper7").innerHTML =
                this.responseText;
        }
    };
    xhttp.open("GET", "server7.php", true);
    xhttp.send();
}
setInterval(function() {
    loadXMLDoc7();
    // 1sec
}, 1000);

window.onload = loadXMLDoc7;
</script>
<script>
function loadXMLDoc8() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("link_wrapper8").innerHTML =
                this.responseText;
        }
    };
    xhttp.open("GET", "server8.php", true);
    xhttp.send();
}
setInterval(function() {
    loadXMLDoc8();
    // 1sec
}, 1000);

window.onload = loadXMLDoc8;
</script>
<script>
function loadXMLDoc9() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("link_wrapper9").innerHTML =
                this.responseText;
        }
    };
    xhttp.open("GET", "server9.php", true);
    xhttp.send();
}
setInterval(function() {
    loadXMLDoc9();
    // 1sec
}, 1000);

window.onload = loadXMLDoc9;
</script>
<script>
function loadXMLDoc10() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("link_wrapper10").innerHTML =
                this.responseText;
        }
    };
    xhttp.open("GET", "server10.php", true);
    xhttp.send();
}
setInterval(function() {
    loadXMLDoc10();
    // 1sec
}, 1000);

window.onload = loadXMLDoc10;
</script>