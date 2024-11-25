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
    <link rel="stylesheet" href="css/styl.css">
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

                <a href="../logout.php">
                    <span class="material-icons-sharp">logout</span>
                    <h3>Logout</h3>
                </a>
            </div>
        </aside>
        <!------------ END OF ASIDE ------------>
        <main>      
            

            <div class="recent-sales">
                <?php
                require '../config.php';
                $Name = $_GET['Name'];
                echo '<h1><span>' . htmlspecialchars($Name) . "</span>'s Products</h1>";

                if (isset($_GET['Name'])) {
                    $Name = $conn->real_escape_string($_GET['Name']);
                    $sql = "SELECT * FROM products WHERE partner = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("s", $Name);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        echo '<input type="text" id="filterInput" placeholder="Search for products..." onkeyup="filterTable()">';
                        echo '<table id="productTable" border="1">';
                        echo '<tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Update</th>
                                <th>View</th>
                              </tr>';

                        while ($row = $result->fetch_assoc()) {
                            $productId = htmlspecialchars($row["id"]);
                            $productName = htmlspecialchars($row["productName"]);
                            $quantity = htmlspecialchars($row["quantity"]);
                            echo '<tr>';
                            echo '<td>' . htmlspecialchars($row["productName"]) . '</td>';
                            echo '<td>' . htmlspecialchars($row["quantity"]) . '</td>';
                            echo '<td><a href="ojafifisi.php?productId=' . $productId . '&Name=' . urlencode($Name) . '">Update</a></td>';
                            echo '<td><a href="iroEru.php?ewo=' . $productId . '&tani=' . urlencode($Name) . '&eruwo=' . urlencode($productName) . '&loku=' . urlencode($quantity) . '">View</a></td>';
                            echo '</tr>';
                        }

                        echo '</table>';
                    } else {
                        echo "No product found!";
                    }

                    $stmt->close();
                    $conn->close();
                }
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

            <form action="./wiwa.php" method="GET">
                <label for="Name">Partner:</label>
                <select name="Name" required>
                    <option value="">Select a Partner</option>
                    <?php
                    require '../config.php';
                    $sql = "SELECT Name, contact FROM alabasepo";
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

            <?php
            // require 'config.php'; 
            // Check if a delete action is requested
            if (isset($_GET['delete_id'])) {
                $deleteId = $_GET['delete_id'];
                $delete_eru = urldecode($_GET['delete_eru']);
                // Perform the deletion query here
                $deleteSql = "DELETE FROM alabasepo WHERE id = $deleteId";
                $deleteSql1 = "DELETE FROM products WHERE partner = $delete_eru";

                if ($conn->query($deleteSql) === TRUE) {
                    echo '<script>alert("Partner removed successfully!");</script>';
                    echo '<script>window.location.href = "./alabasepo.php";</script>';
                } else {
                    echo "Error deleting record: " . $conn->error;
                }
            }
            
            $Name = $_GET['Name'];

            $sql = "SELECT * FROM alabasepo WHERE Name LIKE '%$Name%'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<h2>" . $row['Name'] ."'s Profile </h2><br>";
                    echo "<b>Account Number: " . $row['accountNumber'] . "</b><br>";
                    echo "<b>Bank: " . $row['bank'] . "</b><br>";
                    echo "<b>Account Name: " . $row['accountName'] . "</b><br>";
                    echo "<b>Location: " . $row['location'] . "</b><br>";
                    echo "<b>Contact: " . $row['contact'] . "</b<br>";

                    
                    if ($_SESSION['userType'] == "Admin") {
                        echo "<div class='sales-analytics'>";
                        echo "<a href='atunwoalabasepo.php?clientID=" . $row['id'] . "'>";
                        echo "<div class='item add-product'>";
                        echo "<div><span class='material-icons-sharp'>edit_note</span>";
                        echo "<h3>Edit  " . $row['Name'] . " Info</h3>";
                        echo "</div></div></a></div>";

                        echo "<div class='sales-analytics'>";
                        echo "<a href='?delete_id=" . $row['id'] . "&eru=" . $row['Name'] . "' onclick=\"return confirm('Are you sure you want to remove  " . $row['Name'] . " as partner? This action is NOT reversible')\">";
                        echo "<div class='item add-product'>";
                        echo "<div><span class='material-icons-sharp'>delete_outline</span>";
                        echo "<h3>Remove  " . $row['Name'] . " as partner</h3>";
                        echo "</div></div></a></div>";
                    }


            }
            } else {
            echo "No results found.";
            }

            $conn->close();
            ?>

        </div>
    </div>
    <script src="../script/scrip.js"></script>
</body>

</html>
<script>
function filterTable() {
    // Get the value of the input field
    let input = document.getElementById('filterInput');
    let filter = input.value.toUpperCase();

    // Get the table and its rows
    let table = document.getElementById('productTable');
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