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
</head>
<body>
  <h1>Welcome to My Website!!!</h1>
  <p>Please <a href="login.php">log in</a> or <a href="register.php">register</a> to continue.</p>
</body>
</html>
