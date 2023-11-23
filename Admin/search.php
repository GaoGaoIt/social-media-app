<?php
include 'config.php';
include 'function/ReusedFunction.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $authorName = $_POST["authorName"];

    if (empty($authorName)) {

        $query = "SELECT * FROM pivot_content_data";
    } else {
        $userid  = fetchUserId($authorName);
        $query = "SELECT * FROM pivot_content_data WHERE user_id  = $userid";
    }

    $result = mysqli_query($conn, $query);


    mysqli_free_result($result);
} else {
    echo "Error: " . mysqli_error($conn);
}
