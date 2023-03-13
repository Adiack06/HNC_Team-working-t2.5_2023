<?php
session_start();
if (isset($_SESSION['user_id'])) {
  header("Location: profile.php");
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login or Register</title>
  <link rel="stylesheet" type="text/css" href="styles/style.css">
</head>
<body>
  <h1>Welcome to the 357 Ltd store</h1>
  <p>We sell many of the items you will nead for HN Computing from from books and cds to software and RJ45 Jacks</p> 
  <p>Please <a href="login.php">log in</a> or <a href="register.php">register</a> to continue.</p>
</body>
</html>
