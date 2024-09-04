<?php
session_start();
if (!isset($_SESSION['userType'])) {
    header("location: ../index.php");
} elseif (($_SESSION['userType']) == "Inventory") {
    header("Location: ../okojooja");
} elseif (($_SESSION['userType']) == "Data_Entry") {
    header("Location: ../titesi");
} elseif (($_SESSION['userType']) == "Accountant") {
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
    <link rel="stylesheet" href="css/style.css">
    <style>
    table,
    th,
    td {
        border: 1px solid blanchedalmond;
        border-collapse: collapse;
        padding: 2px;
    }

    tr:nth-child(even) {
        background-color: rgba(150, 212, 212, 0.4);
    }

    td:nth-child(even) {
        background-color: rgba(150, 212, 212, 0.4);
    }

    .navbar {
        display: flex;
        justify-content: center;
        padding: 1px;
    }

    /* Styling for individual navigation buttons */
    .nav-button {
        margin: 0 15px;
        /* Space between buttons */
        padding: 10px 20px;
        font-size: 16px;
        color: white;
        background-color: #007BFF;
        border: none;
        border-radius: 5px;
        text-align: center;
        text-decoration: none;
        cursor: pointer;
    }

    /* Styling for button hover effect */
    .nav-button:hover {
        background-color: #0056b3;
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
                <a href="index.php" class="active">
                    <span class="material-icons-sharp">grid_view</span>
                    <h3>Dashboard</h3>
                </a>

                <a href="records.php">
                    <span class="material-icons-sharp">local_shipping</span>
                    <h3>Shipments</h3>
                </a>

                <a href="oroowo.php">
                    <span class="material-icons-sharp">history</span>
                    <h3>Payment History</h3>
                </a>

                <a href="iranse.php">
                    <span class="material-icons-sharp">garage</span>
                    <h3>Waybill</h3>
                </a>


                <a href="owoofe.php">
                    <span class="material-icons-sharp">paid</span>
                    <h3>Other Income</h3>
                </a>

                <a href="inawo.php">
                    <span class="material-icons-sharp">payments</span>
                    <h3>Expenses</h3>
                </a>

                <a href="../logout.php">
                    <span class="material-icons-sharp">logout</span>
                    <h3>Logout</h3>
                </a>
            </div>
        </aside>
        <!------------ END OF ASIDE ------------>
        <main>

            <?php
           if ($_SESSION['userType'] == "Admin") {
               echo "<div class='navbar'>";
               echo "<a href='../okojooja' class='nav-button'>Inventory</a>";
               echo "<a href='../titesi' class='nav-button'>Data Entry</a>";
               echo "<a href='../onisiro' class='nav-button'>Accounting</a>";
               echo "<a href='../abojuto' class='nav-button'>Admin</a>";
               echo "</div>";
           }
           ?>
            <h1>Accounting</h1><br>
            <div class="insight">

                <div class="sales">
                    <div class="middle">
                        <div class="left">
                            <h3>Normal Delivery</h3>
                            <div id="link_wrapper8">

                            </div>
                        </div>

                    </div>
                    <small class="tex">Last 7 Days</small>
                </div>
                
                <div class="expensis">
                    <div class="middle">
                        <div class="left">
                            <h3>Delivery Without Payment</h3>
                            <div id="link_wrapper9">

                            </div>
                        </div>

                    </div>
                    <small class="text-muted">Last 7 Days</small>
                </div>
                
                <div class="income">
                    <div class="middle">
                        <div class="left">
                            <h3>Delievery With Weekly Remitance to Partners</h3>
                            <div id="link_wrapper10">

                            </div>
                        </div>

                    </div>
                    <small class="text-muted">Last 7 Days</small>
                </div>
                
               <div class="income">
                    <div class="middle">    
                        <div class="left">
                            <h3>Waybill (In)</h3>
                            <div id="link_wrapper11">

                            </div>
                        </div>

                    </div>
                    <small class="text-muted">Last 7 Days</small>
                </div>
                
               <div class="expensis">
                    <div class="middle">
                        <div class="left">
                            <h3>Other Income</h3>
                            <div id="link_wrapper7">

                            </div>
                        </div>

                    </div>
                    <small class="text-muted">Last 7 Days</small>
                </div>
          
                <div class="sales">
                    <div class="middle">
                        <div class="left">
                            <h3>Total Revenue</h3>
                            <div id="link_wrapper">

                            </div>
                        </div>

                    </div>
                    <small class="tex">Last 7 Days</small>
                </div>


                <div class="income">
                    <div class="middle">
                        <div class="left">
                            <h3>Partner Remit</h3>
                            <div id="link_wrapper1">

                            </div>
                        </div>

                    </div>
                    <small class="text-muted">Last 7 Days</small>
                </div>
                <!-- ================================== -->
                
                
                
                
                
                <div class="expensis">
                    <div class="middle">
                        <div class="left">
                            <h3>Net Profit</h3>
                            <div id="link_wrapper4">

                            </div>
                        </div>

                    </div>
                    <small class="text-muted">Last 7 Days</small>
                </div>

                <div class="expensis">
                    <div class="middle">
                        <div class="left">
                            <h3>Captains Pay</h3>
                            <div id="link_wrapper2">

                            </div>
                        </div>

                    </div>
                    <small class="text-muted">Last 7 Days</small>
                </div>

                
                <div class="expensis">
                    <div class="middle">
                        <div class="left">
                            <h3>Delivery</h3>
                            <div id="link_wrapper5">

                            </div>
                        </div>

                    </div>
                    <small class="text-muted">Last 7 Days</small>
                </div>


                <div class="expensis">
                    <div class="middle">
                        <div class="left">
                            <h3>Waybill</h3>
                            <div id="link_wrapper6">

                            </div>
                        </div>

                    </div>
                    <small class="text-muted">Last 7 Days</small>
                </div>


                <div class="expensis">
                    <div class="middle">
                        <div class="left">
                            <h3>Expenses</h3>
                            <div id="link_wrapper3">

                            </div>
                        </div>

                    </div>
                    <small class="text-muted">Last 7 Days</small>
                </div>






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

<!-- live data -->
<script>
function loadXMLDoc() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("link_wrapper").innerHTML =
                this.responseText;
        }
    };
    xhttp.open("GET", "server.php", true);
    xhttp.send();
}
setInterval(function() {
    loadXMLDoc();
    // 1sec
}, 1000);

