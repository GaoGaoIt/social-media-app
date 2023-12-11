<?php

include('config.php');

// Assuming you have started the session somewhere in your code
session_start();

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    // Handle the case when the user is not logged in
    // You might want to redirect them to the login page or show an error message
    exit("User is not logged in");
}

// User and post details
$user_id = $_SESSION['id'];
$post_id = $post['content_id'];

// SQL query to check if the user has liked the event/post
$sql = "SELECT * FROM likes_events WHERE User_ID = ? AND Event_ID = ?";

// Prepare the SQL statement
$stmt = $conn->prepare($sql);

// Bind parameters
$stmt->bind_param("ii", $user_id, $post_id);

// Execute the statement
$stmt->execute();

// Store the result
$stmt->store_result();

// Check if there is a like from the user
if ($stmt->num_rows > 0) {
    $reaction_status = true; // User has liked the event/post
} else {
    $reaction_status = false; // User has not liked the event/post
}

// Close the statement
$stmt->close();

// The rest of your code...

?>
