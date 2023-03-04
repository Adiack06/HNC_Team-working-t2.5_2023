<html>
	<head>
		<title>REGISTRATION</title>
	</head>
	<body>
		<h1>REGISTRATION</h1>
		
		<?php
		include 'sql.php';
		
		$forename=$_POST['forename'];
		$surname=$_POST['surname'];
		$street=$_POST['street'];
		$town=$_POST['town'];
		$postcode=$_POST['postcode'];
		$email=$_POST['email'];
		$username=$_POST['username'];
		$password=$_POST['password'];
		
		$password=md5($password);
		
		$access_level = 0;
		
		echo '<pre>';
			print_r($_POST);
		echo '</pre>';
		
		$stmt = $conn->prepare("INSERT INTO users(forename,surname,street,town,postcode,email,username,password,access_level) VALUES (?,?,?,?,?,?,?,?,?)");
		
		$stmt->bind_param("ssssssssi", $forename,$surname,$street,$town,$postcode,$email,$username,$password,$access_level);		
		$stmt->execute();
		$stmt->close();
		$conn->close();
		
		echo 'User inserted<br>';
		?>
		
		click <a href="index.html">here</a> to return to the login page
	</body>
</html>
									