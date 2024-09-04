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
    select{
        width: 10rem;
        padding: 0.4rem;
        border-radius: 0.2rem;
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
                <a href="newUser.php" class="active">
                    <span class="material-icons-sharp">manage_accounts</span>
                    <h3>Users</h3>
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
                <h1>Create Account</h1>

                <form class="five-column-form" action="signup.php" method="POST" enctype="multipart/form-data"
                    autocomplete="off">
                    <div class="error-text"></div>
                    <div id="fields-container">
                        <div class="field-container">
                            <div class="field-group">
                                <label for="name">Full Name:</label>
                                <input type="text" name="fullName" required>
                            </div>
                            <div class="field-group">
                                <label for="userId">User ID:</label>
                                <input type="text" name="userId" required>
                            </div>
                            <div class="field-group">
                                <label for="password">New Password:</label>
                                <input type="text" name="password" required>
                            </div>
                            <div class="field-group">
                                <label for="user">user:</label>
                                <select name="user" required>
                                    <option value="">Select user type...</option>
                                    <option value="Accountant">Accountant</option>
                                    <option value="Data_Entry">Data Entry</option>
                                    <option value="Inventory">Inventory</option>
                                    <option value="Admin">Admin</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="button-container">
                        <div class="job">
                            <input type="submit" name="submit" value="Sign Up"
                                style="background-color: #025a1a; color:white">
                        </div>
                    </div><br><br>
                </form>

                <table style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>User ID</th>
                            <th>User Type</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <?php
                        require '../config.php';

                        $query = mysqli_query($conn, "SELECT id, fullName, userId, userType, date FROM users ORDER BY fullName DESC");
                        if (!$query) {
                            die('Query Failed: ' . mysqli_error($conn));
                        }

                        while ($row = mysqli_fetch_array($query)) {
                            $id = $row['id'];
                            $fullName = $row['fullName'];
                            $userId = $row['userId'];
                            $userType = $row['userType'];
                            $date = $row['date'];
                            ?>
                        <tr>
                            <td><?php echo htmlspecialchars($fullName); ?></td>
                            <td><?php echo htmlspecialchars($userId); ?></td>
                            <td><?php echo htmlspecialchars($userType); ?></td>
                            <td><?php echo htmlspecialchars($date); ?></td>
                            <td>
                                <form action="yo_OMOSE.php" method="post"
                                    onsubmit="return confirm('Are you sure you want to delete this user?');">
                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                                    <button type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
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