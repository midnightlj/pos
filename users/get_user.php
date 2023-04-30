<?php
include('../config.php');

// Check if the user_id parameter is set in the request
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    // Fetch the user with the given user_id from the database
    $query = "SELECT * FROM users WHERE user_id = $user_id";
    $result = mysqli_query($conn, $query);

    // Check if a user was found with the given user_id
    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);

        // Return the user as JSON
        echo json_encode($user);
    } else {
        // If no user was found, return an error message
        echo json_encode(['error' => 'User not found']);
    }
} else {
    // If the user_id parameter is not set, return an error message
    echo json_encode(['error' => 'User ID parameter is missing']);
}