<?php   session_start();

        include 'sql.php';//go inlude the database credentials!


        echo '<pre>';
        print_r($_POST);

        print_r($_SESSION);
        echo '</pre>';
		
		$qty=$_POST['quantity'];
		$stockno=$_POST['inventory_id'];
		$student_id=$_SESSION['student_id'];
		
		$stmt = $conn->prepare("SELECT student_id,inventory_id FROM baskets WHERE student_id = ? AND inventory_id = ?");
		$stmt->bind_param("ii", $student_id, $stockno);//things to send

		$stmt->execute();
		$stmt->store_result();

		$row_count = $stmt->num_rows; //get the number of rows! If it is 1 we are logged in! If 0 we found no match!
		

		if ($row_count ==1)
		  {
				
				$updateStmt = $conn->prepare("UPDATE baskets SET order_quantity = order_quantity + ? WHERE student_id = ? AND inventory_id = ?");
				$updateStmt->bind_param("iii", $qty, $student_id, $stockno);
				$updateStmt->execute();
				header("Location: products_page.php");
				
		  } else {
				$stmt = $conn->prepare("INSERT INTO baskets(student_id,inventory_id,order_quantity) VALUES (?,?,?)");
				$stmt->bind_param("iii",$student_id,$stockno,$qty);
				$stmt->execute();
				header("Location:products_page.php");
		};
?>