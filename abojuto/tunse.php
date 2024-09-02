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
    <title>Edit Location and Pricing</title>
    <!-- Material app -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <!-- style -->
    <link rel="stylesheet" href="css/styls.css">
    <style>
        table,
        th,
        td {
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
                <a href="ninan.php" class="active">
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
                <a href="newCaptain.php">
                    <span class="material-icons-sharp">pedal_bike</span>
                    <h3>Captain</h3>
                </a>
                <a href="iroeri.php">
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
            <div class="recent-sales">
                <h1>Edit Location and Pricing</h1>
                <div class="spacer"></div>
                <div class="spacer"></div>

                <?php
                require '../config.php';

                if (isset($_GET['location'])) {
                    $location = urldecode($_GET['location']);

                    // Fetch the current data
                    $query = mysqli_query($conn, "SELECT * FROM ninawo WHERE location = '$location'");
                    if (!$query) {
                        die('Query Failed: ' . mysqli_error($conn));
                    }

                    $row = mysqli_fetch_array($query);

                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $newPartnerPrice = $_POST['partnerPrice'];
                        $newDispatcherPrice = $_POST['dispatcherPrice'];
                        $newProfit = $newPartnerPrice - $newDispatcherPrice;

                        // Update the record
                        $updateQuery = "UPDATE ninawo SET partnerPrice = '$newPartnerPrice', dispatcherPrice = '$newDispatcherPrice', profit = '$newProfit' WHERE location = '$location'";
                        if (mysqli_query($conn, $updateQuery)) {
                            echo '<script>alert("Record updated successfully!");</script>';
                            echo '<script>window.location.href = "ninan.php";</script>';
                            exit();
                        } else {
                            die('Update Failed: ' . mysqli_error($conn));
                        }
                    }
                } else {
                    echo 'No location specified.';
                    exit();
                }
                ?>

                <form class="five-column-form" action="" method="POST">
                    <div id="fields-container">
                        <div class="field-container">
                            <div class="field-group">
                                <label for="location">Location:</label>
                                <input type="text" name="location"
                                    value="<?php echo htmlspecialchars($row['location']); ?>" readonly>

                                <label for="partnerPrice">Partner Price:</label>
                                <input type="text" id="partnerPrice" name="partnerPrice"
                                    value="<?php echo htmlspecialchars($row['partnerPrice']); ?>" required
                                    oninput="calculateProfit(this)">

                                <label for="dispatcherPrice">Dispatcher Price:</label>
                                <input type="text" id="dispatcherPrice" name="dispatcherPrice"
                                    value="<?php echo htmlspecialchars($row['dispatcherPrice']); ?>" required
                                    oninput="calculateProfit(this)">

                                <label for="profit">Profit:</label>
                                <input type="text" id="profit" name="profit"
                                    value="<?php echo htmlspecialchars($row['profit']); ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div id="notification" class="notification hidden">New record created successfully!</div>
                    <div class="button-container">
                        <div class="job">
                            <input type="submit" value="Update">
                        </div>
                    </div>
                </form>
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
                        <p><b></b></p>
                    </div>
                </div>
            </div>

            <div class="sales-analytics">
                <a href="newalabasepo.php">
                    <div class="item add-product">
                        <div>
                            <span class="material-icons-sharp">add</span>
                            <h3>New Partner</h3>
                        </div>
                    </div>
                </a>
                <a href="ojatitun.php">
                    <div class="item add-product">
                        <div>
                            <span class="material-icons-sharp">add</span>
                            <h3>New Product</h3>
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
                        $query = mysqli_query($conn, "SELECT partner, productName, quantity FROM products WHERE quantity < 5 ORDER BY partner DESC LIMIT 10");

                        while ($row = mysqli_fetch_array($query)) {
                            $partner = $row['partner'];
                            $productName = $row['productName'];
                            $quantity = $row['quantity'];
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($partner); ?></td>
                                <td><?php echo htmlspecialchars($productName); ?></td>
                                <td><?php echo htmlspecialchars($quantity); ?></td>
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
    <script>
        function calculateProfit(element) {
            const partnerPrice = parseFloat(document.getElementById('partnerPrice').value) || 0;
            const dispatcherPrice = parseFloat(document.getElementById('dispatcherPrice').value) || 0;
            const profit = partnerPrice - dispatcherPrice;
            document.getElementById('profit').value = profit.toFixed(2);
        }
    </script>
</body>

</html>