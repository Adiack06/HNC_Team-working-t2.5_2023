<?php
$host="127.0.0.1";//host ip
$db_username="21015823"; //mysql username
$db_password="h4ck3rm4n"; //mysql password
$db_name="AR21015823";     //mysql database name e.g AR12345678
//create connection
$conn = new mysqli($host, $db_username, $db_password, $db_name);
if ($conn->connect_error){
        die("Connection failed: ".$conn->connect_error);
};
?>
