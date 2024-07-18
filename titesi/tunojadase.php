<?php
// session_start();
// if ($_SESSION['userType'] === 'eru') {
//     header("Location: ../okojooja");
// // } elseif ($_SESSION['userType'] === 'fifisi') {
// //     header("Location: ../titesi");
// } elseif ($_SESSION['userType'] === 'olowo') {
//     header("Location: ../onisiro");
// } elseif ($_SESSION['userType'] === 'alamojuto') {
//     header("Location: ../abojuto");
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

    /* Center the modal content */
    #returnReasonModal {
        padding-top: 15%;
        padding-left: 35%;
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1;
        /* Sit on top */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgba(0, 0, 0, 0.4);
        /* Black w/ opacity */
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        background-color: #fefefe;
        padding: 20px;
        border: 1px solid #888;
        width: 40%;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
        border-radius: 8px;
        /* Rounded corners for a modern look */
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    .modal-content form {
        display: flex;
        flex-direction: column;
    }

    .modal-content textarea {
        resize: vertical;
        min-height: 100px;
        margin-bottom: 20px;
    }

    .modal-content button {
        align-self: flex-end;
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
        <!------------ END OF ASIDE ------------>
        <main>
            <div class="recent-sales">
                <h1>Edit Shipment</h1>

                <?php
require '../config.php';

if (isset($_GET['rira'])) {
    $rira = urldecode($_GET['rira']);

    // Fetch the current data using prepared statements
    $stmt = $conn->prepare("SELECT * FROM gbigbe WHERE id = ?");
    $stmt->bind_param("s", $rira);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize and validate inputs
            $partner = htmlspecialchars($_POST['partner']);
            $products = $_POST['product'];
            $quantities = $_POST['quantity'];
            $amounts = $_POST['amount'];
            $customerNames = $_POST['customersName'];
            $destination = $_POST['destination'];
            $customerContacts = $_POST['customerContact'];
            $captains = $_POST['captain'];

            // Update the record using prepared statements
            $updateQuery = "UPDATE gbigbe SET 
                partner = ?,
                products = ?,
                quantities = ?,
                amounts = ?,
                customerNames = ?,
                destination = ?,
                customerContacts = ?,
                captains = ?
                WHERE id = ?";

            $stmt = $conn->prepare($updateQuery);
            $stmt->bind_param(
                "sssssssss",
                $partner,
                serialize($products),
                serialize($quantities),
                serialize($amounts),
                serialize($customerNames),
                serialize($destination),
                serialize($customerContacts),
                serialize($captains),
                $rira
            );

            if ($stmt->execute()) {
                echo '<script>alert("Record updated successfully!");</script>';
                echo '<script>window.location.href = "newCaptain.php";</script>';
                exit();
            } else {
                die('Update Failed: ' . $stmt->error);
            }
        }
    } else {
        echo 'No record found with the specified ID.';
        exit();
    }
} else {
    echo 'No ID specified.';
    exit();
}
?>


                <form class="five-column-form" action="" method="POST">
                    <input type="hidden" name="id" value="<?php echo $rira; ?>">
                    <div class="field-container">
                        <div class="field-group">
                            <label for="partner">Partner:</label>
                            <input type="text" name="partner" value="<?php echo htmlspecialchars($row['partner']); ?>"
                                readonly>

                            <label for="product">Product:</label>
                            <input type="text" name="product" value="<?php echo htmlspecialchars($row['product']); ?>"
                                required>

                            <label for="quantity">quantity:</label>
                            <input type="text" name="quantity" value="<?php echo htmlspecialchars($row['quantity']); ?>"
                                required>

                            <label for="amount">Amount:</label>
                            <input type="text" name="amount" value="<?php echo htmlspecialchars($row['amount']); ?>"
                                required>
                        </div>

                        <div class="field-group">

                            <label for="captain">Captain:</label>
                            <input type="text" name="captain" value="<?php echo htmlspecialchars($row['captain']); ?>"
                                required>

                            <label for="location">Location:</label>
                            <input type="text" name="location"
                                value="<?php echo htmlspecialchars($row['destination']); ?>" required>

                            <label for="customersName">customersName:</label>
                            <input type="text" name="customersName"
                                value="<?php echo htmlspecialchars($row['customersName']); ?>" required>

                            <label for="customerContact">customerContact:</label>
                            <input type="text" name="customerContact"
                                value="<?php echo htmlspecialchars($row['customerContact']); ?>" required>

                        </div>
                    </div>
                    <div class="button-container">
                        <div class="job">
                            <input type="submit" value="Update">
                        </div>
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
                    <span id="light-mode-icon" class="material-icons-sharp active">light_mode</span>
                    <span id="dark-mode-icon" class="material-icons-sharp">dark_mode</span>
                </div>
                <div class="profile">
                    <div class="info">
                        <p> <b></b></p>
                        <!-- <small class="text-muted">Admin</small> -->
                    </div>
                </div>
            </div>


        </div>
    </div>

    <script src="../script/scrip.js"></script>
</body>

</html>