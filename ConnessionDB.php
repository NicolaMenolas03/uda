<?php
$servername = "brx553jfhvrjufqsjwzs-mysql.services.clever-cloud.com";
$username = "uhn5osobmhzmt26n";
$password = "3Oad4zijRf2TfD2CFpyQ";
$dbname = "brx553jfhvrjufqsjwzs";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>
