<?php
session_start();

if ($_SESSION['loggedin'] != 'yes') {
  header('location: index.php');
  exit();
}

include 'sql.php';
$student_id = $_SESSION['student_id'];

// Retrieve existing user data from database
$sql = "SELECT * FROM student WHERE student_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $student_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows !== 1) {
    // Handle error
    die("User not found");
}
$user_data = $result->fetch_assoc();

// Get updated form data
$username = (!empty($_POST['username'])) ? $_POST['username'] : $user_data['username'];
$email = (!empty($_POST['email'])) ? $_POST['email'] : $user_data['email'];
$address = (!empty($_POST['address'])) ? $_POST['address'] : $user_data['address'];

$password = $user_data['password'];
$new_password = $_POST['password'];
if (!empty($new_password) && $new_password !== $password) {
    $password = md5($new_password);
}

// Update user data in database
$stmt = $conn->prepare("UPDATE student SET username=?, email=?, address=?, password=? WHERE student_id=?");
$stmt->bind_param("ssssi", $username, $email, $address, $password, $student_id);		
$stmt->execute();
$stmt->close();
$conn->close();
		
// Update session variables
$_SESSION['username'] = $username;
$_SESSION['email'] = $email;
$_SESSION['address'] = $address;
		
echo 'User updated<br>';
header("Location: profile.php");
?>