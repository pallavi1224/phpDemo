<?php
$username = "root";
$host = "localhost";
$password = "";
$database = "demo_trial";

$conn = mysqli_connect($host,$username,$password,$database);

if(!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>