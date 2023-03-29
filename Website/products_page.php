<!DOCTYPE html>
<?php
  session_start();

  if ($_SESSION['loggedin'] == 'yes') {
  } else {
    header('location: index.php');
  }
?>
<html>
	<head>
		<title>Products</title>
		<link rel="stylesheet" type="text/css" href="styles/style.css">
	</head>
	<body>
	<h1>inventory</h1>
	<?php
		include 'sql.php';//include creds
		$stmt = $conn->prepare("SELECT inventory_id,description,price,qtyinstock,image_name,title FROM inventory");
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($inventory_id,$description,$price,$qtyinstock,$image_name,$title);
		
		$row_count = $stmt ->num_rows;
		
		echo 'number of rows...'.$row_count.'<br>';
		
		echo '<table border = "1" id="inventory">
			<tr>
				<th>inventory Number</th>
				<th>Image</th>
				<th>title</th>
				<th>Price</th>
				<th>Quantity</th>
				<th>Order</th>
			</tr>';
		while ($stmt ->fetch()) {
			echo '<tr>';
				echo '<td>'.$inventory_id.'</td>';
				echo '<td><img src="images/'.$image_name.'" alt="'.$description.'" style="width:300px;"></td>';
				echo '<td>'.$title.'</td>';
				echo '<td>£'.$price.'</td>';
				echo '<td>'.$qtyinstock.'</td>';
				echo '<td>';
				echo '<select name="'.$inventory_id.'" form="orderform">';
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