<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zibah</title>
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
                <a href="titẹsi.php">
                    <span class="material-icons-sharp">grid_view</span>
                    <h3>Dashboard</h3>
                </a>
                <a href="alabasepo.php">
                    <span class="material-icons-sharp">local_library</span>
                    <h3>Partners</h3>
                </a>
                <a href="oja.php" class="active">
                    <span class="material-icons-sharp">local_library</span>
                    <h3>Products</h3>
                </a>
                <a href="akojooja.php">
                    <span class="material-icons-sharp">person_outline</span>
                    <h3>Inventory</h3>
                </a>


                <a href="#">
                    <span class="material-icons-sharp"></span>
                    <h3></h3>
                </a>
            </div>
        </aside>
        <!------------ END OF ASIDE ------------>
        <main>

            <!-- ---------END OF EXAM-------- -->
            <div class="recent-sales">
                <h1>New Client</h1>
                <form class="five-column-form" action="alabasepotitun.php" method="POST">
                    <div class="tray0">
                        <label for="Name">Name:</label>
                        <input type="text" name="Name" required><br>

                    </div>

                    <div class="tray0">
                        <label for="productName">productName:</label>
                        <input type="text" name="productName" required><br>
                    </div>

                    <div class="tray0">
                        <label for="quantity">Quantity:</label>
                        <input type="text" name="quantity" required><br>
                    </div>

                    
                    <div id="notification" class="notification hidden"> New record created successfully!</div>
                    <div class="job"><input type="submit" value="Submit"></div>
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
                    <span class="material-icons-sharp active">light_mode</span>
                    <span class="material-icons-sharp">dark_mode</span>
                </div>
            </div>
            <div class="sales-analytics">
                <a href="newWorkentry.php">
                    <div class="item add-product">
                        <div>
                            <span class="material-icons-sharp">add</span>
                            <h3>New Work</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="sales-analytics">
                <a href="newClient.php">
                    <div class="item add-product">
                        <div>
                            <span class="material-icons-sharp">add</span>
                            <h3>New Client</h3>
                        </div>
                    </div>
                </a>
            </div>
            <form action="./wiwa.php" method="GET">
                <label for="Name">Partner:</label>
                <select name="Name" required>
                    <option value="">Select a partner</option>
                    <?php
                    require '../config.php';
                    $sql = "SELECT Name FROM alabasepo";
                    $result = $conn->query($sql);
                    // Generate options for the combo box
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row["Name"] . '">' . $row["Name"] .  '</option>';
                        }
                    }
                    ?>
                    <input type="submit" value="Search">
            </form>
        </div>
    </div>
       <script src="../script/scrip.js"></script>
</body>

</html>