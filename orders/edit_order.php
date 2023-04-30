<?php
if(!isset($_POST['order_id']) || empty($_POST['order_id'])) {
    die('Invalid order ID');
}

$order_id = $_POST['order_id'];

if(isset($_POST['trx_number'])) {
    $trx_number = $_POST['trx_number'];
} else {
    die('Transaction number is not set');
}

if(isset($_POST['amount_paid'])) {
    $amount_paid = $_POST['amount_paid'];
} else {
    die('Amount paid is not set');
}

// Check if the order ID is valid
if(empty($order_id)) {
    die('Order ID is empty');
}

if(isset($_POST['total_price'])) {
    $total_price = $_POST['total_price'];
  } else {
    die('Total price is not set');
  }
  
  // Calculate the discount
  $discount = ($total_price - $amount_paid) / $total_price * 100;

// Connect to the database
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'pcbm';
$conn = new mysqli($host, $username, $password, $dbname);

// Check if the transaction number already exists
$result = $conn->query("SELECT * FROM orders WHERE trx_number = '$trx_number' AND id != '$order_id'");

if ($result->num_rows > 0) {
    // Transaction number already exists
    echo 'trx_exists';
} else {
    // Transaction number doesn't exist, or is the same as the current transaction number
    $result = $conn->query("SELECT * FROM orders WHERE id = '$order_id'");
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $current_trx_number = $row['trx_number'];
        $total_price = $row['total_price'];
        $discount = $total_price - $amount_paid;

        if ($trx_number === $current_trx_number) {
            // If the transaction number is the same as the current transaction number,
            // update the amount paid only
            $result = $conn->query("UPDATE orders SET amount_paid = '$amount_paid', discount = '$discount', status='Completed' WHERE id = '$order_id'");
        } else {
            // If the transaction number is different from the current transaction number,
            // update the transaction number and amount paid
            $result = $conn->query("UPDATE orders SET trx_number = '$trx_number', amount_paid = '$amount_paid', discount = '$discount', status='Completed' WHERE id = '$order_id'");
        }

        if ($result) {
            // Order updated successfully
            echo 'success';
        } else {
            // Error updating order
            echo 'error';
        }
    } else {
        // Invalid order ID
        echo 'invalid_order_id';
    }
}

// Close the database connection
$conn->close();
?>