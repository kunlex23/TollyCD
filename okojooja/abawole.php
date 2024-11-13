<?php
session_start();
if (!isset($_SESSION['userType'])) {
    header("location: ../index.php");
} elseif (($_SESSION['userType']) == "Inventory") {
} elseif (($_SESSION['userType']) == "Data_Entry") {
    header("Location: ../titesi");
} elseif (($_SESSION['userType']) == "Accountant") {
    header("Location: ../onisiro");
} elseif (($_SESSION['userType']) == "Admin") {
    // echo "<button>check</button>";
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
    <link rel="stylesheet" href="css/style.css">
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
     .navbar {
            display: flex;
            justify-content: center;
            margin-top: 2rem;
            margin-bottom: 2rem;
        }

        /* Styling for individual navigation buttons */
        .nav-button {
            margin: 0 15px; /* Space between buttons */
            padding: 0.8rem;
            font-size: 16px;
            color: white;
            background-color: #007BFF;
            border: none;
            border-radius: 2rem;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            width: 3rem;
            height: 3rem;
        }

        /* Styling for button hover effect */
        .nav-button:hover {
            background-color: #0056b3;
        }
        .wole{
            margin-top: 5rem;
            font-size: 16px;
            padding: 2rem;
        }
        .wole input{
            width: 300px;
            height: 2rem;
        }
        /* Button Styles */
.btn {
    background-color: #4CAF50; 
    color: white;              
    padding: 10px 20px;        
    border: none;              
    border-radius: 5px;        
    cursor: pointer;           
    font-size: 16px;           
    margin-left: 2rem;
}

/* Add a hover effect */
.btn:hover {
    background-color: #45a049; /* Darker green on hover */
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
                <a href="oja.php">
                    <span class="material-icons-sharp">inventory</span>
                    <h3>Products</h3>
                </a>

                <a href="gbigbeTitun2.php">
                    <span class="material-icons-sharp">add</span>
                    <h3>Create Waybill</h3>
                </a>

                <a href="records.php">
                    <span class="material-icons-sharp">local_shipping</span>
                    <h3>Active Waybills</h3>
                </a>


                <a href="awe.php">
                    <span class="material-icons-sharp">history</span>
                    <h3>Waybill History</h3>
                </a>

                <a href="abawole.php" class="active">
                    <span class="material-icons-sharp">manage_accounts</span>
                    <h3>Change Password</h3>
                </a>

                <a href="../logout.php">
                    <span class="material-icons-sharp">logout</span>
                    <h3>Logout</h3>
                </a>
            </div>
        </aside>
        <!------------ END OF ASIDE ------------>
        <main>
           

    <h2>Change Password</h2>
    <form action="abawolee.php" method="POST">
        <div class="wole">
            <label for="oldPassword">Current Password:</label><br>
        <input type="password" id="oldPassword" name="oldPassword" required><br><br>

        <label for="newPassword">New Password:</label><br>
        <input type="password" id="newPassword" name="newPassword" required><br><br>

        <label for="confirmPassword">Confirm New Password:</label><br>
        <input type="password" id="confirmPassword" name="confirmPassword" required><br><br>

        </div>
        <div class="woleBTN">
            <input type="submit" value="Change Password" class="btn">

        </div>
    </form>
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
<?php
    if ($_SESSION['userType'] == "Admin") {
        echo "<div class='navbar'>";
        echo "<a href='../okojooja' class='nav-button'>I</a>";
        echo "<a href='../titesi' class='nav-button'>D</a>";
        echo "<a href='../onisiro' class='nav-button'>A</a>";
        echo "<a href='../abojuto' class='nav-button'>AD</a>";
        echo "</div>";
    }
    ?>
    <div class="sales-analytics">
        <a href="newalabasepo.php">
            <div class="item add-product">
                <div>
                    <span class="material-icons-sharp">add</span>
                    <h3>New Partner</h3>
                </div>
            </div>
        </a>
        <a href="ojatitunpipo.php">
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
                        <td> <?php echo $partner; ?></td>
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