<?php
session_start();
if (isset($_SESSION['unique_id'])) {
    header("location: home.php");
}
?>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <div id="container">
        <form class="modal-content animate" action="/login.php" method="post">
            <div class="imgcontainer">
                <img src="images/img_avatar.png" alt="Avatar" class="avatar">
            </div>

            <div class="container">
                <label for="uname"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="uname" required>

                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="psw" required>

                <a href="dashboard.html"></a><button type="submit">Login</button>

            </div>


        </form>
    </div>
</body>