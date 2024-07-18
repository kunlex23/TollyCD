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
                <a href="alabasepo.php" class="active">
                    <span class="material-icons-sharp">groups</span>
                    <h3>Partners</h3>
                </a>
                <a href="oja.php">
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

            <!-- ---------END OF EXAM-------- -->
            <div class="recent-sales">
                <h1>Update Stock</h1>
                <?php
                require '../config.php';

                if (isset($_GET['productId'])) {
                    $clientID = $_GET['productId'];

                    // Fetch the client data by clientID
                    $sql = "SELECT * FROM products WHERE id = '$clientID'";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        // Display a form with input fields to edit the data
                        echo '<form method="post" action="gbigbeatunwowolekeji.php">
                    <input type="hidden" Name="id" value="' . $row['id'] . '">
                    <input type="hidden" Name="partner" value="' . $row['partner'] . '">
                    <input type="hidden" Name="oja" value="' . $row['productName'] . '">
                    

                    <div class="tray0">
                        ' . $row['partner'] . '
                    </div>

                    <div class="tray1">
                        ' . $row['productName'] . '
                    </div>
                    <div class="tray2">
                        Quantity: <input type="number" name="quantity" value="' . $row['quantity'] . '"><br>
                        
                    </div>';

                        // Add more input fields for other data as needed
                        echo '<input type="submit" value="Save Changes">';
                        echo '</form>';
                    } else {
                        echo "No data found";
                    }
                } else {
                    echo "Invalid client ID.";
                }

                $conn->close();
                ?>
            </div>
        </main>
        <!-- ----------END OF MAIN----------- -->
        <div class="right">
            <div class="top">
                <button id="menu-btn">
                    <span class="material-icons-sharp">menu</span>
                </button>
                <div class="theme-toggler">
                    <span class="material-icons-sharp active">light_mode</span>
                    <span class="material-icons-sharp">dark_mode</span>
                </div>
            </div> <!-- -----------END OF RECENT UPDATE--------------- -->

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
        </div>
    </div>
    <script src="../script/scrip.js"></script>
</body>

</html>