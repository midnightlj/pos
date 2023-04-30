<?php
require('../dbconn.php');

// get trx_number from POST data
$trx_number = $_POST['trx_number'];

// query database for trx_number
$query = "SELECT * FROM orders WHERE trx_number = '$trx_number'";
$result = mysqli_query($conn, $query);

// check if any rows were returned
if (mysqli_num_rows($result) > 0) {
  // trx_number already exists in database
  echo "trx_exists";
} else {
  // trx_number does not exist in database
  echo "not_exists";
}

// close database connection
mysqli_close($conn);

?>