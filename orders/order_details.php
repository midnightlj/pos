<?php
// Fetch the order details for the specified order ID
$order_id = $_POST['order_id'];

// Make a database connection
$conn = new mysqli('localhost', 'root', '', 'pcbm');
if ($conn->connect_error) {
  die('Connection failed: ' . $conn->connect_error);
}

// Fetch the order details from the order_details table
$sql = "SELECT * FROM order_details 
        LEFT JOIN orders ON orders.id = order_details.order_id 
        WHERE order_id = $order_id";
$result = $conn->query($sql);

// Build the HTML for the order details table
$order_details_html = '';
if ($result->num_rows > 0) {
  $total_order_price = 0;
  while ($row = $result->fetch_assoc()) {
    $order_details_html .= '<tr>';
    $order_details_html .= '<td>' . $row['name'] . '</td>';
    $order_details_html .= '<td>' . $row['quantity'] . '</td>';
    $order_details_html .= '<td>P ' . number_format($row['price'], 2) . '</td>';
    $order_details_html .= '<td>
                              <button class="w3-btn w3-round-large w3-green w3-padding-small increase-btn" id="increase-btn-' . $row['id'] . '-' . $row['sku_code'] . '">+</button>  
                              <button class="w3-btn w3-round-large w3-red w3-padding-small decrease-btn" id="decrease-btn-' . $row['id'] . '-' . $row['sku_code'] . '">-</button>
                            </td>';
    $order_details_html .= '</tr>';
    $total_order_price += $row['quantity'] * $row['price'];
    $amount_paid = $row['amount_paid'];
    $trx_number = $row['trx_number'];
  }
  
  $order_details_html .= '<tr><td></td><td><strong>Total: </strong></td><td><strong class="total-price-cell">P ' . number_format($total_order_price, 2) . '</strong></td></td><td></tr>';
} else {
  $order_details_html = '<tr><td colspan="3">No order details found.</td></tr>';
  $total_price = 0;
  $amount_paid = 0;
}

// Close the database connection
$conn->close();

// Return the order details HTML and additional data in a JSON format
echo json_encode(array(
  'order_details_html' => $order_details_html,
  'data_details' => array(
    'trx_number' => $trx_number,
    'amount_paid' => $amount_paid
  )
));
?>

