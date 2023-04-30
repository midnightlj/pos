<?php
// database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pcbm";

// create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// retrieve options from database
$searchText = $_GET['search'];
$sql = "SELECT access_id, name FROM access WHERE name LIKE '%$searchText%'";
$result = mysqli_query($conn, $sql);

// create array of options
$options = array();
while ($row = mysqli_fetch_assoc($result)) {
  $options[] = array(
    'id' => $row['access_id'],
    'text' => $row['name']
  );
}

// output options as JSON
header('Content-Type: application/json');
echo json_encode(array('results' => $options));

// close connection
mysqli_close($conn);
?>