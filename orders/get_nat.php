<?php
require('../dbconn.php');

// retrieve options from database
$searchText = $_GET['search'];
$sql = "SELECT nat_id, name FROM nationalities WHERE name LIKE '%$searchText%'";
$result = mysqli_query($conn, $sql);

// create array of options
$options = array();
while ($row = mysqli_fetch_assoc($result)) {
  $options[] = array(
    'id' => $row['nat_id'],
    'text' => $row['name']
  );
}

// output options as JSON
header('Content-Type: application/json');
echo json_encode(array('results' => $options));

// close connection
mysqli_close($conn);
?>