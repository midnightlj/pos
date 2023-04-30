<?php
// Database connection parameters
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'pcbm';

// Create a new database connection
$conn = mysqli_connect($host, $username, $password, $database);

// Check for errors
if (!$conn) {
    die('Database connection error: ' . mysqli_connect_error());
}

// Get the values for the edited user from the POST request
$user_id = $_POST['user_id'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$user_name = $_POST['user_name'];
$user_access = $_POST['user_access'];
$user_code = $_POST['user_code'];

// Update the user in the database
$query = "UPDATE users SET first_name='$first_name', last_name='$last_name', user_name='$user_name', user_access='$user_access', user_code='$user_code' WHERE user_id='$user_id'";
$result = mysqli_query($conn, $query);

// Check for query error
if (!$result) {
    die('Error executing query: ' . mysqli_error($conn));
}

// Close the database connection
mysqli_close($conn);
?>
