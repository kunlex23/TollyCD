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
                    <span class="material-icons-sharp">inventory</span>
                    <h3>New User</h3>
                </a>
            </div>
        </aside>
        <!------------ END OF ASIDE ------------>
        <main>
            <div class="recent-sales">
                <h1>Location and Pricing</h1>
                <form class="five-column-form" action="ninawowole.php" method="POST">
                    <div id="fields-container">
                        <div class="field-container">
                            <div class="field-group">
                                <label for="location">Location:</label>
                                <input type="text" name="location[]" required>
                            </div>
                            <div class="field-group">
                                <label for="partnerPrice">Partner Price:</label>
                                <input type="text" name="partnerPrice[]" required>
                            </div>
                            <div class="field-group">
                                <label for="dispatcherPrice">Dispatcher Price:</label>
                                <input type="text" name="dispatcherPrice[]" required>
                            </div>
                            <div class="field-group">
                                <label for="profit">Profit:</label>
                                <input type="text" name="profit[]" required>
                            </div>
                        </div>
                    </div>
                    <div id="notification" class="notification hidden">New record created successfully!</div>
                    <div class="button-container">
                        <div class="job">
                            <input type="submit" value="Submit">
                        </div>
                        <button type="button" class="add-button" onclick="addDataField()">Add More</button>
                    </div>
                </form>

                <div class="spacer"></div>
                <table style="width: 100%;">
    <thead>
        <tr>
            <th>location</th>
            <th>partnerPrice</th>
            <th>dispatcherPrice</th>
            <th>profit</th>
        </tr>
    </thead>
    <tbody id="table-body">
        <?php
        require '../config.php';

        $query = mysqli_query($conn, "SELECT location, partnerPrice, dispatcherPrice, profit FROM ninawo ORDER BY location DESC");
        if (!$query) {
            die('Query Failed: ' . mysqli_error($conn));
        }

        while ($row = mysqli_fetch_array($query)) {
            $location = $row['location'];
            $partnerPrice = $row['partnerPrice'];
            $dispatcherPrice = $row['dispatcherPrice'];
            $profit = $row['profit'];
        ?>
            <tr>
                <td><?php echo htmlspecialchars($location); ?></td>
                <td><?php echo htmlspecialchars($partnerPrice); ?></td>
                <td><?php echo htmlspecialchars($dispatcherPrice); ?></td>
                <td><?php echo htmlspecialchars($profit); ?></td>
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
<script>
function addDataField() {
    const fieldsContainer = document.getElementById('fields-container');
    const newFieldContainer = document.createElement('div');
    newFieldContainer.classList.add('field-container');

    newFieldContainer.innerHTML = `
        <div class="field-group">
            <label for="location">Location:</label>
            <input type="text" name="location[]" required>
        </div>
        <div class="field-group">
            <label for="partnerPrice">Partner Price:</label>
            <input type="text" name="partnerPrice[]" required>
        </div>
        <div class="field-group">
            <label for="dispatcherPrice">Dispatcher Price:</label>
            <input type="text" name="dispatcherPrice[]" required>
        </div>
        <div class="field-group">
            <label for="profit">Profit:</label>
            <input type="text" name="profit[]" required>
        </div>
    `;

    fieldsContainer.appendChild(newFieldContainer);
}
</script>