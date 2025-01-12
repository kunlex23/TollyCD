<?php
session_start();
if (!isset($_SESSION['userType'])) {
    header("location: ../index.php");
} elseif (($_SESSION['userType']) == "Inventory") {
    header("Location: ../okojooja");
} elseif (($_SESSION['userType']) == "Data_Entry") {
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

                <a href="gbigbeTitun.php" class="active">
                    <span class="material-icons-sharp">add_circle</span>
                    <h3>Create Shipment</h3>
                </a>

                <a href="records.php">
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
                <h1>Create Delivery</h1>
                <form action="gbigbetitunwolepipo.php" method="POST">
                    <!-- Form fields -->
                    <div class="five-column-form">
                        <input type="hidden" name="accPartner" value="rara">
                        <input type="hidden" name="accCaptain" value="rara">
                        <input type="hidden" name="partnerPayStatus" value="rara">
                        <input type="hidden" name="captainPayStatus" value="rara">
                        <input type="hidden" name="shipmentType" value="Delivery">
                        <input type="hidden" name="status" value="Pending">
                        <?php
                        $detailse = $_SESSION['details'];
                        echo '<input type="hidden" name="details" value="' . $detailse . '">';
                        ?>
                        <div class="tray0">
                            <label for="customersName">Customer Name:</label>
                            <input type="text" name="customersName[]" required><br>

                            <label for="customerContact">Customer Contact:</label>
                            <input type="text" name="customerContact[]" required><br>
                        </div>

                        <div class="tray1">
                            <label for="sod">State:</label>
                            <select name="sod" required onchange="fetchState(this.value)">
                                <option value="">Select a State</option>
                                <?php
                                require '../config.php';
                                $sql = "SELECT DISTINCT sod FROM ninawo";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<option value="' . $row["sod"] . '">' . $row["sod"] . '</option>';
                                    }
                                }
                                ?>
                            </select>

                            <div>
                                <label for="destination">Location:</label>
                                <select id="locationDropdown" name="destination" onchange="fetchPrice(this.value)">
                                    <option value="">Select a Location</option>
                                </select>
                            </div>
                        </div>

                        <div class="tray2">
                            <div>
                                <label for="Name">Partner:</label>
                                <select name="Name" required onchange="fetchProducts(this.value)">
                                    <option value="">Select a Partner</option>
                                    <?php
                                    // require '../config.php';
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

                            <div>
                                <label for="captain">Captain:</label>
                                <select name="captain" required onchange="fetchCaptain(this.value)">
                                    <option value="">Select a Captain</option>
                                    <?php
                                    require '../config.php';
                                    $sql = "SELECT fullname FROM oluwa";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo '<option value="' . $row["fullname"] . '">' . $row["fullname"] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label for="dispatcherPrice">Captain Price:</label>
                            <input type="text" id="dispatcherPrice" name="dispatcherPrice[]" required readonly><br>
                            
                            <input type="hidden" id="profit" name="profit[]" required><br>
                            <input type="hidden" id="partnerPrice" name="partnerPrice[]" required readonly><br>
                        </div>
                    </div>

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
                        <div>
                            <label for="amount">Amount:</label>
                            <input type="text" name="amount[]" required><br>
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

  // Call this function on page load to populate the dropdown with locations
function fetchLocations() {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "get_price.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            if (Array.isArray(response)) {
                // Sort locations alphabetically
                response.sort();

                const dropdown = document.getElementById("locationDropdown");
                dropdown.innerHTML = '<option value="">Select a Location</option>'; // Reset options
                response.forEach(location => {
                    const option = document.createElement("option");
                    option.value = location;
                    option.textContent = location;
                    dropdown.appendChild(option);
                });
            } else {
                console.error(response.error || 'Error fetching locations');
            }
        }
    };
    xhr.send("getLocations=true");
}


// Fetch the price details when a location is selected
function fetchPrice(location) {
    if (!location) return; // Exit if no location is selected

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

// Call fetchLocations on page load
document.addEventListener("DOMContentLoaded", fetchLocations);


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


    function fetchState(sod) {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "get_state.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);

                const locationDropdown = document.getElementById('locationDropdown');
                locationDropdown.style.display = 'block'; // Show the location dropdown

                // Clear the existing options in the dropdown
                locationDropdown.innerHTML = '<option value="">Select a Location</option>';

                if (response.length > 0) {
                    response.forEach(function(location) {
                        const option = document.createElement('option');
                        option.value = location;
                        option.text = location;
                        locationDropdown.add(option);
                    });
                } else {
                    // If no locations are found, hide the dropdown again
                    locationDropdown.style.display = 'none';
                }
            }
        };
        xhr.send("sod=" + encodeURIComponent(sod));
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