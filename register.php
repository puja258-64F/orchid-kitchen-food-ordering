<?php
include 'config.php';

$name    = mysqli_real_escape_string($conn, $_POST['name']);
$phone   = mysqli_real_escape_string($conn, $_POST['phone_number']);
$address = mysqli_real_escape_string($conn, $_POST['address']);

$query = "INSERT INTO customers (name, phone_number, address) 
          VALUES ('$name', '$phone', '$address')";

if (mysqli_query($conn, $query)) {
    $customer_id = mysqli_insert_id($conn);
    echo json_encode(["success" => true, "customer_id" => $customer_id, "name" => $name]);
} else {
    echo json_encode(["success" => false, "error" => mysqli_error($conn)]);
}
?>