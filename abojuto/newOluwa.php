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
                <a href="ninan.php">
                    <span class="material-icons-sharp">inventory</span>
                    <h3>Pricing</h3>
                </a>
                <a href="newUser.php">
                    <span class="material-icons-sharp">manage_accounts</span>
                    <h3>Users</h3>
                </a>
                <a href="newCaptain.php" class="active">
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
                <h1> New Captain</h1><br>
                <div></div><br>

                <form class="five-column-form" action="okadaTitun.php" method="POST">
                    <div id="fields-container">
                        <div class="field-container">
                            <div class="field-group">
                                <label for="fullname">Fullname:</label>
                                <input type="text" name="fullname[]" required><br>

                                <label for="contact">Contact:</label>
                                <input type="text" name="contact[]" required><br>
                            </div>
                            <div class="field-group">
                                <label for="Address">Address:</label>
                                <input type="text" name="Address[]" required><br>

                                <label for="accountNumber">Account Number:</label>
                                <input type="text" name="accountNumber[]" required><br>


                            </div>
                            <div class="field-group">
                                <label for="accountName">Account Name:</label>
                                <input type="text" name="accountName[]" required><br>

                                <label for="bankName">Bank Name:</label>
                                <input type="text" name="bankName[]" required><br>

                            </div>

                        </div><br>
                        <h2>Guarantor's Details</h2>
                        <div class="field-container">
                            <div class="field-group">
                                <label for="gFullname">Fullname:</label>
                                <input type="text" name="gFullname[]" required>

                                <label for="gFontact">Contact:</label>
                                <input type="text" name="gFontact[]" required>
                           
                                <label for="gAddress">Address:</label>
                                <input type="text" name="gAddress[]" required>

                                <label for="occupation">Occupation:</label>
                                <input type="text" name="occupation[]" required>
                                
                                <label for="relationship">Relationship:</label>
                                <input type="text" name="relationship[]" required>
                            </div>



                        </div>
                    </div>
                    <div class="button-container">
                        <div class="job">
                            <input type="submit" value="Submit">
                        </div>
                    </div>
                    

                </form>

                <div class="spacer"></div>

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
                <a href="newOluwa.php">
                    <div class="item add-product">
                        <div>
                            <span class="material-icons-sharp">add</span>
                            <h3>New Captain</h3>
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
                            <td><?php echo $partner; ?></td>
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