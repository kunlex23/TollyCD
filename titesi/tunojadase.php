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
    <link rel="stylesheet" href="css/styl.css">
</head>

<body>
    <div class="container">
        <aside>
            <div class="top">
                <div class="logo">
                    <img src="./images/logo.png">
                </div>
                <div class="closeBTN" id="close-btn"><span class="material-icons-sharp">close</span></div>
            </div>
            <div class="sideBar">
                <a href="index.php">
                    <span class="material-icons-sharp">grid_view</span>
                    <h3>Dashboard</h3>
                </a>

                <a href="gbigbeTitun.php">
                    <span class="material-icons-sharp">add_circle</span>
                    <h3>New Delivery</h3>
                </a>

                <a href="records.php" class="active">
                    <span class="material-icons-sharp">local_shipping</span>
                    <h3>Active Shipments</h3>
                </a>
                <a href="dapada.php">
                    <span class="material-icons-sharp">assignment_return</span>
                    <h3>Returned Shipments</h3>
                </a>

                <a href="awe.php">
                    <span class="material-icons-sharp">history</span>
                    <h3>Shipments History</h3>
                </a>

                <a href="../logout.php">
                    <span class="material-icons-sharp">logout</span>
                    <h3>Logout</h3>
                </a>
            </div>
        </aside>

        <main>
            <div class="recent-sales">
                <h1>Edit Shipment</h1>
                <?php
                require '../config.php';

                if (isset($_GET['rira'])) {
                    $rira = mysqli_real_escape_string($conn, $_GET['rira']); // Sanitize input
                
                    $query2 = "SELECT customersName, customerContact, destination, partner, captain, product, amount, SOD
               FROM gbigbe WHERE id = '$rira'";

                    $result = mysqli_query($conn, $query2); // Execute the query
                
                    if ($result && mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);

                        $customersName1 = $row['customersName'];
                        $customerContact1 = $row['customerContact'];
                        $location1 = $row['destination'];
                        $partner1 = $row['partner'];
                        $captain1 = $row['captain'];
                        $product1 = $row['product'];
                        $amount1 = $row['amount'];
                        $SOD1 = $row['SOD'];

                    } else {
                        echo 'No record found with the specified ID.';
                        exit();
                    }
                }

                ?>

                <form action="atunse.php" method="POST">
                    <input type="hidden" name="rira" value="<?php echo htmlspecialchars($rira); ?>">

                    <!-- Form fields -->
                    <div class="five-column-form">

                        <div class="tray0">
                            <label for="customersName">Customer Name:</label>
                            <input type="text" name="customersName"
                                value="<?php echo htmlspecialchars($customersName1); ?>" required readonly>

                            <label for="customerContact">Customer Contact:</label>
                            <input type="text" name="customerContact"
                                value="<?php echo htmlspecialchars($customerContact1); ?>" required><br>
                        </div>

                        <div class="tray1">
                            <label for="state">State:</label>
                            <select id="state" name="state" required onchange="toggleLocationInput(this.value)">
                                <option value=""><?php echo htmlspecialchars($SOD1); ?></option>
                                <option value="FCT">Federal Capital Territory</option>
                                
                            </select><br>

                            <div>
                                <label for="destination">Location:</label>
                                <select id="locationDropdown" name="destination" onchange="fetchPrice(this.value)"
                                    style="display: none;">
                                    <option value="<?php echo htmlspecialchars($location1); ?>">
                                        <?php echo htmlspecialchars($location1); ?>
                                    </option>

                                    <?php
                                    require '../config.php';
                                    $sql = "SELECT location FROM ninawo";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo '<option value="' . $row["location"] . '">' . $row["location"] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                                <input type="text" id="locationInput" name="destination" style="display: block;">
                            </div>
                        </div>

                        <div class="tray2">
                            <div>
                                <label for="Name">Partner:</label>
                                <input type="text" name="partner" value="<?php echo htmlspecialchars($partner1); ?>"
                                    required readonly onclick="fetchProducts(this.value)"><br>

                            </div>

                            <div>
                                <label for="captain">Captain:</label>
                                <input type="text" name="captain" value="<?php echo htmlspecialchars($captain1); ?>"
                                    required readonly><br>
                            </div>
                        </div>

                        <div>
                            <label for="dispatcherPrice">Captain Price:</label>
                            <input type="text" id="dispatcherPrice" name="dispatcherPrice[]" required><br>
                            <label for="profit">Profit:</label>
                            <input type="text" id="profit" name="profit[]" required><br>
                            <label for="partnerPrice">Partner Price:</label>
                            <input type="text" id="partnerPrice" name="partnerPrice[]" required readonly><br>
                        </div>
                    </div>
                    <div>
                        <label for="oldProduct">Current Items:</label>
                            <input type="text" id="oldProduct" name="oldProduct[]" value="<?php echo htmlspecialchars($product1); ?>" required readonly><br>
                    </div>
                    <div id="productsContainer">
                        <div class="product-item">
                            <div>
                                <label for="orunoloun">Product:</label>
                                <select name="orunoloun[]" class="product-select" required
                                    onchange="fetchQuantity(this.value)">
                                    <option value="">...</option>
                                </select>
                            </div>
                            <div>
                                <label for="availableUnit">Available Unit:</label>
                                <input type="text" name="availableUnit[]" required readonly><br>
                            </div>
                            <div>
                                <label for="quantity">Quantity:</label>
                                <input type="text" name="quantity[]" required><br>
                            </div>
                        </div>
                    </div>

                    <div class="baseForm">
                        <div>
                            <label for="amount">Amount:</label>
                            <input type="text" name="amount[]" value="<?php echo htmlspecialchars($amount1); ?>"
                                required><br>
                        </div>

                        <div class="button-container">
                            <div class="job"><input type="submit" value="Submit"></div>
                        </div>
                        <button type="button" class="add-product" onclick="addProduct()">Add</button>
                    </div>
                </form>
            </div>
        </main>
        <div class="right">
            <div class="top">
                <button id="menu-btn"><span class="material-icons-sharp">menu</span></button>
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

        </div>

    </div>

    <script src="../script/scrip.js"></script>
    <script>
    function fetchProducts(partner) {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "get_products.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const products = JSON.parse(xhr.responseText);
                const productSelects = document.querySelectorAll("select[name='orunoloun[]']");
                productSelects.forEach(select => {
                    select.innerHTML = '<option value="">Select a Product</option>';
                    products.forEach(product => {
                        const option = document.createElement("option");
                        option.value = product;
                        option.textContent = product;
                        select.appendChild(option);
                    });
                });
            }
        };
        xhr.send("partner=" + partner);
    }

    function fetchQuantity(product) {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "get_quantity.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.error) {
                    console.error(response.error);
                } else {
                    const availableUnitInputs = document.querySelectorAll('input[name="availableUnit[]"]');
                    availableUnitInputs.forEach(input => {
                        if (input.closest('.product-item').querySelector('select[name="orunoloun[]"]')
                            .value === product) {
                            input.value = response.quantity;
                        }
                    });
                }
            }
        };
        xhr.send("product=" + product);
    }

    function addProduct() {
        const productsContainer = document.getElementById('productsContainer');
        const productTemplate = `
                <div class="product-item">
                    <div>
                    <label for="orunoloun">Product:</label>
                    <select name="orunoloun[]" class="product-select" required onchange="fetchQuantity(this.value)">
                        <option value="">Select a Product</option>
                    </select>
                    </div>
                    <div>
                        <label for="availableUnit">Available Unit:</label>
                        <input type="text" name="availableUnit[]" required readonly><br>
                    </div>
                    <div>
                        <label for="quantity">Quantity:</label>
                        <input type="text" name="quantity[]" required><br>
                    </div>
                    <button type="button" class="remove-product" onclick="removeProduct(this)">Remove</button>
                </div>
            `;
        productsContainer.insertAdjacentHTML('beforeend', productTemplate);

        // Re-fetch the products for the new select element
        const partnerSelect = document.querySelector("select[name='Name']");
        if (partnerSelect && partnerSelect.value) {
            fetchProducts(partnerSelect.value);
        }
    }

    function removeProduct(button) {
        const productItem = button.closest('.product-item');
        productItem.remove();
    }

    function toggleLocationInput(value) {
        var locationDropdown = document.getElementById('locationDropdown');
        var locationInput = document.getElementById('locationInput');
        if (value === 'FCT') {
            locationDropdown.style.display = 'block';
            locationDropdown.disabled = false;
            locationInput.style.display = 'none';
            locationInput.disabled = true;
        } else {
            locationDropdown.style.display = 'none';
            locationDropdown.disabled = true;
            locationInput.style.display = 'block';
            locationInput.disabled = false;
        }
    }

    function fetchPrice(location) {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "get_price.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.error) {
                    console.error(response.error);
                } else {
                    document.getElementById("partnerPrice").value = response.partnerPrice;
                    document.getElementById("dispatcherPrice").value = response.dispatcherPrice;
                    document.getElementById("profit").value = response.profit;
                }
            }
        };
        xhr.send("location=" + location);
    }

    function fetchCaptain(captain) {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "get_captain_details.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.error) {
                    console.error(response.error);
                } else {
                    // Handle captain details
                }
            }
        };
        xhr.send("captain=" + captain);
    }
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const partnerPriceInput = document.getElementById('partnerPrice');
        const dispatcherPriceInput = document.getElementById('dispatcherPrice');
        const profitInput = document.getElementById('profit');

        function calculateTotal() {
            const dispatcherPrice = parseFloat(dispatcherPriceInput.value) || 0;
            const profit = parseFloat(profitInput.value) || 0;
            const total = dispatcherPrice + profit;
            partnerPriceInput.value = total.toFixed(2); // Keeping 2 decimal places
        }

        profitInput.addEventListener('input', calculateTotal);
        dispatcherPriceInput.addEventListener('input', calculateTotal);
    });
    </script>
</body>

</html>