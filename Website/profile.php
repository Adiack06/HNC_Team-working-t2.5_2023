<?php
  session_start();

  if ($_SESSION['loggedin'] == 'yes') {
    echo 'Logged in!';
  } else {
    header('location: index.html');
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Super Secret Stuff</title>
	<link rel="stylesheet" type="text/css" href="styles/style.css">
  </head>
  <body>
    <div class="info-box">
      <h3>Super Secret Stuff</h3>
      <p>Welcome to the super secret page!</p>
      <p>Only authorized users can access this content.</p>
      <a href="logout.php">Log out</a>
    </div>
  </body>
</html>
