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
                <a href="titẹsi.php">
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

            <!-- ---------END OF EXAM-------- -->
            <div class="recent-sales">
                
                <?php
                    require '../config.php';
                    $Name = $_GET['Name'];
                    echo '<h1><span>'. $Name . "</span>'s Products</h1>";

                    if (isset($_GET['Name'])) {
                        $Name = $conn->real_escape_string($_GET['Name']);

                        $sql = "SELECT * FROM products WHERE partner = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("s", $Name);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result->num_rows > 0) {
                            echo '<table border="1">';
                            echo '<tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                </tr>';
                            
                                while ($row = $result->fetch_assoc()) {
                                    echo '<tr>';
                                    // echo '<td>' . htmlspecialchars($row["partner"]) . '</td>';
                                    echo '<td>' . htmlspecialchars($row["productName"]) . '</td>';
                                    echo '<td>' . htmlspecialchars($row["quantity"]) . '</td>';
                                    
                                    echo '</tr>';
                        }
                        
                    
                    echo '</table>';
                } else {
                    // echo "No record found!";
                }

                $stmt->close();
                $conn->close();
                }
            ?>



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
                    echo "<b>Contact: " . $row['contact'] . "</b<br>";

                    echo "<div class='sales-analytics'>";
                    echo "<a href='atunwoalabasepo.php?clientID=" . $row['id'] . "'>";
                    echo "<div class='item add-product'>";
                    echo "<div><span class='material-icons-sharp'>edit_note</span>";
                    echo "<h3>Edit </h3>";
                    echo "</div></div></a></div>";

                    echo "<div class='sales-analytics'>";
                    echo "<a href='?delete_id=" . $row['id'] . "&eru=" . $row['Name'] . "&eru=" . $row['Name'] . "' onclick=\"return confirm('Are you sure you want to delete this record? This action is NOT reversible')\">";
                    echo "<div class='item add-product'>";
                    echo "<div><span class='material-icons-sharp'>delete_outline</span>";
                    echo "<h3>Delete Partner</h3>";
                    echo "</div></div></a></div>";

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
