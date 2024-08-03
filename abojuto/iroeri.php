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

                <a href="inawo.php">
                    <span class="material-icons-sharp">paid</span>
                    <h3>Expenses</h3>
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
            <h2>Profit Analytics</h2><br><br><br>
            
            <?php
            require '../config.php'; 
            $months = [];
            for ($i = 0; $i < 12; $i++) {
                $months[] = date("Y-m", strtotime(date('Y-m-01') . " -$i months"));
            }
            $months = array_reverse($months); 
            $profit = array_fill(0, 12, 0);

            $sql = "SELECT DATE_FORMAT(date, '%Y-%m') AS month, SUM(profitReward) as total_amount 
                        FROM gbigbe 
                        WHERE date >= DATE_SUB(NOW(), INTERVAL 1 YEAR)
                        GROUP BY DATE_FORMAT(date, '%Y-%m')";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $index = array_search($row['month'], $months);
                    if ($index !== false) {
                        $profit[$index] = $row['total_amount'];
                    }
                }
            }

            $conn->close();
            ?>
            <canvas id="myChart" width="400" height="200"></canvas>
            <script>
                // Get data from PHP
                var months = <?php echo json_encode($months); ?>;
                var profit = <?php echo json_encode($profit); ?>;

                // Create the chart
                var ctx = document.getElementById('myChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: months,
                        datasets: [{
                            label: 'Profit',
                            data: profit,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
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
                            <h3>Partner Analytics</h3>
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
                <a href="elekerin.php">
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