<?php
require('../dbconn.php');

// get user data from POST
$sku_code = isset($_POST['sku_code']) ? $_POST['sku_code'] : '';
$item_name = isset($_POST['item_name']) ? $_POST['item_name'] : '';
$item_price = isset($_POST['item_price']) ? $_POST['item_price'] : '';


// query database for existing item with the same sku_code
$sku_code_query = "SELECT * FROM items WHERE sku_code = '$sku_code'";
$sku_code_result = mysqli_query($conn, $sku_code_query);

// check if any rows were returned
if (mysqli_num_rows($sku_code_result) > 0) {
  // Item already exists in database
  echo "SKU code already exists!";
  exit();
}

// insert new item into database
$insert_query = "INSERT INTO items (sku_code, name, price)
  VALUES ('$sku_code', '$item_name', '$item_price')";

if (mysqli_query($conn, $insert_query)) {
  echo "Item added successfully";
} else {
  echo "Error adding Item: " . mysqli_error($conn);
}

// close database connection
mysqli_close($conn);

?>
