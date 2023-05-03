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
		<style>
			#inventory {
				display: grid;
				grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
				grid-gap: 20px;
			}
			#inventory img {
				max-width: 100%;
			}
			#inventory a {
				color: #000;
				text-decoration: none;
			}
			#inventory a:hover {
				color: #f00;
			}
		</style>
	</head>
	<body>
	<h1>inventory</h1>
	<?php
	include 'sql.php';//include creds
	$stmt = $conn->prepare("SELECT inventory_id, description, price, qtyinstock, image_name, title, author_brand, form FROM inventory");
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($inventory_id, $description, $price, $qtyinstock, $image_name, $title, $author_brand, $form);
	
	$row_count = $stmt->num_rows;
	$title_length = 50; // set the desired length of the title
	echo '<div id="inventory">';
	while ($stmt->fetch()) {
    	echo '<div>';
    	echo '<img src="images/' . $image_name . '" alt="' . $description . '">';
    	echo '<h2><a href="product.php?inventory_id=' . $inventory_id . '&title=' . $title . '&description=' . $description . '&author_brand=' . $author_brand . '&form=' . $form . '&image_name=' . $image_name . '&price=' . $price . '&qtyinstock=' . $qtyinstock . '">' . $title . '</a></h2>';

    	if (strlen($title) < $title_length) {
    		// add empty space to make titles the same length
      		echo '<p>' . $title . str_repeat('&nbsp;', $title_length - strlen($title)) . '</p>';
    	} else {
      		echo '<p>' . $title . '</p>';
   	 	}

    	echo '</div>';
	};
	echo '</div>';

	$stmt->close();
	$conn->close();
	echo '<button onclick="location.href=\'basket.php\'">Basket</button>';
	?>

	</body>
</html>
