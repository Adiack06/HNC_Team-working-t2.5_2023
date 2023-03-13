<?php
session_start();
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $email = $_POST['email'];
  $address = $_POST['address'];

  $sql = "INSERT INTO student (username, password, email, address) VALUES ('$username', '$password', '$email', '$address')";
  if ($conn->query($sql) === TRUE) {
    $_SESSION['user_id'] = $conn->insert_id;
    $_SESSION['username'] = $username;
    $_SESSION['email'] = $email;
    $_SESSION['address'] = $address;
    header("Location: profile.php");
    exit();
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}
?>
