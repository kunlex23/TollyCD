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
                <a href="newCaptain.php" class="active">
                    <span class="material-icons-sharp">pedal_bike</span>
                    <h3>Captain</h3>
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
                <h1>Captains</h1><br>
                
                <div class="spacer"></div>
                <table style="width: 100%;">
    <thead>
        <tr>
            <th>Fullname</th>
            <th>Contact</th>
            <th>Address</th>
            <th>Acc. Number</th>
            <th>Acc. Name</th>
            <th>Bank</th>
            <th>Guarantor's Fullname</th>
            <th>Guarantor's Contact</th>
            <th>Guarantor's Address</th>
            <th>Occupation</th>
            <th>Relationship</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody id="table-body">
        <?php
                        require '../config.php';

                        $query = mysqli_query($conn, "SELECT fullname, contact, address, accountNumber, accountName, bankName, gFullname, gContact, gAddress, occupation, relationship FROM oluwa ORDER BY fullname ASC");
                        if (!$query) {
                            die('Query Failed: ' . mysqli_error($conn));
                        }

                        while ($row = mysqli_fetch_array($query)) {
                            $fullname = $row['fullname'];
                            $contact = $row['contact'];
                            $address = $row['address'];
                            $accountNumber = $row['accountNumber'];
                            $accountName = $row['accountName'];
                            $bankName = $row['bankName'];
                            $gFullname = $row['gFullname'];
                            $gContact = $row['gContact'];
                            $gAddress = $row['gAddress'];
                            $occupation = $row['occupation'];
                            $relationship = $row['relationship'];
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($fullname); ?></td>
                                <td><?php echo htmlspecialchars($contact); ?></td>
                                <td><?php echo htmlspecialchars($address); ?></td>
                                <td><?php echo htmlspecialchars($accountNumber); ?></td>
                                <td><?php echo htmlspecialchars($accountName); ?></td>
                                <td><?php echo htmlspecialchars($bankName); ?></td>
                                <td><?php echo htmlspecialchars($gFullname); ?></td>
                                <td><?php echo htmlspecialchars($gContact); ?></td>
                                <td><?php echo htmlspecialchars($gAddress); ?></td>
                                <td><?php echo htmlspecialchars($occupation); ?></td>
                                <td><?php echo htmlspecialchars($relationship); ?></td>
                                <td><a href="tunokadase.php?fullname=<?php echo urlencode($fullname); ?>">Edit</a></td>
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