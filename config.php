<?php

$db_host = "localhost";
$db_user = "root";
$db_password = "886488";
$db_name = "eventswave";

$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}
?>
