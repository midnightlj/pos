<?php
include('../session.php');
// Connect to the database
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'pcbm';
$conn = new mysqli($host, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Fetch the list of orders from the database
$sql = "SELECT id, DATE_FORMAT(date_created, '%m/%d/%Y') AS formatted_date_created, discount, first_name, name, status, total_price, 
        amount_paid, trx_number, user_code  
        FROM orders 
        LEFT JOIN users ON users.user_id = orders.user_id 
        LEFT JOIN nationalities ON nationalities.nat_id = orders.nat_id 
        WHERE users.user_id = $user_id 
        AND status = 'Pending'
        ";
$result = $conn->query($sql);

// Create an empty array to hold the orders
$orders = array();

// Check if there are any orders
if ($result->num_rows > 0) {
    // Loop through each order and add it to the orders array
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }
}

// Close the database connection
$conn->close();

// Add the 'actions' parameter to each row of the response data
foreach ($orders as &$order) {
    $order['actions'] = '<button class="edit-order-button" data-order-id="' . $order['id'] . '">Update</button>';
}

// Return the list of orders as JSON
echo json_encode(array('data' => $orders));
?>