<!DOCTYPE html>
<html>
<head>
	<title>Product</title>
	<link rel="stylesheet" type="text/css" href="styles/style.css">
</head>
<body>
	<?php 
		$inventory_id = $_GET['inventory_id'];
		$title = $_GET['title'];
		$description = $_GET['description'];
		$author_brand = $_GET['author_brand'];
		$form = $_GET['form'];
		$image_name = $_GET['image_name'];
		$price = $_GET['price'];
		$qtyinstock = $_GET['qtyinstock'];
	?>
	<h1><?php echo $title; ?></h1>
	<img src="images/<?php echo $image_name; ?>" alt="<?php echo $description; ?>" style="width:300px;">
	<p><strong>Description:</strong> <?php echo $description; ?></p>
	<p><strong>Author/Brand:</strong> <?php echo $author_brand; ?></p>
	<p><strong>Form:</strong> <?php echo $form; ?></p>
	<p><strong>Price:</strong> <?php echo $price; ?></p>
	<p><strong>Quantity in stock:</strong> <?php echo $qtyinstock; ?></p>
	<form action="add_to_basket.php" method="post">
		<input type="hidden" name="inventory_id" value="<?php echo $inventory_id; ?>">
		<label for="quantity">Select quantity:</label>
		<select id="quantity" name="quantity">
			<?php 
				for ($i=1; $i<=$qtyinstock; $i++) { 
					echo "<option value='$i'>$i</option>";
				}
			?>
		</select>
		<br>
		<button type="submit">Add to basket</button>
	</form>
	<a href="#" onclick="history.back(); return false;">Back</a>
</body>
</html>