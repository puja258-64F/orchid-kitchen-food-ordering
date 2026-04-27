<?php
include 'config.php';

$data        = json_decode(file_get_contents("php://input"), true);
$customer_id = $data['customer_id'];
$total       = $data['total'];
$items       = $data['items'];

// orders table এ save করো
$orderQuery = "INSERT INTO orders (customer_id, total_price, order_status) 
               VALUES ('$customer_id', '$total', 'Pending')";
mysqli_query($conn, $orderQuery);
$order_id = mysqli_insert_id($conn);

// প্রতিটা item order_items এ save করো
foreach ($items as $item) {
    $item_id  = $item['item_id'];
    $qty      = $item['quantity'];
    $subtotal = $item['subtotal'];

    $itemQuery = "INSERT INTO order_items (order_id, item_id, quantity, subtotal)
                  VALUES ('$order_id', '$item_id', '$qty', '$subtotal')";
    mysqli_query($conn, $itemQuery);
}

echo json_encode(["success" => true, "order_id" => $order_id]);
?>