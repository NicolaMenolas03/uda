<?php
//$servername = "localhost";
//$username = "distributori";
//$password = "distributorita";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bedebreakfast";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>
