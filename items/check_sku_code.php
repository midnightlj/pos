<?php
require('../dbconn.php');

// get item data from POST
$sku_code = $_POST['sku_code'];

// query database for user
$query = "SELECT * FROM items WHERE sku_code = '$sku_code'";
$result = mysqli_query($conn, $query);

// check if any rows were returned
if (mysqli_num_rows($result) > 0) {
  // user already exists in database
  $code_response = array('success' => false, 'message' => 'SKU code already exists!');
} else {
  $code_response = array('success' => true);
}

// close database connection
mysqli_close($conn);

// return response as JSON
header('Content-Type: application/json');
echo json_encode($code_response);
?>
