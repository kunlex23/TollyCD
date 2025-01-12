<?php
session_start();
if (!isset($_SESSION['userType'])) {
  header("location: ../index.php");
} elseif (($_SESSION['userType']) == "Inventory") {
  header("Location: ../okojooja");
} elseif (($_SESSION['userType']) == "Data_Entry") {
  header("Location: ../titesi");
} elseif (($_SESSION['userType']) == "Accountant") {
  header("Location: ../onisiro");
} elseif (($_SESSION['userType']) == "Admin") {
} else {
  header("location: ../index.php");
}

$hostname = "localhost";
  $username = "root";
  $password = "";
  $dbname = "cdtolly";

  $conn = mysqli_connect($hostname, $username, $password, $dbname);
  if(!$conn){
    echo "Database connection error".mysqli_connect_error();
  }
?>