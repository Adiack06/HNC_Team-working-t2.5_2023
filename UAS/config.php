<?php
$servername = "127.0.0.1";
$username = "21015823";
$password = "h4ck3rm4n";
$dbname = "AR21015823";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
