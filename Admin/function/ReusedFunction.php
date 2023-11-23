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

function postCount($typeName)
{
    global $conn;  // Assuming you have a global database connection object

    $query = "SELECT COUNT(*) as count FROM pivot_content_data WHERE type = ?";


    $stmt = mysqli_prepare($conn, $query);


    if ($stmt) {


        mysqli_stmt_bind_param($stmt, "s", $typeName);

        mysqli_stmt_execute($stmt);


        $result = mysqli_stmt_get_result($stmt);


        if ($result) {

            $count = mysqli_fetch_assoc($result)['count'];

            mysqli_free_result($result);

            mysqli_stmt_close($stmt);

            return $count;
        } else {

            echo "Error: " . mysqli_error($conn);
        }
    } else {

        echo "Error: " . mysqli_error($conn);
    }

    // Close the statement (in case of an error)
    mysqli_stmt_close($stmt);

    return null;
};


function studentCount()
{
    global $conn;  // Assuming you have a global database connection object

    $query = "SELECT COUNT(*) as count FROM users where USER_TYPE  = 1" ;


    $stmt = mysqli_prepare($conn, $query);


    if ($stmt) {



        mysqli_stmt_execute($stmt);


        $result = mysqli_stmt_get_result($stmt);


        if ($result) {

            $count = mysqli_fetch_assoc($result)['count'];

            mysqli_free_result($result);

            mysqli_stmt_close($stmt);

            return $count;
        } else {

            echo "Error: " . mysqli_error($conn);
        }
    } else {

        echo "Error: " . mysqli_error($conn);
    }

    // Close the statement (in case of an error)
    mysqli_stmt_close($stmt);

    return null;
}
