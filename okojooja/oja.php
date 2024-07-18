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

                <a href="../logout.php">
                    <span class="material-icons-sharp">logout</span>
                    <h3>Logout</h3>
                </a>
            </div>
        </aside>
        <!------------ END OF ASIDE ------------>
        <main>
            <div class="recent-sales">
                <h1>Products</h1>

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

                        $query = mysqli_query($conn, "SELECT partner, productName, quantity FROM products ORDER BY partner DESC");
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
                <a href="ojatitun.php">
                    <div class="item add-product">
                        <div>
                            <span class="material-icons-sharp">add</span>
                            <h3>New Product</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="sales-analytics">
                <a href="ojatitunpipo.php">
                    <div class="item add-product">
                        <div>
                            <span class="material-icons-sharp">add</span>
                            <h3>Multi Entry</h3>
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

    rows.forEach(function (row) {
        var fullnameLink = row.querySelector('td:first-child a');

        fullnameLink.addEventListener('click', function (event) {
            event.preventDefault();

            var fullname = fullnameLink.textContent;

            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'update_status.php?fullname=' + encodeURIComponent(fullname), true);

            xhr.onreadystatechange = function () {
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
    document.addEventListener('DOMContentLoaded', function () {
        var statusFilter = document.getElementById('statusFilter');
        var tableRows = document.querySelectorAll('#table-body tr');

        statusFilter.addEventListener('change', function () {
            var selectedStatus = statusFilter.value.toLowerCase();

            tableRows.forEach(function (row) {
                var rowStatus = row.querySelector('td:nth-child(6)').textContent.toLowerCase();

                if (selectedStatus === 'all' || (selectedStatus === 'done' && rowStatus === 'done') || (selectedStatus === 'progress' && rowStatus.includes('progress'))) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
</script>