<?php
// session_start();
// if ($_SESSION['userType'] === 'eru') {
//     header("Location: ../okojooja");
// } elseif ($_SESSION['userType'] === 'fifisi') {
//     header("Location: ../titesi");
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

                <a href="sisanwo.php">
                    <span class="material-icons-sharp">history</span>
                    <h3>Partner Payment History</h3>
                </a>

                <a href="sisanwokeji.php "class="active">
                    <span class="material-icons-sharp">history</span>
                    <h3>Captain Payment History</h3>
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
            <!-- ---------END OF EXAM-------- -->
            <div class="recent-sales">
                <div class="spacer"></div>
                <h2>Captain Payment History</h2>

                <!-- Date Range Form -->
                <div class="spacer"></div>
                <form method="post" action="">
                    <label for="start-date">Start Date:</label>
                    <input type="date" id="start-date" name="start-date" required>
                    <label for="end-date">End Date:</label>
                    <input type="date" id="end-date" name="end-date" required>
                    <button type="submit">Filter</button>
                </form>

                <div class="spacer"></div>
                <table style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Captain</th>
                            <th>Amount</th>
                            <th>Account Number</th>
                            <th>Bank</th>
                            <th>Account Name</th>
                            <th>Date</th>
                            <th>View</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <?php
                        require '../config.php';

                        // Initialize variables for the date range
                        $start_date = isset($_POST['start-date']) ? $_POST['start-date'] : null;
                        $end_date = isset($_POST['end-date']) ? $_POST['end-date'] : null;

                        // Debugging: Print the received dates
                        //echo "Start Date: $start_date, End Date: $end_date";
                        
                        // Build the query based on the date range
                        $query_string = "SELECT captain, amount, accountNumber, bank, accountName, date, payID FROM olokadahistory";
                        if ($start_date && $end_date) {
                            $query_string .= " WHERE date BETWEEN '$start_date' AND '$end_date'";
                        }
                        $query_string .= " ORDER BY captain DESC";

                        // Debugging: Print the query string
                        //echo $query_string;
                        
                        $query = mysqli_query($conn, $query_string);

                        if (!$query) {
                            // Debugging: Print the MySQL error
                            //echo "Error: " . mysqli_error($conn);
                        }

                        while ($row = mysqli_fetch_array($query)) {
                            $captain = $row['captain'];
                            $amount = $row['amount'];
                            $accountNumber = $row['accountNumber'];
                            $bank = $row['bank'];
                            $accountName = $row['accountName'];
                            $date = $row['date'];
                            $payID = $row['payID'];
                            ?>
                            <tr>
                                <td><?php echo $captain; ?></td>
                                <td><?php echo $amount; ?></td>
                                <td><?php echo $accountNumber; ?></td>
                                <td><?php echo $bank; ?></td>
                                <td><?php echo $accountName; ?></td>
                                <td><?php echo $date; ?></td>
                                <td><a
                                        href="eri1.php?oluwa=<?php echo urlencode($captain); ?>&eri=<?php echo urlencode($payID); ?>">View</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
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