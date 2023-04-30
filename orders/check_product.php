<?php

  $servername = "localhost"; // replace with your server name
  $username = "root"; // replace with your username
  $password = ""; // replace with your password
  $dbname = "pcbm"; // replace with your database name

  // create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Get the product name from the POST parameters
$product = $_POST['product'];

// Prepare and execute a SELECT statement to check if the product exists
$stmt = $conn->prepare("SELECT * FROM items WHERE sku_code = ?");
$stmt->bind_param("s", $product);
$stmt->execute();

// Get the result of the SELECT statement
$result = $stmt->get_result();
if ($result->num_rows > 0) {
  // If the product exists, return its details
  $row = $result->fetch_assoc();
  $response = array(
    'exists' => true,
    'sku_code' => $row['sku_code'],
    'name' => $row['name'],
    'price' => $row['price']
  );
} else {
  // If the product doesn't exist, return an error message
  $response = array(
    'exists' => false,
    'message' => 'Product not found'
  );
}

// Return a JSON response with the product details or error message
echo json_encode($response);

// Close the database connection
$stmt->close();
$conn->close();
?>
