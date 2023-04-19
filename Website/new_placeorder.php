<?php
session_start();

include 'sql.php';//go inlude the database credentials!

$student_id = $_SESSION['student_id'];

$stmt = $conn->prepare("INSERT INTO orders (student_id) VALUES (?)");
$stmt->bind_param("i",$student_id);
$stmt->execute();

//now go get the orderno:
$stmt = $conn->prepare("SELECT orderno FROM orders WHERE student_id = ? ORDER BY orderno DESC LIMIT 1");
$stmt->bind_param("i",$student_id);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($orderno);
$stmt->fetch();

echo '<br>Orderno: '.$orderno.'<br>';

$total=0;

// Get all the items in the user's basket
$stmt = $conn->prepare("SELECT b.inventory_id, i.title, i.price, b.order_quantity FROM baskets b INNER JOIN inventory i ON b.inventory_id = i.inventory_id WHERE b.student_id = ?");
$stmt->bind_param("i", $student_id);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($inventory_id, $title, $price, $order_quantity);

while ($stmt->fetch()) {
    $total_price = $order_quantity * $price;
    echo $title.'--'.$order_quantity.'--'.$price.'<br>';

    // Insert the item into the orderline table
    $stmt_insert = $conn->prepare("INSERT INTO orderline (orderno, inventory_id, qty) VALUES (?,?,?)");
    $stmt_insert->bind_param("isi",$orderno,$inventory_id,$order_quantity);
    $stmt_insert->execute();
    // Update the inventory quantity
    $stmt_update = $conn->prepare("UPDATE inventory SET qtyinstock = (qtyinstock - ?) WHERE inventory_id = ?");
    $stmt_update->bind_param("ii",$order_quantity,$inventory_id);
    $stmt_update->execute();

    $total = $total + $total_price;
}

$stmt_delete = $conn->prepare("DELETE FROM baskets WHERE student_id = ?");
$stmt_delete->bind_param("i", $student_id);
$stmt_delete->execute();
$stmt_delete->close();

echo 'Total: '.$total.'<br>';
echo 'Total (with VAT): '.$total*1.2;

$stmt->close();
$stmt_insert->close();
$stmt_update->close();
$conn->close();
?>
<br><br>
//Button to print receipt(window)
<button onclick="window.print()">Print Receipt</button>

//Link back to products
<a href="product.php">Back to product</a>

