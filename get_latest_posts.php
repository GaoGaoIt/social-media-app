<?php

include('config.php');


if(isset($_GET['page_no']) && $_GET['page_no'] != "")
{
    $page_no = $_GET['page_no'];
}else
{
    $page_no = 1;
}

$sql = "SELECT COUNT(*) as total_posts FROM pivot_content_data where status = 'PUBLISH'";

$stmt = $conn->prepare($sql);

$stmt = $conn->prepare("SELECT * FROM pivot_content_data WHERE status = 'PUBLISH' ORDER BY content_id DESC LIMIT ?, ?;");

if ($stmt === false) {
    die('Error in SQL query: ' . $conn->error);
}

$stmt->bind_param("ii", $offest, $total_posts_per_page);

$stmt->execute();


$stmt->bind_result($total_posts);

$stmt->store_result();

$stmt->fetch();

$total_posts_per_page = 10;

$offest = ($page_no - 1) * $total_posts_per_page;

// that php ceil function return rounded numbers

$total_number_pages = ceil($total_posts/$total_posts_per_page);

$stmt = $conn->prepare("SELECT * FROM pivot_content_data WHERE status = 'PUBLISH' ORDER BY content_id DESC LIMIT $offest, $total_posts_per_page;");

$stmt->execute();

$posts = $stmt->get_result();


?>