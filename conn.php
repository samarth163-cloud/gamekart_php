<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$hostname = "127.0.0.1";
$username = "root";
$password = "";
$database = "kmart";

$con = mysqli_connect($hostname, $username, $password, $database);

if (!$con) {
    die("Database Connection Failed: " . mysqli_connect_error());
}
?>