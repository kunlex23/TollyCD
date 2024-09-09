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
    <link rel="stylesheet" href="css/styls.css">
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
                <a href="alabasepo.php">
                    <span class="material-icons-sharp">groups</span>
                    <h3>Partners</h3>
                </a>
                <a href="oja.php">
                    <span class="material-icons-sharp">inventory</span>
                    <h3>Products</h3>
                </a>

                <a href="gbigbeTitun2.php" class="active">
                    <span class="material-icons-sharp">add</span>
                    <h3>New Waybill</h3>
                </a>

                <a href="records.php">
                    <span class="material-icons-sharp">local_shipping</span>
                    <h3>Waybills</h3>
                </a>

                <a href="awe.php">
                    <span class="material-icons-sharp">history</span>
                    <h3>Waybill History</h3>
                </a>

                <a href="../logout.php">
                    <span class="material-icons-sharp">logout</span>
                    <h3>Logout</h3>
                </a>
            </div>
        </aside>

        <main>
            <div class="recent-sales">
                <h1>New Waybill</h1>
                <form action="gbigbetitunwolepipo.php" method="POST">
                    <!-- Form fields -->

                    <div class="five-column-form">
                        <input type="hidden" name="accPartner" value="rara">
                        <input type="hidden" name="accCaptain" value="rara">
                        <input type="hidden" name="partnerPayStatus" value="rara">
                        <input type="hidden" name="captainPayStatus" value="rara">
                        <input type="hidden" name="shipmentType" value="Waybill">
                        <input type="hidden" name="status" value="Sent">
                        <?php
                        $detailse = $_SESSION['details'];
                        echo '<input type="hidden" name="details" value="' . $detailse . '">';
                        ?>

                        <div class="tray0">
                            <div>
                                <label for="Name">Partner:</label>
                                <select name="Name" required onchange="fetchProducts(this.value)">
                                    <option value="">Select a Partner</option>
                                    <?php
                                    require '../config.php';
                                    $sql = "SELECT Name FROM alabasepo";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo '<option value="' . $row["Name"] . '">' . $row["Name"] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <label for="customersName">Receiver:</label>
                            <input type="text" name="customersName[]" required><br>

                            <label for="customerContact">Receiver Contact:</label>
                            <input type="text" name="customerContact[]" required><br>

                        </div>
                        <div>

                            <label for="destination">Destination:</label>
                            <select id="destination" name="destination" required>
                                <option value="">...</option>
                                <option value="FCT">Federal Capital Territory</option>
                                <option value="Abia">Abia</option>
                                <option value="Adamawa">Adamawa</option>
                                <option value="Akwa Ibom">Akwa Ibom</option>
                                <option value="Anambra">Anambra</option>
                                <option value="Bauchi">Bauchi</option>
                                <option value="Bayelsa">Bayelsa</option>
                                <option value="Benue">Benue</option>
                                <option value="Borno">Borno</option>
                                <option value="Cross River">Cross River</option>
                                <option value="Delta">Delta</option>
                                <option value="Ebonyi">Ebonyi</option>
                                <option value="Edo">Edo</option>
                                <option value="Ekiti">Ekiti</option>
                                <option value="Enugu">Enugu</option>
                                <option value="Gombe">Gombe</option>
                                <option value="Imo">Imo</option>
                                <option value="Jigawa">Jigawa</option>
                                <option value="Kaduna">Kaduna</option>
                                <option value="Kano">Kano</option>
                                <option value="Katsina">Katsina</option>
                                <option value="Kebbi">Kebbi</option>
                                <option value="Kogi">Kogi</option>
                                <option value="Kwara">Kwara</option>
                                <option value="Lagos">Lagos</option>
                                <option value="Nasarawa">Nasarawa</option>
                                <option value="Niger">Niger</option>
                                <option value="Ogun">Ogun</option>
                                <option value="Ondo">Ondo</option>
                                <option value="Osun">Osun</option>
                                <option value="Oyo">Oyo</option>
                                <option value="Plateau">Plateau</option>
                                <option value="Rivers">Rivers</option>
                                <option value="Sokoto">Sokoto</option>
                                <option value="Taraba">Taraba</option>
                                <option value="Yobe">Yobe</option>
                                <option value="Zamfara">Zamfara</option>
                            </select><br>

                            <label for="agentName">Agent Name:</label>
                            <select name="agentName[]" required onchange="fetchProducts(this.value)">
                                <option value="">Select Agent</option>
                                <?php
                                require '../config.php';
                                $sql = "SELECT fullname, contact FROM agent";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<option value="' . $row["fullname"] . " (" . $row["contact"] .")". '">' . $row["fullname"] ." (". $row["contact"] .")". '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div>
                            <label for="dispatcherPrice">Drivers Price:</label>
                            <input type="text" id="dispatcherPrice" name="dispatcherPrice[]" required><br>
                            <label for="profit">Profit:</label>
                            <input type="text" id="profit" name="profit[]" required><br>
                            <label for="partnerPrice">Partner Price:</label>
                            <input type="text" id="partnerPrice" name="partnerPrice[]" required readonly><br>
                        </div>
                    </div><br><br>

                    <div id="productsContainer">
                        <div class="product-item">
                            <div>
                                <label for="orunoloun">Product:</label>
                                <select name="orunoloun[]" class="product-select" required
                                    onchange="fetchQuantity(this.value)">
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
                        </div>
                    </div>

                    <div class="baseForm">
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
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');

        form.addEventListener('submit', function(event) {
            const productItems = document.querySelectorAll('.product-item');

            for (let i = 0; i < productItems.length; i++) {
                const availableUnit = parseFloat(productItems[i].querySelector(
                    'input[name="availableUnit[]"]').value) || 0;
                const quantity = parseFloat(productItems[i].querySelector('input[name="quantity[]"]')
                    .value) || 0;

                if (quantity > availableUnit) {
                    alert(`Error: Quantity for product ${i + 1} is more than the available quantity.`);
                    event.preventDefault(); // Prevent the form from being submitted
                    return;
                }
            }
        });
    });
    </script>
</body>

</html>