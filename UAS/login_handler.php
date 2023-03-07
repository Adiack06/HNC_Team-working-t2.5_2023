<?php
session_start();
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM users WHERE username='$username'";
  $result = $conn->query($sql);

  if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
      $_SESSION['user_id'] = $row['id'];
      $_SESSION['username'] = $row['username'];
      $_SESSION['email'] = $row['email'];
      header("Location: profile.php");
      exit();
    } else {
      // Invalid password
      header("Location: login.php?error=invalid_password");
      exit();
    }
  } else {
    // User not found
    header("Location: login.php?error=user_not_found");
    exit();
  }
}
?>
