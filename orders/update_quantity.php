<?php
// ini_set('display_errors', 1);
// error_reporting(E_ALL);
// Get the ID, SKU code, and new quantity from the AJAX request
$id = $_POST['row_id'];
$sku_code = $_POST['sku_code'];
$quantity = $_POST['new_quantity'];

// Make a database connection
$conn = new mysqli('localhost', 'root', '', 'pcbm');
if ($conn->connect_error) {
  die('Connection failed: ' . $conn->connect_error);
}

// Update the quantity in the order_details table
$sql = "UPDATE order_details SET quantity = $quantity WHERE order_id = '$id' AND sku_code = '$sku_code'";
$result = $conn->query($sql);

// Fetch the updated order details from the database
$sql = "SELECT * FROM order_details WHERE order_id = '$id'";
$result = $conn->query($sql);

// Build the HTML for the order details table
$order_details_html = '';
if ($result->num_rows > 0) {
  $total_order_price = 0;
  while ($row = $result->fetch_assoc()) {
    $order_details_html .= '<tr>';
    $order_details_html .= '<td>' . $row['name'] . '</td>';
    $order_details_html .= '<td>' . $row['quantity'] . '</td>';
    $order_details_html .= '<td>P' . $row['price'] . '</td>';
    $order_details_html .= '<td><button class="w3-btn w3-round-large w3-red w3-padding-small decrease-btn" id="decrease-btn-' . $row['order_id'] . '-' . $row['sku_code'] . '">-</button></td>';
    $order_details_html .= '</tr>';
    $total_order_price += $row['quantity'] * $row['price'];
  }
 
 // Update the total price of the order in the orders table
$sql = "UPDATE orders SET total_price = $total_order_price WHERE id = '$id'";
$conn->query($sql);

// Fetch the updated total price and amount paid from the database
$sql = "SELECT total_price, amount_paid FROM orders WHERE id = '$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$new_total_price = $row['total_price'];
$amount_paid = $row['amount_paid'];

// Calculate the discount and update the orders table
$discount = $new_total_price - $amount_paid;
$sql = "UPDATE orders SET discount = $discount WHERE id = '$id'";
$conn->query($sql);

$order_details_html .= '<tr><td></td><td><strong>Total: </strong></td><td><strong class="total-price-cell">' . $new_total_price . '</strong></td><td></td></tr>';
}
// Close the database connection
$conn->close();

// Return the updated order details HTML and the new total price of the order in a JSON format
echo json_encode(array(
  'order_details_html' => $order_details_html,
  'new_total_price' => $new_total_price,
  'discount' => $discount
));

?>
