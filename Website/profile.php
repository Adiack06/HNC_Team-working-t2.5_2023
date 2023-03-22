<?php
  session_start();

  if ($_SESSION['loggedin'] == 'yes') {
  } else {
    header('location: index.php');
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Profile Page</title>
</head>
<body>
	<p>Hello <?php echo $_SESSION['username']; ?></p>
	<form method="post" action="update_profile.php">
		<label for="username">Username:</label>
		<input type="text" id="username" name="username" value="<?php echo $_SESSION['username']; ?>" />
		<br />
		<label for="email">Email:</label>
		<input type="email" id="email" name="email" value="<?php echo $_SESSION['email']; ?>" />
		<br />
		<label for="password">Password:</label>
		<input type="password" id="password" name="password";/>
		<br />
		<label for="address">Address:</label>
		<textarea id="address" name="address"><?php echo $_SESSION['address']; ?></textarea>
		<br />
		<input type="submit" value="Save Changes" />
	</form>
	<form method="post" action="logout.php">
		<input type="submit" value="Log Out" />
	</form>
</body>
</html>