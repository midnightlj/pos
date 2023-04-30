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
?>