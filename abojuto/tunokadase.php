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
                <h1>Edit Record</h1><br>
                <div class="spacer"></div>
                <div class="spacer"></div>

                <?php
                require '../config.php';

                if (isset($_GET['fullname'])) {
                    $fullname = urldecode($_GET['fullname']);

                    // Fetch the current data
                    $query = mysqli_query($conn, "SELECT * FROM oluwa WHERE fullname = '$fullname'");
                    if (!$query) {
                        die('Query Failed: ' . mysqli_error($conn));
                    }

                    $row = mysqli_fetch_array($query);

                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $old_fullname = $_POST['old_fullname'];
                        $newFullname = $_POST['fullname'];
                        $newContact = $_POST['contact'];
                        $newAddress = $_POST['address'];
                        $newAccountNumber = $_POST['accountNumber'];
                        $newAccountName = $_POST['accountName'];
                        $newBankName = $_POST['bankName'];
                        $newGFullname = $_POST['gFullname'];
                        $newGContact = $_POST['gContact'];
                        $newGAddress = $_POST['gAddress'];
                        $newOccupation = $_POST['occupation'];
                        $newRelationship = $_POST['relationship'];

                        // Update the record
                        $updateQuery = "UPDATE oluwa SET 
                            fullname = '$newFullname',
                            contact = '$newContact',
                            address = '$newAddress',
                            accountNumber = '$newAccountNumber',
                            accountName = '$newAccountName',
                            bankName = '$newBankName',
                            gFullname = '$newGFullname',
                            gContact = '$newGContact',
                            gAddress = '$newGAddress',
                            occupation = '$newOccupation',
                            relationship = '$newRelationship'
                            WHERE fullname = '$old_fullname'";

                        if (mysqli_query($conn, $updateQuery)) {
                            echo '<script>alert("Record updated successfully!");</script>';
                            echo '<script>window.location.href = "newCaptain.php";</script>';
                            exit();
                        } else {
                            die('Update Failed: ' . mysqli_error($conn));
                        }
                    }
                } else {
                    echo 'No fullname specified.';
                    exit();
                }
                ?>

                <form class="five-column-form" action="" method="POST">
                    <div id="fields-container">
                        <div class="field-container">
                            <div class="field-group">
                                <input type="hidden" name="old_fullname"
                                    value="<?php echo htmlspecialchars($row['fullname']); ?>" required>

                                <label for="fullname">Fullname:</label>
                                <input type="text" name="fullname"
                                    value="<?php echo htmlspecialchars($row['fullname']); ?>" required><br>

                                <label for="contact">Contact:</label>
                                <input type="text" name="contact"
                                    value="<?php echo htmlspecialchars($row['contact']); ?>" required><br>

                                <label for="address">Address:</label>
                                <input type="text" name="address"
                                    value="<?php echo htmlspecialchars($row['Address']); ?>" required><br>
                            </div>
                            <div class="field-group">

                                <label for="accountNumber">Account Number:</label>
                                <input type="text" name="accountNumber"
                                    value="<?php echo htmlspecialchars($row['accountNumber']); ?>" required><br>

                                <label for="accountName">Account Name:</label>
                                <input type="text" name="accountName"
                                    value="<?php echo htmlspecialchars($row['accountName']); ?>" required><br>

                                <label for="bankName">Bank Name:</label>
                                <input type="text" name="bankName"
                                    value="<?php echo htmlspecialchars($row['bankName']); ?>" required><br>
                            </div>
                            <div class="field-group">
                                <label for="gFullname">Guarantor's Fullname:</label>
                                <input type="text" name="gFullname"
                                    value="<?php echo htmlspecialchars($row['gFullname']); ?>" required><br>

                                <label for="gContact">Guarantor's Contact:</label>
                                <input type="text" name="gContact"
                                    value="<?php echo htmlspecialchars($row['gContact']); ?>" required><br>

                                <label for="gAddress">Guarantor's Address:</label>
                                <input type="text" name="gAddress"
                                    value="<?php echo htmlspecialchars($row['gAddress']); ?>" required><br>
                            </div>
                            <div class="field-group">
                                <label for="occupation">Occupation:</label>
                                <input type="text" name="occupation"
                                    value="<?php echo htmlspecialchars($row['occupation']); ?>" required><br>

                                <label for="relationship">Relationship:</label>
                                <input type="text" name="relationship"
                                    value="<?php echo htmlspecialchars($row['relationship']); ?>" required><br>
                                <div class="button-container">
                                    <div class="job">
                                        <input type="submit" value="Update">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 
                    <div class="button-container">
                        <div class="job">
                            <input type="submit" value="Update">
                        </div>
                    </div> -->
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