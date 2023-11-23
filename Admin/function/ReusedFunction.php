<?php
include '../config.php';

function fetchUserName($userId)
{
    global $conn;

    $query = "SELECT USER_NAME FROM Users WHERE User_ID = ?";

    $stmt = mysqli_prepare($conn, $query);

    mysqli_stmt_bind_param($stmt, "i", $userId);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);


    if ($result) {

        $user = mysqli_fetch_assoc($result);

        mysqli_free_result($result);

        return $user ? $user['USER_NAME'] : null;
    } else {
        echo "Error: " . mysqli_error($conn);
        return null;
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}

function  fetchUserId($username)
{
    global $conn;

    $query = "SELECT User_ID FROM Users WHERE User_Name = ?";

    $stmt = mysqli_prepare($conn, $query);

    mysqli_stmt_bind_param($stmt, "s", $username);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);


    if ($result) {

        $user = mysqli_fetch_assoc($result);

        mysqli_free_result($result);

        return $user ? $user['User_ID'] : null;
    } else {
        echo "Error: " . mysqli_error($conn);
        return null;
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}

// function performSearch($query)
// {
//     global $conn;  

//     echo $conn;

// }
