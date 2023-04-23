<?php
session_start();

include 'sql.php';//go inlude the database credentials!

$student_id = $_SESSION['student_id'];

$stmt = $conn->prepare("SELECT o.orderno, i.title, i.price, b.order_quantity FROM orders o 
                        INNER JOIN orderline ol ON o.orderno = ol.orderno 
                        INNER JOIN inventory i ON ol.inventory_id = i.inventory_id 
                        INNER JOIN baskets b ON i.inventory_id = b.inventory_id 
                        WHERE b.student_id = ? AND o.student_id = ? 
                        ORDER BY o.orderno DESC, i.title ASC");
$stmt->bind_param("ii", $student_id, $student_id);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($orderno, $title, $price, $order_quantity);

echo '<table>';
echo '<tr><th>Title</th><th>Price</th><th>Quantity</th><th>Order Quantity</th><th>Total Price</th><th>Price (including VAT)</th></tr>';

while ($stmt->fetch()) {
    $total_price = $order_quantity * $price;
    $total = $total + $total_price;
    $total_vat = $total * 1.2;
    echo '<tr><td>'.$title.'</td><td>'.$price.'</td><td>'.$order_quantity.'</td><td>'.$total_price.'</td><td>'.$total.'</td><td>'.$total_vat.'</td></tr>';
}

echo '</table>';

$stmt->close();
$conn->close();

echo '<br><button onclick="window.print()">Print</button>';
echo '<button onclick="window.location.href=\'products.php\'">Go back to Products</button>';
?>
