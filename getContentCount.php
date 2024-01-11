<?php
include 'config.php';

function PostLikesCount($ContentId)
{
    global $conn;

    $query = "select count(*) from likes where Post_ID  = $ContentId";

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
function EventsLikesCount($ContentId)
{
    global $conn;

    $query = "select count(*) from likes_events where Post_ID  = $ContentId";

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

function VideosLikesCount($ContentId)
{
    global $conn;

    $query = "select count(*) from likes_vid where Post_ID  = $ContentId";

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