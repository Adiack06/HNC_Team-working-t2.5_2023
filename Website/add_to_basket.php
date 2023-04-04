<?php   session_start();

        include 'sql.php';//go inlude the database credentials!


        echo '<pre>';
        print_r($_POST);

        print_r($_SESSION);
        echo '</pre>';
		
		$qty=$_POST['quantity'];

		$stmt = $conn->prepare("INSERT INTO baskets(student_id,inventory_id,order_quantity) VALUES (?,?,?)");
		$stmt->bind_param("iii",$student_id,$stockno,$qty);
		$stmt->execute();
		header("Location:products_page.php");
?>