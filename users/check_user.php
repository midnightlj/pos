<?php

// connect to database
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'pcbm';
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// check for errors
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}

// get user_name from POST data
$user_name = $_POST['user_name'];

// query database for user_name
$query = "SELECT * FROM users WHERE user_name = '$user_name'";
$result = mysqli_query($conn, $query);

// check if any rows were returned
if (mysqli_num_rows($result) > 0) {
  // user_name already exists in database
  echo "user_name_exists";
} else {
  // user_name does not exist in database
  echo "user_name_not_exists";
}

// close database connection
mysqli_close($conn);

?>