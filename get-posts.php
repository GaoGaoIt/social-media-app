<?php

include('config.php');



$user_id = $_SESSION['id'];



$stmt = $conn->prepare("SELECT * FROM pivot_content_data WHERE type = 'posts' and user_id= ?  ORDER BY content_id DESC");

$stmt->bind_param("i",$user_id);

$stmt->execute();

$posts = $stmt->get_result();

?>