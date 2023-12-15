<?php

if(isset($_POST['drop_comments']))
{
    $post_id = $_POST['post_id'];

    $comment_id = $_POST['comment_id'];

    // echo $post_id ;
    // echo $comment_id ;
    // exit;

    Drop_Comment($comment_id, $post_id);
}
else
{
    $send = "Single-Event.php?post_id=$post_id&error_message=Unrecognized Request";

    header("location: $send");

    exit;
}

function Drop_Comment($comment_id, $post_id)
{
    include 'config.php';

    $SQL = "DELETE FROM comments_events WHERE COMMENT_ID = $comment_id";

    $stmt = $conn->prepare($SQL);
    echo $post_id;
    exit;

    if ($stmt->execute())
    {
        

        header("Location: Single-Event.php?post_id=$post_id&success_message=Opinion Successfully Dropped");
        exit;


    } else {

        $send = "Single-Event.php?post_id=$post_id&error_message=Problem With Drop Your Post";

        header("location: $send");

        exit;
    }
}


