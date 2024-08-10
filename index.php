<?php
session_start();
if (($_SESSION['userType']) == "Inventory") {
    header("Location: ./okojooja");
} elseif (($_SESSION['userType']) == "Data_Entry") {
    header("Location: ./titesi");
} elseif (($_SESSION['userType']) == "Accountant") {
    header("Location: ./onisiro");
} elseif (($_SESSION['userType']) == "Admin") {
    header("Location: ./abojuto");
}
?>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TCD</title>
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <div id="container">
        <form class="wole-oruko" action="login.php" method="post" autocomplete="off">
            <div class="imgcontainer">
                <img src="images/img_avatar.png" alt="Avatar" class="avatar">
            </div>
            <center><div class="container">
                <label for="uname"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="uname" required>

                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="psw" required>

                <button type="submit">Login</button>
            </div></center>
            
        </form>
    </div>
</body>
<script src="javascript/script_login.js"></script>

</html>