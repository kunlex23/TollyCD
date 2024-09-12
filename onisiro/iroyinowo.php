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

    .navbar {
        display: flex;
        justify-content: center;
        margin-top: 2rem;
        margin-bottom: 2rem;
        gap: 1rem;
    }

    /* Styling for individual navigation buttons */
    .nav-button {
        padding: 0.6rem;
        font-size: 16px;
        color: white;
        background-color: #007BFF;
        border: none;
        border-radius: 2rem;
        text-align: center;
        text-decoration: none;
        cursor: pointer;
        width: 3rem;
        height: 3rem;
    }

    /* Styling for button hover effect */
    .nav-button:hover {
        background-color: #0056b3;
    }

    .form1 {
        display: flex;
        padding-left: 30%;
        padding-right: 30%;
        gap: 0.5rem;
    }

    input[type="date"] {
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

                <a href="oroowo.php">
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

                <a href="iroyinowo.php">
                    <span class="material-icons-sharp">payments</span>
                    <h3>Report</h3>
                </a>

                <a href="../logout.php">
                    <span class="material-icons-sharp">logout</span>
                    <h3>Logout</h3>
                </a>
            </div>
        </aside>
        <!------------ END OF ASIDE ------------>
        <main>
            <h1>Report</h1><br>
            <form method="post" action="" class="form1">
                <h2>Start</h2>
                <input type="date" id="start-date" name="start-date" required>
                <h2>End</h2>
                <input type="date" id="end-date" name="end-date" required>
                <button type="submit">Filter</button>
            </form><br>
            <div class="insight">

                <div class="sales">
                    <div class="middle">
                        <div class="left">
                            <h3>Delivery</h3>
                            <div>
                                <div id="link_wrapper11">
                                <?php
                                    require '../config.php';

                                    // Query to sum the records from the last 7 days for Delivery shipments
                                    $sql = "SELECT SUM(amount) AS amountIn
                                FROM gbigbe
                                WHERE shipmentType= 'Delivery'
                                AND status = 'Completed'";
                                    // AND partnerPayStatus = 'rara'
                                    
                                    if ($result = $conn->query($sql)) {
                                        while ($row = $result->fetch_assoc()) {
                                            $tClients = $row['amountIn'] ?? 0; // Handle null case
                                        }
                                        $result->free();
                                    }

                                    echo '<h1>' . number_format($tClients, 0, '.', ',') . '</h1>';

                                    $conn->close();

                                    ?>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- <small class="tex">Last 7 Days</small> -->
                </div>

                <div class="income">
                    <div class="middle">
                        <div class="left">
                            <h3>Waybill</h3>
                            
                        </div>

                    </div>
                    <!-- <small class="text-muted">Last 7 Days</small> -->
                </div>

                <div class="expensis">
                    <div class="middle">
                        <div class="left">
                            <h3>Other Income</h3>
                            <div id="link_wrapper7">

                            </div>
                        </div>

                    </div>
                    <!-- <small class="text-muted">Last 7 Days</small> -->
                </div>

                <div class="income">
                    <div class="middle">
                        <div class="left">
                            <h3>Partner Remit</h3>
                            <div id="link_wrapper1">

                            </div>
                        </div>

                    </div>
                    <!-- <small class="text-muted">Last 7 Days</small> -->
                </div>
                <!-- ================================== -->

                <div class="expensis">
                    <div class="middle">
                        <div class="left">
                            <h3>Captains</h3>
                            <div id="link_wrapper2">

                            </div>
                        </div>

                    </div>
                    <!-- <small class="text-muted">Last 7 Days</small> -->
                </div>

                <div class="sales">
                    <div class="middle">
                        <div class="left">
                            <h3>Total Revenue</h3>
                            <div id="link_wrapper">

                            </div>
                        </div>

                    </div>
                    <!-- <small class="tex">Last 7 Days</small> -->
                </div>

                <div class="expensis">
                    <div class="middle">
                        <div class="left">
                            <h3>Expenses</h3>
                            <div id="link_wrapper3">

                            </div>
                        </div>

                    </div>
                    <!-- <small class="text-muted">Last 7 Days</small> -->
                </div>

                <div class="expensis">
                    <div class="middle">
                        <div class="left">
                            <h3>Gross Profit</h3>
                            <div id="link_wrapper4">

                            </div>
                        </div>

                    </div>
                    <!-- <small class="text-muted">Last 7 Days</small> -->
                </div>

                <div class="expensis">
                    <div class="middle">
                        <div class="left">
                            <h3>Net Profit</h3>
                            <div id="link_wrapper12">

                            </div>
                        </div>

                    </div>
                    <!-- <small class="text-muted">Last 7 Days</small> -->
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

            <?php
            if ($_SESSION['userType'] == "Admin") {
                echo "<div class='navbar'>";
                echo "<a href='../okojooja' class='nav-button'>I</a>";
                echo "<a href='../titesi' class='nav-button'>D</a>";
                echo "<a href='../onisiro' class='nav-button'>A</a>";
                echo "<a href='../abojuto' class='nav-button'>AD</a>";
                echo "</div>";
            }
            ?>
        </div>
    </div>

    <script src="../script/scrip.js"></script>
</body>

</html>