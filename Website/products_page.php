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
		$stmt = $conn->prepare("SELECT inventory_id,description,price,qtyinstock,image_name,title,author_brand,form FROM inventory");
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($inventory_id,$description,$price,$qtyinstock,$image_name,$title,$author_brand,$form);
		
		$row_count = $stmt ->num_rows;
		
		echo 'number of rows...'.$row_count.'<br>';
		
		echo '<table border = "1" id="inventory">
			<tr>
				<th>Image</th>
				<th>title</th>
			</tr>';
		while ($stmt ->fetch()) {
			echo '<tr>';
				echo '<td><img src="images/'.$image_name.'" alt="'.$description.'" style="width:300px;"></td>';
				echo '<td><a href="product.php?inventory_id=' .$inventory_id. '&title=' .$title.'&description=' .$description.'&author_brand=' .$author_brand.'&form=' .$form. '&image_name=' .$image_name.'&price=' .$price.'&qtyinstock=' .$qtyinstock.'">'.$title.'</a></td>';
				echo '</td>';
				
			echo '</tr>';
		};
		
		$stmt ->close();
		$conn ->close();
		echo '<button onclick="location.href=\'basket.php\'">Basket</button>';
		
		echo '</table>';
	?>
	</body>
</html>