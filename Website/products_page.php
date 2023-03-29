<!DOCTYPE html>
<html>
	<head>
		<title>Login or Register</title>
		<link rel="stylesheet" type="text/css" href="styles/style.css">
	</head>
	<body>
	<h1>STOCK</h1>
	<?php
		include 'sql.php';//include creds
		$stmt = $conn->prepare("SELECT stockno,description,price,qtyinstock FROM stock");
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($stockno,$description,$price,$qtyinstock);
		
		$row_count = $stmt ->num_rows;
		
		echo 'number of rows...'.$row_count.'<br>';
		
		echo '<table border = "1" id="stock">
			<tr>
				<th>Stock Number</th>
				<th>Image</th>
				<th>Description</th>
				<th>Price</th>
				<th>Quantity</th>
				<th>Order</th>
			</tr>';
		while ($stmt ->fetch()) {
			echo '<tr>';
				echo '<td>'.$stockno.'</td>';
				echo '<td><img src="images/'.$stockno.'.jpg" alt="'.$description.'" style="width:300px;"></td>';
				echo '<td>'.$description.'</td>';
				echo '<td>£'.$price.'</td>';
				echo '<td>'.$qtyinstock.'</td>';
				echo '<td>';
				echo '<select name="'.$stockno.'" form="orderform">';
				for($i=0;$i<$qtyinstock+1;$i++){
					echo ' <option value="' . $i . '">' . $i . '</option>';
				};
				echo '</select>';
				echo '</td>';
				
			echo '</tr>';
		};
		
		$stmt ->close();
		$conn ->close();
		
		echo '<form action="placeorder.php" method = "post" id="orderform">
		<input type="submit" value="Order">
		</form>';
		
		echo '</table>';
	?>
	</body>
</html>