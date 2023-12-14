<?php

$db_host = "118.107.200.71";
$db_user = "sam";
$db_password = "886488Sam@";
$db_name = "SocialMediaSynergy";

$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}
?>
