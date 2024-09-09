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
                <a href="newCaptain.php">
                    <span class="material-icons-sharp">pedal_bike</span>
                    <h3>Captain</h3>
                </a>
                <a href="agent.php" class="active">
                    <span class="material-icons-sharp">manage_accounts</span>
                    <h3>Agent</h3>
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
        <?php
        require '../config.php';

        // Insert new agent
        if (isset($_POST['submit'])) {
            $fullname = mysqli_real_escape_string($conn, $_POST['fullName']);
            $contact = mysqli_real_escape_string($conn, $_POST['contact']);

            $query = "INSERT INTO agent (fullname, contact, date) VALUES ('$fullname', '$contact', NOW())";

            if (mysqli_query($conn, $query)) {
                echo '<script>window.location.href = "./agent.php";</script>';
            } else {
                die('Error: ' . mysqli_error($conn));
            }
        }

        // Edit agent
        if (isset($_POST['edit'])) {
            $id = $_POST['id'];
            $fullname = mysqli_real_escape_string($conn, $_POST['fullName']);
            $contact = mysqli_real_escape_string($conn, $_POST['contact']);

            $query = "UPDATE agent SET fullname='$fullname', contact='$contact' WHERE id='$id'";

            if (mysqli_query($conn, $query)) {
                echo '<script>window.location.href = "./agent.php";</script>';
            } else {
                die('Error: ' . mysqli_error($conn));
            }
        }

        // Delete agent
        if (isset($_POST['delete'])) {
            $id = $_POST['id'];

            $query = "DELETE FROM agent WHERE id='$id'";

            if (mysqli_query($conn, $query)) {
                echo '<script>window.location.href = "./agent.php";</script>';
            } else {
                die('Error: ' . mysqli_error($conn));
            }
        }
        ?>
        
        <main>
            <div class="recent-sales">
                <h1>Agents</h1><br><br>
                <h3>New Agent</h3><br>
        
                <form class="five-column-form" action="" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <div class="error-text"></div>
                    <div id="fields-container">
                        <div class="field-container">
                            <div class="field-group">
                                <label for="name">Full Name:</label>
                                <input type="text" name="fullName" required>
                            </div>
                            <div class="field-group">
                                <label for="contact">Contact:</label>
                                <input type="text" name="contact" required>
                            </div>
                        </div>
                    </div>
                    <div class="button-container">
                        <div class="job">
                            <input type="submit" name="submit" value="Add Agent" style="background-color: #025a1a; color:white">
                        </div>
                    </div><br><br>
                </form>
        
                <div class="spacer"></div>
                <table style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Fullname</th>
                            <th>Contact</th>
                            <th>Date</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <?php
                        $query = mysqli_query($conn, "SELECT id, fullname, contact, date FROM agent ORDER BY fullname ASC");
                        if (!$query) {
                            die('Query Failed: ' . mysqli_error($conn));
                        }

                        while ($row = mysqli_fetch_array($query)) {
                            $id = $row['id'];
                            $fullname = $row['fullname'];
                            $contact = $row['contact'];
                            $date = $row['date'];
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($fullname); ?></td>
                                <td><?php echo htmlspecialchars($contact); ?></td>
                                <td><?php echo htmlspecialchars($date); ?></td>
                                                               <td>
                                    <form method="POST" action="">
                                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                                        <input type="submit" name="delete" value="Delete">
                                    </form>
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