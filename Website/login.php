<?php
        session_start();
?>

<!DOCTYPE html>
<html>
	<head>
        <title>
            my first website
        </title>
    </head>
	<body>
		<h1>SQL Results</h1>
		<?php
			
				$username=$_POST['username'];
				$password=$_POST['password'];

				$password = md5($password);

				require 'sql.php';//include the credentials
				//prepare and bind
				//NOTE we cannot do select * from
				//we MUST specify what is to be returned!!
				$stmt = $conn->prepare("SELECT student_id,username,password,email,address FROM student WHERE username = ? AND password = ?");

				$stmt->bind_param("ss", $username, $password);//things to send

				$stmt->execute();
				$stmt->store_result();
				$stmt->bind_result($student_id,$username,$password,$email,$address); //things to retrieve

				$row_count = $stmt->num_rows; //get the number of rows! If it is 1 we are logged in! If 0 we found no match!

				echo 'number of rows.....'.$row_count.'<br>';

				while ($stmt->fetch()) {
						echo $student_id.'<br>';
						echo $username.'<br>';
						echo $password.'<br>';
						echo $email.'<br>';
						echo $address.'<br>';
				};

				$stmt->close(); //close the sql
				$conn->close(); //close the connection



				//so how do we tell we are logged in??

				if ($row_count ==1)
				  {
						$_SESSION['loggedin'] = 'yes';
						header('location:profile.php');
						
				  } else {
						session_unset();
						session_destroy();
						header('location:index.php');
				};

				//What about access level?
				echo 'Access level = '.$access_level;

		?>
	</body>
</html>
