<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Project_101";

$con = mysqli_connect($servername, $username, $password, $dbname);

if (!$con) {
    die("Connection failed: " . mysqli_error($con));
}
?>
