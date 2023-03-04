<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="styles/style.css">
	</head>
	<body>
		<h1>Products</h1>
		<table>
			<tr>
				<th>Product Name</th>
				<th>Description</th>
				<th>Price</th>
				<th>Quantity Available</th>
			</tr>
			<?php
				include 'sql.php';//include creds
				$stmt = $conn->prepare("SELECT product_name,description,price,qty_available FROM products");
				$stmt->execute();
				$stmt->store_result();
				$stmt->bind_result($product_name,$description,$price,$qty_available);
				
				$row_count = $stmt ->num_rows;
				
				echo '<p>Number of products: '.$row_count.'</p>';
				
				while ($stmt ->fetch()) {
					echo '<tr>';
						echo '<td>'.$product_name.'</td>';
						echo '<td>'.$description.'</td>';
						echo '<td>$'.$price.'</td>';
						echo '<td>'.$qty_available.'</td>';
					echo '</tr>';
				};
				
				$stmt ->close();
				$conn ->close();
			?>
		</table>
	</body>
</html>
