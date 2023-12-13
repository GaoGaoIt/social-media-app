<?php

include('config.php');


$stmt = $conn->prepare("SELECT * FROM pivot_content_data WHERE status = 'PUBLISH' ORDER BY content_id DESC");

$stmt->execute();

$posts = $stmt->get_result();


?>