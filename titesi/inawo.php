<?php
// session_start();
// if (!isset($_SESSION['userType'])) {
//     header("location: index.php");
// }
// if ($_SESSION['userType'] === 'eru') {
//     header("Location: ./okojooja");
// // } elseif ($_SESSION['userType'] === 'fifisi') {
// //     header("Location: ./titesi");
// } elseif ($_SESSION['userType'] === 'olowo') {
//     header("Location: ./onisiro");
// } elseif ($_SESSION['userType'] === 'alamojuto') {
//     header("Location: ./abojuto");
// }
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
                    <h3>New Shipment</h3>
                </a>

                <a href="records.php">
                    <span class="material-icons-sharp">local_shipping</span>
                    <h3>Shipments</h3>
                </a>

                <a href="dapada.php">
                    <span class="material-icons-sharp">assignment_return</span>
                    <h3>Returned Shipments</h3>
                </a>

                <a href="inawo.php" class="active">
                    <span class="material-icons-sharp">paid</span>
                    <h3>Expenses</h3>
                </a>

                <a href="../logout.php">
                    <span class="material-icons-sharp">logout</span>
                    <h3>Logout</h3>
                </a>
            </div>
        </aside>
        <main>
            <div class="recent-sales">
                <h1>New Shipment</h1>
                <form class="five-column-form" action="inawowole.php" method="POST">
                    <div class="tray0">
                        <label for="purpose">Description:</label>
                        <input type="text" name="purpose[]" required><br>
                    </div>
                    <div class="tray1">
                        <div>
                            <label for="quantity">Quantity:</label>
                            <input type="text" name="quantity[]" required><br>
                        </div>
                    </div>
                    <div class="tray2">
                        <div>
                            <label for="unitPrice">Unit Price:</label>
                            <input type="text" name="unitPrice[]" required><br>
                        </div>
                    </div>
                    <div class="tray3">
                        <div>
                            <label for="amount">Amount:</label>
                            <input type="text" name="amount[]" required readonly><br>
                        </div>
                    </div>
                    <div id="notification" class="notification hidden">New record created successfully!</div>
                    <div class="button-container">
                        <div class="job"><input type="submit" value="Submit"></div>
                    </div>
                </form>

                <div class="spacer"></div>
                <h2>Shipments Records</h2>
                <div class="spacer"></div>
                <input type="text" id="filterInput" placeholder="Search for shipment..." onkeyup="filterTable()">
                <table id="shipmentTable" style="width: 100%;">
                    <thead>
                        <tr>
                            <!-- <th>ID</th> -->
                            <th>Purpose</th>
                            <th>Unit</th>
                            <th>Unit Price</th>
                            <th>Amount</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <?php
                        require '../config.php';

                        $query = mysqli_query($conn, "SELECT id, purpose, unit, unitPrice, amount, date  FROM inawo ORDER BY purpose DESC ");
                        while ($row = mysqli_fetch_array($query)) {
                            $purpose = $row['purpose'];
                            $unit = $row['unit'];
                            $unitPrice = $row['unitPrice'];
                            $amount = $row['amount'];
                            $date = $row['date'];
                            ?>
                        <tr>
                            <!-- <td><?php echo $id; ?></td> -->
                            <td><?php echo $purpose; ?></td>
                            <td><?php echo $unit; ?></td>
                            <td><?php echo $unitPrice; ?></td>
                            <td><?php echo $amount; ?></td>
                            <td><?php echo $date; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>

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

    document.addEventListener('DOMContentLoaded', function() {
        const quantityInputs = document.querySelectorAll('input[name="quantity[]"]');
        const unitPriceInputs = document.querySelectorAll('input[name="unitPrice[]"]');
        const form = document.querySelector('form');

        quantityInputs.forEach(input => input.addEventListener('input', calculateAmount));
        unitPriceInputs.forEach(input => input.addEventListener('input', calculateAmount));
        form.addEventListener('submit', validateForm);
    });
    </script>
    <script>
    function filterTable() {
        // Get the value of the input field
        let input = document.getElementById('filterInput');
        let filter = input.value.toUpperCase();

        // Get the table and its rows
        let table = document.getElementById('shipmentTable');
        let tr = table.getElementsByTagName('tr');

        // Loop through all table rows, except the first (header) row
        for (let i = 1; i < tr.length; i++) {
            // Get the first cell (product name) in the row
            let td = tr[i].getElementsByTagName('td')[0];
            if (td) {
                // Check if the product name contains the filter text
                let txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = '';
                } else {
                    tr[i].style.display = 'none';
                }
            }
        }
    }
    </script>