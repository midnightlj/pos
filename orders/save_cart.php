<?php
include('../session.php');

// Read the request body as JSON
$requestBody = json_decode(file_get_contents('php://input'), true);
$cart = $requestBody['cart'];
$nationality = $requestBody['nationality'];

// Connect to the database
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'pcbm';
$conn = mysqli_connect($host, $user, $password, $database);

// Insert a new row into the orders table with the total price
$total_price = 0;
$user_id = $_SESSION['user_id'];
foreach ($cart as $item) {
  $total_price += $item['price'] * $item['quantity'];
}
$sql = "INSERT INTO orders (user_id, nat_id, total_price) VALUES ('$user_id', '$nationality', '$total_price')";
mysqli_query($conn, $sql);

// Retrieve the auto-generated ID of the new order
$order_id = mysqli_insert_id($conn);

// Insert multiple rows into the order_details table with the product SKU code, name, price, and quantity
foreach ($cart as $item) {
  $sku_code = mysqli_real_escape_string($conn, $item['sku_code']);
  $name = mysqli_real_escape_string($conn, $item['name']);
  $price = $item['price'];
  $quantity = $item['quantity'];
  $sql = "INSERT INTO order_details (order_id, sku_code, name, price, quantity) VALUES ('$order_id', '$sku_code', '$name', '$price', '$quantity')";
  mysqli_query($conn, $sql);
}

// Close the database connection
mysqli_close($conn);

// Send a response with status 200 (OK)
http_response_code(200);
?>
