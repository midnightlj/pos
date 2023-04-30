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
$first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
$last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';
$user_name = isset($_POST['user_name']) ? $_POST['user_name'] : '';
$user_password = isset($_POST['user_password']) ? $_POST['user_password'] : '';
$user_access = isset($_POST['user_access']) ? $_POST['user_access'] : '';
$user_code = isset($_POST['user_code']) ? $_POST['user_code'] : '';
$hashed_password = sha1($user_password);

// query database for existing user with the same username
$user_name_query = "SELECT * FROM users WHERE user_name = '$user_name'";
$user_name_result = mysqli_query($conn, $user_name_query);

// check if any rows were returned
if (mysqli_num_rows($user_name_result) > 0) {
  // user already exists in database
  echo "User name already exists!";
  exit();
}

// query database for existing user with the same usercode
$user_code_query = "SELECT * FROM users WHERE user_code = '$user_code'";
$user_code_result = mysqli_query($conn, $user_code_query);

// check if any rows were returned
if (mysqli_num_rows($user_code_result) > 0) {
  // user already exists in database
  echo "User code already exists!";
  exit();
}

// insert new user into database
$insert_query = "INSERT INTO users (first_name, last_name, user_name, password, user_access, user_code)
  VALUES ('$first_name', '$last_name', '$user_name', '$hashed_password', '$user_access', '$user_code')";

if (mysqli_query($conn, $insert_query)) {
  echo "User added successfully";
} else {
  echo "Error adding user: " . mysqli_error($conn);
}

// close database connection
mysqli_close($conn);

?>
