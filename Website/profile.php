<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html>
<head>
  <title>User Profile</title>
  <link rel="stylesheet" type="text/css" href="styles/style.css">
</head>
<body>
  <h1>Welcome to your profile, <?php echo $username; ?>!</h1>
  <p>Your email address is: <?php echo $email; ?></p>
  <p><a href="logout.php">Logout</a></p>
</body>
</html>
