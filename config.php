<?php

$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "student_social_media";

// 创建数据库连接
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// 检查连接是否成功
if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}

// 其他代码继续执行...
