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

// get user data from POST
$user_name = $_POST['user_name'];

// query database for user
$query = "SELECT * FROM users WHERE user_name = '$user_name'";
$result = mysqli_query($conn, $query);

// check if any rows were returned
if (mysqli_num_rows($result) > 0) {
  // user already exists in database
  $name_response = array('success' => false, 'message' => 'Username already exists!');
} else {
  $name_response = array('success' => true);
}

// close database connection
mysqli_close($conn);

// return response as JSON
header('Content-Type: application/json');
echo json_encode($name_response);
?>
