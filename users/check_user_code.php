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
$user_code = $_POST['user_code'];

// query database for user
$query = "SELECT * FROM users WHERE user_code = '$user_code'";
$result = mysqli_query($conn, $query);

// check if any rows were returned
if (mysqli_num_rows($result) > 0) {
  // user already exists in database
  $code_response = array('success' => false, 'message' => 'User code already exists!');
} else {
  $code_response = array('success' => true);
}

// close database connection
mysqli_close($conn);

// return response as JSON
header('Content-Type: application/json');
echo json_encode($code_response);
?>
