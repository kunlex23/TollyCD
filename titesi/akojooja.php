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
                <a href="titẹsi.php">
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


                <a href="#">
                    <span class="material-icons-sharp"></span>
                    <h3></h3>
                </a>
            </div>
        </aside>
        <!------------ END OF ASIDE ------------>
        <main>
            <h1>Data Entry</h1>
            <div class="insight">
                <div class="sales">
                    <div class="middle">
                        <div class="left">
                            <h3>Total Clients</h3>
                            <div id="link_wrapper">

                            </div>
                        </div>

                    </div>
                    <!-- <small class="tex">Last 7 Days</small> -->
                </div>
                <!-- END OF STUDENTS -->
                <div class="expensis">
                    <div class="middle">
                        <div class="left">
                            <h3>Total Work</h3>
                            <div id="link_wrapper1">

                            </div>
                        </div>

                    </div>
                    <!-- <small class="text-muted">Last 24hrs</small> -->
                </div>
                <!-- END OF GRADUTE STUDES -->

                <div class="income">
                    <div class="middle">
                        <div class="left">
                            <h3>Total Work in Progress</h3>
                            <div id="link_wrapper2">

                            </div>
                        </div>

                    </div>
                    <!-- <small class="text-muted">Last 7 days</small> -->
                </div>

                <!-- END OF INCOME -->
            </div>
            <!-- ---------END OF EXAM-------- -->
            <div class="recent-sales">
                <h2>Recent Work</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Client</th>
                            <th>Style</th>
                            <th>Sewing</th>
                            <th>Entry Date</th>
                            <th>Due Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <?php
                    require 'config.php';
                    $query = mysqli_query($conn, "SELECT fullname, Style, Sewing, Entry_Date, Due_Date, StatusC FROM work ORDER BY fullname DESC LIMIT 10 ");
                    while ($row = mysqli_fetch_array($query)) {

                        $fullname = $row['fullname'];
                        $Style = $row['Style'];
                        $Sewing = $row['Sewing'];
                        $Entry_Date = $row['Entry_Date'];
                        $Due_Date = $row['Due_Date'];
                        $StatusC = $row['StatusC'];

                        ?>
                        <tbody>
                            <tr>
                                <td><?php echo $fullname; ?></td>
                                <td><?php echo $Style; ?></td>
                                <td><?php echo $Sewing; ?></td>
                                <td><?php echo $Entry_Date; ?></td>
                                <td><?php echo $Due_Date; ?></td>
                                <td><?php echo $StatusC; ?></td>
                        </tbody>
                    <?php } ?>
                </table>

                <a href="workRecord.php">Show all</a>
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
                        <small class="text-muted">Admin</small>
                    </div>
                </div>
            </div>

            <div class="sales-analytics">

                <a href="newClient.php">
                    <div class="item add-product">
                        <div>
                            <span class="material-icons-sharp">add</span>
                            <h3>New Client</h3>
                        </div>
                    </div>
                </a>

                <a href="newworkentry.php">
                    <div class="item add-product">
                        <div>
                            <span class="material-icons-sharp">add</span>
                            <h3>New Work</h3>
                        </div>
                    </div>
                </a>
                <span>
                    <h2>Delivery Focus</h2><span>Deliveries less than 8 Days</span>
                </span>
                <div class="item-online">
                    <div class="right">
                        <table style="width: 100%;" class="due_client">
                            <thead style="text-align: left;">
                                <tr>
                                    <th>Client</th>
                                    <th>Style</th>
                                    <th>Sewing</th>
                                    <th>Due Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sevenDaysFromNow = date('Y-m-d', strtotime('+7 days'));

                                $query = mysqli_query($conn, "SELECT fullname, style, sewing, Due_Date, status FROM work WHERE Due_Date BETWEEN CURDATE() AND '$sevenDaysFromNow' ORDER BY fullname ASC ");

                                while ($row = mysqli_fetch_array($query)) {
                                    $fullname = $row['fullname'];
                                    $style = $row['style'];
                                    $sewing = $row['sewing'];
                                    $Due_Date = $row['Due_Date'];
                                    $status = $row['status'];

                                    // Check if status is not equal to 0 before displaying the row
                                    if ($status != 0) {
                                        ?>
                                        <tr>
                                            <td><?php echo $fullname; ?></td>
                                            <td><?php echo $style; ?></td>
                                            <td><?php echo $sewing; ?></td>
                                            <td><?php echo $Due_Date; ?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>

                        </table>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="script/scrip.js"></script>
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