<?php

include('config.php');

$ID = $target_id;

$sql = "SELECT * FROM pivot_content_data WHERE user_id = $ID ORDER BY content_id DESC;";

//echo $sql;

$stmt = $conn->prepare($sql);

if($stmt->execute())
{
    $posts = $stmt->get_result();
}
else
{
    $posts = [];
}

?>