<?php

include('config.php');



$stmt = $conn->prepare("SELECT * FROM pivot_content_data where type = 'events' ORDER BY content_id DESC");

$stmt->execute();

$posts = $stmt->get_result();


