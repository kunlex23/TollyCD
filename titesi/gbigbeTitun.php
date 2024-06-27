<?php
session_start();
if (!isset($_SESSION['userType'])) {
    header("location: index.php");
}
if ($_SESSION['userType'] === 'eru') {
    header("Location: ./okojooja");
// } elseif ($_SESSION['userType'] === 'fifisi') {
//     header("Location: ./titesi");
} elseif ($_SESSION['userType'] === 'olowo') {
    header("Location: ./onisiro");
} elseif ($_SESSION['userType'] === 'alamojuto') {
    header("Location: ./abojuto");
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
                    <h3>New Shipment</h3>
                </a>

                <a href="records.php">
                    <span class="material-icons-sharp">local_shipping</span>
                    <h3>Shipments</h3>
                </a>

                <a href="#">
                    <span class="material-icons-sharp"></span>
                    <h3></h3>
                </a>
            </div>
        </aside>
        <main>
            <div class="recent-sales">
                <h1>New Shipment</h1>
                <form class="five-column-form" action="gbigbetitunwolepipo.php" method="POST">
        <div class="tray0">
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
                    <div class="tray1">
                        <div>
                            <label for="shipmentType">Shipment Type:</label>
                            <select name="shipmentType" required>
                                <option value="delivery">Delivery</option>
                                <option value="waybill">Waybill</option>
                            </select><br>
                        </div>
                        <div id="productsContainer">
                            <label for="orunoloun">Product:</label>
                            <select name="orunoloun" required onchange="fetchQuantity(this.value)">
                                <option value="">Select a Product</option>
                            </select>
                        </div>
                        <div>
                            <label for="availableUnit">Available Unit:</label>
                            <input type="text" id="availableUnit" name="availableUnit[]" required readonly><br>
                            <label for="quantity">Quantity:</label>
                            <input type="text" name="quantity[]" required><br>
                        </div>
                    </div>
                    <div class="tray2">
                        <div>
                            <label for="unitPrice">Unit Price:</label>
                            <input type="text" name="unitPrice[]" required><br>
                            <label for="amount">Amount:</label>
                            <input type="text" name="amount[]" required readonly><br>
                        </div>
                        <div>
                            <label for="destination">Destination:</label>
                            <input type="text" name="destination[]" required><br>
                        </div>
                        <div>
                            <label for="customersName">Customer Name:</label>
                            <input type="text" name="customersName[]" required><br>
                        </div>
                    </div>
                    <div class="tray3">
                        <div>
                            <label for="customerContact">Customer Contact:</label>
                            <input type="text" name="customerContact[]" required><br>
                        </div>
                        <div>
                            <label for="captain">Captain:</label>
                            <input type="text" name="captain[]" required><br>
                        </div>
                        <div>
                            <label for="status">Status:</label>
                            <select name="status" required>
                                <option value="Pending">Pending</option>
                                <option value="Completed">Completed</option>
                            </select><br>
                        </div>
                        <div>
                            <label for="paymentMethod">Payment Method:</label>
                            <select name="paymentMethod" required>
                                <option value="Transfer">Transfer</option>
                                <option value="POS">POS</option>
                                <option value="Cash">Cash</option>
                                <option value="Cheque">Cheque</option>
                            </select><br>
                        </div>
                    </div>
                    <div id="notification" class="notification hidden">New record created successfully!</div>
                    <div class="button-container">
                        <div class="job"><input type="submit" value="Submit"></div>
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
                console.log(xhr.responseText); // Log the response for debugging
                const products = JSON.parse(xhr.responseText);
                const productSelect = document.querySelector("select[name='orunoloun']");
                productSelect.innerHTML = '<option value="">Select a Product</option>';
                products.forEach(product => {
                    const option = document.createElement("option");
                    option.value = product;
                    option.textContent = product;
                    productSelect.appendChild(option);
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
                console.log(xhr.responseText); // Log the response for debugging
                const response = JSON.parse(xhr.responseText);
                if (response.error) {
                    console.error(response.error);
                } else {
                    document.getElementById('availableUnit').value = response.quantity;
                }
            }
        };
        xhr.send("product=" + product);
    }
    </script>
     <script>
        function calculateAmount() {
            const quantityInputs = document.querySelectorAll('input[name="quantity[]"]');
            const unitPriceInputs = document.querySelectorAll('input[name="unitPrice[]"]');
            const amountInputs = document.querySelectorAll('input[name="amount[]"]');

            for (let i = 0; i < quantityInputs.length; i++) {
                const quantity = parseFloat(quantityInputs[i].value) || 0;
                const unitPrice = parseFloat(unitPriceInputs[i].value) || 0;
                amountInputs[i].value = quantity * unitPrice;
            }
        }

        function validateForm(event) {
            const quantityInputs = document.querySelectorAll('input[name="quantity[]"]');
            const availableUnitInputs = document.querySelectorAll('input[name="availableUnit[]"]');

            for (let i = 0; i < quantityInputs.length; i++) {
                const quantity = parseFloat(quantityInputs[i].value) || 0;
                const availableUnit = parseFloat(availableUnitInputs[i].value) || 0;

                if (quantity > availableUnit) {
                    alert('Quantity cannot be more than the available unit.');
                    event.preventDefault();
                    return false;
                }
            }

            return true;
        }

        document.addEventListener('DOMContentLoaded', function () {
            const quantityInputs = document.querySelectorAll('input[name="quantity[]"]');
            const unitPriceInputs = document.querySelectorAll('input[name="unitPrice[]"]');
            const form = document.querySelector('form');

            quantityInputs.forEach(input => input.addEventListener('input', calculateAmount));
            unitPriceInputs.forEach(input => input.addEventListener('input', calculateAmount));
            form.addEventListener('submit', validateForm);
        });
    </script>