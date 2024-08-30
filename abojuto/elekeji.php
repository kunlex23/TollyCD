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
    <link rel="stylesheet" href="css/stylse.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        table,
        th,
        td {
            padding: 8px;
        }

        tr:nth-child(even),
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
                </div>
                <div class="closeBTN" id="close-btn">
                    <span class="material-icons-sharp">close</span>
                </div>
            </div>
            <div class="sideBar">
                <a href="index.php">
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
                    <span class="material-icons-sharp">pedal_bike</span>
                    <h3>Captain</h3>
                </a>

                <a href="iroeri.php" class="active">
                    <span class="material-icons-sharp">bar_chart</span>
                    <h3>Reports</h3>
                </a>

                <a href="../logout.php">
                    <span class="material-icons-sharp">logout</span>
                    <h3>Logout</h3>
                </a>
            </div>
        </aside>
        <!------------ END OF ASIDE ------------>
        <main>
            <h2>Captain Analytics</h2><br><br><br>

            <?php
            require '../config.php';

            // Initialize arrays for months and captains
            $months = [];
            for ($i = 0; $i < 12; $i++) {
                $months[] = date("Y-m", strtotime(date('Y-m-01') . " -$i months"));
            }
            $months = array_reverse($months);

            $captains = [];
            $data = [];

            // Query to get the profit for each captain by month
            $sql = "SELECT captain, DATE_FORMAT(date, '%Y-%m') AS month, SUM(profitReward) as total_profit 
            FROM gbigbe 
            WHERE date >= DATE_SUB(NOW(), INTERVAL 1 YEAR)
            GROUP BY captain, DATE_FORMAT(date, '%Y-%m')
            ORDER BY captain, month";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $captain = $row['captain'];
                    $month = $row['month'];
                    $profit = $row['total_profit'];

                    if (!isset($data[$captain])) {
                        $data[$captain] = array_fill(0, 12, 0);
                        $captains[] = $captain;
                    }

                    $index = array_search($month, $months);
                    if ($index !== false) {
                        $data[$captain][$index] = $profit;
                    }
                }
            }

            $conn->close();
            ?>
            <canvas id="myChart" width="400" height="200"></canvas><br><br>
            <div class="capAnalytics">
                <div class="classOne">
                    <h1>Top Delivery</h1>
                    <?php
                    require '../config.php';

                    // SQL query to find the captain with the highest delivery
                    $sql = "SELECT captain, COUNT(*) AS deliveryCount 
            FROM gbigbe 
            WHERE status = 'Completed' AND shipmentType = 'delivery' 
            GROUP BY captain 
            ORDER BY deliveryCount DESC 
            LIMIT 1";

                    if ($result = $conn->query($sql)) {
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $highestcaptain = $row['captain'];
                                $highestDelivery = $row['deliveryCount'];

                                echo '<h2>' . $highestcaptain . ': ' . $highestDelivery . ' deliveries</h2>';
                            }
                        } else {
                            echo '<p>No results found</p>';
                        }
                        $result->free();
                    } else {
                        echo '<p>Error executing query: ' . $conn->error . '</p>';
                    }
                    $conn->close();
                    ?>
                </div>
            
                <div class="classOne">
                    <h2>Top Returns</h2>
                    <?php
                    require '../config.php';

                    // SQL query to find the captain with the highest number of returns
                    $sql = "SELECT captain, COUNT(*) AS returnCount 
            FROM gbigbe 
            WHERE status = 'Return' 
            GROUP BY captain 
            ORDER BY returnCount DESC 
            LIMIT 1";

                    if ($result = $conn->query($sql)) {
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $highestcaptain = $row['captain'];
                                $highestReturns = $row['returnCount'];

                                echo '<h2>' . $highestcaptain . ': ' . $highestReturns . ' returns</h2>';
                            }
                        } else {
                            echo '<p>No returned shipment yet</p>';
                        }
                        $result->free();
                    } else {
                        echo '<p>Error executing query: ' . $conn->error . '</p>';
                    }
                    $conn->close();
                    ?>
                </div><br><br>
            
            
            </div>
            <script>
                // Get data from PHP
                var months = <?php echo json_encode($months); ?>;
                var captains = <?php echo json_encode($captains); ?>;
                var data = <?php echo json_encode($data); ?>;

                // Generate random colors for each captain
                var colors = [];
                for (var i = 0; i < captains.length; i++) {
                    colors.push('rgba(' + Math.floor(Math.random() * 256) + ',' +
                        Math.floor(Math.random() * 256) + ',' +
                        Math.floor(Math.random() * 256) + ', 0.2)');
                }

                // Create the datasets for each captain
                var datasets = [];
                for (var i = 0; i < captains.length; i++) {
                    datasets.push({
                        label: captains[i],
                        data: data[captains[i]],
                        backgroundColor: colors[i],
                        borderColor: colors[i].replace('0.2', '1'),
                        borderWidth: 1
                    });
                }

                // Create the chart
                var ctx = document.getElementById('myChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: months,
                        datasets: datasets
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            },
                            x: {
                                stacked: true
                            },
                            y: {
                                stacked: true
                            }
                        }
                    }
                });
            </script>
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
                        <p><b></b></p>
                    </div>
                </div>
            </div>

            <div class="sales-analytics">
                <a href="alakoko.php">
                    <div class="item add-product">
                        <div>
                            <span class="material-icons-sharp">groups</span>
                            <h3>captain Analytics</h3>
                        </div>
                    </div>
                </a>
                <a href="elekeji.php">
                    <div class="item add-product">
                        <div>
                            <span class="material-icons-sharp">directions_bike</span>
                            <h3>Captain Analytics</h3>
                        </div>
                    </div>
                </a>
                <a href="eleketa.php">
                    <div class="item add-product">
                        <div>
                            <span class="material-icons-sharp">payments</span>
                            <h3>Expenses Analytics</h3>
                        </div>
                    </div>
                </a>
                <a href="iroeri.php">
                    <div class="item add-product">
                        <div>
                            <span class="material-icons-sharp">stars</span>
                            <h3>Profit Analytics</h3>
                        </div>
                    </div>
                </a>


            </div>
        </div>
    </div>

    <script src="../script/scrip.js"></script>
</body>

</html>