window.onload = loadXMLDoc;

function loadXMLDoc1() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("link_wrapper1").innerHTML =
                this.responseText;
        }
    };
    xhttp.open("GET", "server1.php", true);
    xhttp.send();
}
setInterval(function() {
    loadXMLDoc1();
    // 1sec
}, 1000);

window.onload = loadXMLDoc1;

function loadXMLDoc2() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("link_wrapper2").innerHTML =
                this.responseText;
        }
    };
    xhttp.open("GET", "server2.php", true);
    xhttp.send();
}
setInterval(function() {
    loadXMLDoc2();
    // 1sec
}, 1000);

window.onload = loadXMLDoc2;



function loadXMLDoc3() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("link_wrapper3").innerHTML =
                this.responseText;
        }
    };
    xhttp.open("GET", "server3.php", true);
    xhttp.send();
}
setInterval(function() {
    loadXMLDoc3();
    // 1sec
}, 1000);

window.onload = loadXMLDoc3;

function loadXMLDoc4() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("link_wrapper4").innerHTML =
                this.responseText;
        }
    };
    xhttp.open("GET", "server4.php", true);
    xhttp.send();
}
setInterval(function() {
    loadXMLDoc4();
    // 1sec
}, 1000);

window.onload = loadXMLDoc4;


function loadXMLDoc5() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("link_wrapper5").innerHTML =
                this.responseText;
        }
    };
    xhttp.open("GET", "server5.php", true);
    xhttp.send();
}
setInterval(function() {
    loadXMLDoc5();
    // 1sec
}, 1000);

window.onload = loadXMLDoc5;

function loadXMLDoc6() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("link_wrapper6").innerHTML =
                this.responseText;
        }
    };
    xhttp.open("GET", "server6.php", true);
    xhttp.send();
}
setInterval(function() {
    loadXMLDoc6();
    // 1sec
}, 1000);

window.onload = loadXMLDoc6;

function loadXMLDoc7() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("link_wrapper7").innerHTML =
                this.responseText;
        }
    };
    xhttp.open("GET", "server7.php", true);
    xhttp.send();
}
setInterval(function() {
    loadXMLDoc7();
    // 1sec
}, 1000);

window.onload = loadXMLDoc7;

function loadXMLDoc8() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("link_wrapper8").innerHTML =
                this.responseText;
        }
    };
    xhttp.open("GET", "server8.php", true);
    xhttp.send();
}
setInterval(function() {
    loadXMLDoc8();
    // 1sec
}, 1000);

window.onload = loadXMLDoc8;

function loadXMLDoc9() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("link_wrapper9").innerHTML =
                this.responseText;
        }
    };
    xhttp.open("GET", "server9.php", true);
    xhttp.send();
}
setInterval(function() {
    loadXMLDoc9();
    // 1sec
}, 1000);

window.onload = loadXMLDoc9;

function loadXMLDoc10() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("link_wrapper10").innerHTML =
                this.responseText;
        }
    };
    xhttp.open("GET", "server10.php", true);
    xhttp.send();
}
setInterval(function() {
    loadXMLDoc10();
    // 1sec
}, 1000);

window.onload = loadXMLDoc10;

function loadXMLDoc11() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("link_wrapper11").innerHTML =
                this.responseText;
        }
    };
    xhttp.open("GET", "server11.php", true);
    xhttp.send();
}
setInterval(function() {
    loadXMLDoc11();
    // 1sec
}, 1000);

window.onload = loadXMLDoc11;
</script>