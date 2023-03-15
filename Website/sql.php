<?php
$host="127.0.0.1";//host ip
$db_username="localadmin"; //mysql username
$db_password='Pa$$w0rd01'; //mysql password
$db_name="store"; //mysql database name e.g AR12345678
//create connection
$conn = new mysqli($host, $db_username, $db_password, $db_name);
if ($conn->connect_error){
        die("Connection failed: ".$conn->connect_error);
};
?>
