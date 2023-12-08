<?php

session_start();

include("config.php");

$post_id = isset($_POST['post_id']) ? $_POST['post_id'] : '';

$comment = isset($_POST['comment']) ? $_POST['comment'] : '';
$type = isset($_POST['type']) ? $_POST['type'] : '';

// $test  = [ 
//     'postID' => $post_id,
//     'comment' => $comment,
//     'type' => $type
// ];

// echo $post_id;



$user_id = $_SESSION['id'];

$date = date("Y-m-d H:i:s");
    
$sql = "INSERT INTO reports(POST_ID, USER_ID, type, message, DATE)VALUES ($post_id, $user_id, '$type' , '$comment','$date');";

echo ($sql);
    
$stmt = $conn->prepare($sql);

if($stmt->execute())
{
    header("location: home.php");
}
else
{
    header("location: reports.php?contentId=" . $post_id."&error_message=Your Opinion Submission Abort");

}

exit;

?>