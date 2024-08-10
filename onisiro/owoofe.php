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
</head>

<body>
    <div class="container">
        <aside>
            <div class="top">
                <div class="logo">
                    <img src="./images/logo.png">
                </div>
                <div class="closeBTN" id="close-btn"><span class="material-icons-sharp">close</span></div>
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

                 <a href="oroowo.php">
                    <span class="material-icons-sharp">history</span>
                    <h3>Payment History</h3>
                </a>

                <a href="iranse.php">
                    <span class="material-icons-sharp">garage</span>
                    <h3>Waybill</h3>
                </a>

                <a href="owoofe.php" class="active">
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
        <main>
            <div class="recent-sales">
                <h1>Gifts & Others</h1><br>
                <form class="five-column-form" action="ofe.php" method="POST">
                    <div>
                        <label for="fromW">From:</label>
                        <input type="text" name="fromW[]" required><br>
                    </div>
                    <div class="tray1">
                        <div>
                            <label for="amount">Amount:</label>
                            <input type="text" name="amount[]" required><br>
                        </div>
                    </div>
                    <div class="tray2">
                        <div>
                            <label for="purpose">Purpose:</label>
                            <input type="text" name="purpose[]" required><br>
                        </div>
                    </div>
                    <div id="notification" class="notification hidden">New record created successfully!</div>
                    <div class="button-container">
                        <div class="job"><input type="submit" value="Submit"></div>
                    </div>
                </form>

                <div class="spacer"></div><br>  
                <h2>Gifts Records</h2>
                <div class="spacer"></div>
                <input type="text" id="filterInput" placeholder="Search..." onkeyup="filterTable()">
                <table id="shipmentTable" style="width: 100%;">
                    <thead>
                        <tr>
                            <!-- <th>ID</th> -->
                            <th>From</th>
                            <th>Amount</th>
                            <th>Purpose</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <?php
                        require '../config.php';

                        $query = mysqli_query($conn, "SELECT id, fromW, amount, purpose, date  FROM others_gifts ORDER BY purpose DESC ");
                        while ($row = mysqli_fetch_array($query)) {
                            $fromW = $row['fromW'];
                            $amount = $row['amount'];
                            $purpose = $row['purpose'];
                            $date = $row['date'];
                            ?>
                            <tr>
                                <td><?php echo $fromW; ?></td>
                                <td><?php echo $amount; ?></td>
                                <td><?php echo $purpose; ?></td>
                                <td><?php echo $date; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

            </div>
        </main>
        <div class="right">
            <div class="top">
                <button id="menu-btn"><span class="material-icons-sharp">menu</span></button>
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

        </div>
    </div>

    <script src="../script/scrip.js"></script>


    <script>
        function filterTable() {
            // Get the value of the input field
            let input = document.getElementById('filterInput');
            let filter = input.value.toUpperCase();

            // Get the table and its rows
            let table = document.getElementById('shipmentTable');
            let tr = table.getElementsByTagName('tr');

            // Loop through all table rows, except the first (header) row
            for (let i = 1; i <script tr.length; i++) {
                // Get the first cell (product name) in the row
                let td = tr[i].getElementsByTagName('td')[0];
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