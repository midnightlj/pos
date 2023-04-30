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

// Fetch all users from the database
$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);

// Check for query error
if (!$result) {
    die('Error executing query: ' . mysqli_error($conn));
}

// Create an empty array to store the results
$users = [];

// Loop through the result set and add each row to the users array
while ($row = mysqli_fetch_assoc($result)) {
    $users[] = $row;
}

// Return the users array as JSON
echo json_encode($users);

// Close the database connection
mysqli_close($conn);
?>
