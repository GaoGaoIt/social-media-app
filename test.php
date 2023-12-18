<?php

include('config.php');

$stmt = $conn->prepare("SELECT * FROM comments WHERE POST_ID = 17 ORDER BY COMMENT_ID LIMIT 10");

$stmt->execute();

$comments = $stmt->get_result();



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <title>Eventswave</title>

    <link rel="icon" href="assets/images/event_accepted_50px.png" type="image/icon type">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-+qdLaIRZfNu4cVPK/PxJJEy0B0f3Ugv8i482AKY7gwXwhaCroABd086ybrVKTa0q" crossorigin="anonymous">

    <link rel="stylesheet" href="assets/css/style.css">

    <link rel="stylesheet" href="assets/css/section.css">

    <link rel="stylesheet" href="assets/css/posting.css">

    <link rel="stylesheet" href="assets/css/right_col.css">

    <link rel="stylesheet" href="assets/css/responsive.css">

    <link rel="stylesheet" href="assets/css/Comment.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <link rel="stylesheet" href="notifast/notifast.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <style>
        .style-wrapper {

            width: 90%;

            height: 100px;

            background: #F5F5F5;

            border: 1px solid #fdfdfd;

            padding: 10px;

            padding-right: 0;

            display: flex;

            align-items: center;

            overflow: hidden;

            border-radius: 10px;
        }
    </style>
</head>

<body>
    <?php


    foreach ($comments as $comment) { ?>
        <div style="margin-top: 16px;">
            <span><?php echo $comment['COMMENT_ID'] ?></span>
            <br>
            <span><?php echo $comment['COMMENT'] ?></span>
            <br>

            <!-- Pass comment ID to the modal -->
            <i class="fas fa-ellipsis-v options" data-bs-toggle="modal" data-bs-target="#Comment-Modal-<?php echo $comment['COMMENT_ID']; ?>"></i>
        </div>

        <!-- Modal for each comment -->
        <div class="modal fade" id="Comment-Modal-<?php echo $comment['COMMENT_ID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Opinion Options</h5>
                    </div>
                    <div class="modal-body">

                        <!-- Edit link includes comment ID -->
                        <i class="fa-solid fa-pen-to-square" data-bs-toggle="modal" data-bs-target="#edit-comment-<?php echo $comment['COMMENT_ID']; ?>">
                            <a href="" style="color: black; text-decoration: none;">Edit Comment</a>
                        </i><br><br>

                        <!-- Delete link includes comment ID -->
                        <i class="fa-solid fa-trash">
                            <a href="delete-comment.php?comment_id=<?php echo $comment['COMMENT_ID']; ?>" style="color: black; text-decoration: none;">Delete Opinion</a>
                        </i>

                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="edit-comment-<?php echo $comment['COMMENT_ID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <!-- Edit comment form -->
                        <form method="post" action="Edit-Comment-1.php">
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Your Opinion</label>
                                <textarea class="form-control" id="message-text" maxlength="500" name="comment"><?php echo $comment['COMMENT']; ?></textarea>
                            </div>

                            <input type="hidden" name="comment_id" value="<?php echo $comment['COMMENT_ID']; ?>">

                            <!-- You may need to replace $post['content_id'] with the correct variable -->
                            <input type="hidden" name="post_id" value="<?php echo $post['content_id']; ?>">

                            <button type="submit" class="btn btn-outline-primary" name="edit-comment">Edit Your Opinion</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>


</body>

</html>