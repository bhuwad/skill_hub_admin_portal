<?php
$servername = "localhost";
$username = "root";
$password = "root123";
$dbname = "skillhub";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
