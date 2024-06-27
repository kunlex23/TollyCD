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
    <style>
    .button-container {
        height: 5rem;
        /* text-align: center; */
        margin-top: 20px;
        display: flex;
        gap: 5rem;
    }

    .button-container button {
        margin-top: 20px;
        background-color: blue;
        height: 2.7rem;
        border-radius: 0.5rem;
        padding: 1rem;
        color: white;

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
                <a href="oja.php" class="active">
                    <span class="material-icons-sharp">inventory</span>
                    <h3>Products</h3>
                </a>


                <a href="#">
                    <span class="material-icons-sharp"></span>
                    <h3></h3>
                </a>
            </div>
        </aside>
        <!------------ END OF ASIDE ------------>
        <main>
            <div class="recent-sales">
                <h1>Batch Product Entry</h1>
                <form class="five-column-form" action="ojatitunwolepipo.php" method="POST">
                    <div class="tray0">
                        <label for="Name">Partner:</label>
                        <select name="Name" required>
                            <option value="">Select a Partner</option>
                            <?php
                        require '../config.php';
                        $sql = "SELECT Name, contact FROM alabasepo";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<option value="' . $row["Name"] . '">' . $row["Name"] . '</option>';
                            }
                        }
                        ?>
                        </select>
                    </div>
                    <div id="productsContainer" class="tray1">
                        <!-- Initial product and quantity fields -->
                        <div>
                            <label for="productName0">Product Name:</label>
                            <input type="text" name="productName[]" required><br>
                        </div>
                        <div>
                            <label for="quantity0">Quantity:</label>
                            <input type="text" name="quantity[]" required><br>
                        </div>
                    </div>
                    <div id="notification" class="notification hidden"> New record created successfully!</div>
                    <div class="button-container">
                        <div class="job"><input type="submit" value="Submit"></div>
                        <button type="button" class="add-button" onclick="addProductField()">Add More </button>
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
                    <span class="material-icons-sharp active">light_mode</span>
                    <span class="material-icons-sharp">dark_mode</span>
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
                            echo '<option value="' . $row["Name"] . '">' . $row["Name"] . '</option>';
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
<script>
function addProductField() {
    const container = document.getElementById('productsContainer');
    const index = container.children.length / 2; // Calculate the index based on current number of fields

    const productField = document.createElement('div');
    productField.innerHTML = `
                <label for="productName${index}">Product Name:</label>
                <input type="text" name="productName[]" required><br>
            `;
    container.appendChild(productField);

    const quantityField = document.createElement('div');
    quantityField.innerHTML = `
                <label for="quantity${index}">Quantity:</label>
                <input type="text" name="quantity[]" required><br>
            `;
    container.appendChild(quantityField);
}
</script>