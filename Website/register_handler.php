<html>
	<head>
		<title>REGISTRATION</title>
	</head>
	<body>
		<h1>REGISTRATION</h1>
		
		<?php
		include 'sql.php';
		
		$username=$_POST['username'];
		$email=$_POST['email'];
		$address=$_POST['address'];
		$password=$_POST['password'];
		
		$password=md5($password);

		
		echo '<pre>';
			print_r($_POST);
		echo '</pre>';
		
		$stmt = $conn->prepare("INSERT INTO student(username,email,address,password) VALUES (?,?,?,?)");
		
		$stmt->bind_param("ssss", $username,$email,$address,$password);		
		$stmt->execute();
		$stmt->close();
		$conn->close();
		
		echo 'User inserted<br>';
		header("Location:login_page.html");
		?>
		
		
	</body>
</html>