<!DOCTYPE html>
<html>
	<head>
		<style>
			#stock {
			  font-family: Arial, Helvetica, sans-serif;
			  border-collapse: collapse;
			  width: 100%;
			}

			#stock td, #stock th {
			  border: 1px solid #ddd;
			  padding: 8px;
			}

			#stock tr:nth-child(even){background-color: #f2f2f2;}

			#stock tr:hover {background-color: #ddd;}

			#stock th {
			  padding-top: 12px;
			  padding-bottom: 12px;
			  text-align: left;
			  background-color: #04AA6D;
			  color: white;
			}
		</style>
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