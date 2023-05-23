<!DOCTYPE html>
<?php include 'navbar.html';?>
<?php
  session_start();

  if ($_SESSION['loggedin'] != 'yes') {
    header('location: index.php');
    exit;
  }

  include 'sql.php'; // include database credentials
  $student_id = $_SESSION['student_id'];

  $stmt = $conn->prepare("SELECT b.inventory_id, i.title, i.image_name, b.order_quantity, i.price FROM baskets b INNER JOIN inventory i ON b.inventory_id = i.inventory_id WHERE b.student_id = ?");
  $stmt->bind_param("i", $student_id);
  $stmt->execute();
  $stmt->store_result();
  $stmt->bind_result($inventory_id, $title, $image_name, $order_quantity, $price);

  echo '<html>
    <head>
      <title>Basket</title>
      <link rel="stylesheet" type="text/css" href="styles/style.css">
    </head>
    <body>
      <h1>Basket</h1>';

  if ($stmt->num_rows > 0) {
    echo '<table border="1" id="inventory">
            <tr>
              <th>Image</th>
              <th>Title</th>
              <th>Order Quantity</th>
              <th>Total Price</th>
            </tr>';
    while ($stmt->fetch()) {
      $total_price = $order_quantity * $price;
      echo '<tr>
              <td><img src="images/' . $image_name . '" alt="' . $title . '" style="width:300px;"></td>
              <td>' . $title . '</td>
              <td>' . $order_quantity . '</td>
              <td>' . $total_price . '</td>
            </tr>';
    }
    echo '</table>';
  } else {
    echo '<p>No items in basket.</p>';
  }

  $stmt->close();
  $conn->close();
  echo '<button onclick="location.href=\'placeorder.php\'">Place Order</button>';

  echo '</body>
  </html>';
?>

