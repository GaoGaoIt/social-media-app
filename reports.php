<?php

require 'init.php';

session_regenerate_id(true);

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

    <!-- <link rel="stylesheet" href="assets/css/Comment.css"> -->

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


    <?php if (isset($_GET['error_message'])) { ?>

        <?php

        $message = $_GET['error_message'];

        echo "<body onload='notification_function(`Error Message`, `$message`, `#da1857`);'</body>"

        ?>

    <?php } ?>

    <?php if (isset($_GET['success_message'])) { ?>

        <?php

        $message = $_GET['success_message'];

        echo "<body onload='notification_function(`Success Message`, `$message`, `#0F73FA`);'</body>"

        ?>

    <?php } ?>


    <!-- Nav Bar Design -->
    <?php
    require 'component/createPageHeader.php';
    ?>

    <!-- New Section -->

    <?php

    include('config.php');

    if (isset($_GET['contentId'])) {

        $post_identification = $_GET['contentId'];

        $stmt = $conn->prepare("SELECT * FROM pivot_content_data WHERE content_id = $post_identification;");

        $stmt->execute();

        $post_array = $stmt->get_result();
    } else {
        header('location: home.php');

        exit;
    }

    if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
        $page_no = $_GET['page_no'];
    } else {
        $page_no = 1;
    }

    // $sql = "SELECT COUNT(*) as total_comments FROM comments WHERE POST_ID = $post_identification";

    // $stmt = $conn->prepare($sql);

    // $stmt->execute();

    // $total_comments = 0;

    // $stmt->bind_result($total_comments);

    // $stmt->store_result();

    // $stmt->fetch();

    // $total_comments_per_page = 20;

    // $offest = ($page_no - 1) * $total_comments_per_page;

    // that php ceil function return rounded numbers

    // $total_number_pages = ceil($total_comments / $total_comments_per_page);

    // $stmt = $conn->prepare("SELECT * FROM comments WHERE POST_ID = $post_identification ORDER BY COMMENT_ID DESC LIMIT $offest, $total_comments_per_page;");

    // $stmt->execute();

    // $comments = $stmt->get_result();
    ?>

    <section class="main">

        <div class="wrapper">
            <!-- Design for left column -->

            <div class="left-col">

                <!-- Wrapper for single posting -->

                <?php
                include('get_dataById.php');

                foreach ($post_array as $post) {
                    $data = get_UserData($post['user_id']);

                    $profile_img = $data[2];

                    $profile_name = $data[0]; ?>

                    <div class="post" id="post-id">

                        <div class="info">

                            <div class="user">

                                <div class="profile-pic"><img src="<?php echo "assets/images/profiles/" . $profile_img; ?>"></div>

                                <p class="username"><?php echo $profile_name; ?></p>

                            </div>

                            <?php

                            $id = $_SESSION['id'];

                            if ($post['user_id'] == $id) { ?>

                                <i class="fas fa-ellipsis-v options" data-bs-toggle="modal" data-bs-target="#exampleModal"></i>

                            <?php } ?>

                        </div>

                        <img src="<?php echo "assets/images/posts/" . $post['content_path_name']; ?>" class="post-img">

                        <div id="data-contents">

                            <div class="post-content" id="post-content">

                                <div class="reactions-wrapper" id="reaction-wrapper">

                                    <?php include('check_like_status.php'); ?>

                                    <?php if ($reaction_status) { ?>

                                        <form>
                                            <input type="hidden" value="<?php echo $post['Post_ID']; ?>" name="post_ids" id="post_ids">
                                            <button style="background: none; border: none;" type="submit" name="reaction">
                                                <i style="color: #fb3958;" class="icon fas fa-heart" onclick="return unlike();" id="unlike"></i>
                                            </button>
                                        </form>

                                    <?php } else { ?>

                                        <form>
                                            <input type="hidden" value="<?php echo $post['content_id']; ?>" name="post_id" id="post_id">
                                            <input type="hidden" value="<?php echo $post['type']; ?>" name="type" id="type">
                                            <button style="background: none; border: none;" type="submit" name="reaction">
                                                <i style="color: #22262A;" class="icon fas fa-heart" onclick="return like();" id="like"></i>
                                            </button>
                                        </form>

                                    <?php } ?>

                                </div>

                                <input type="hidden" value="<?php echo $post['Likes']; ?>" id="reaction-counter">

                                <p class="reactions" id="reaction-id"><?php echo $post['Likes']; ?> Reactions</p>

                                <p class="description">

                                    <span><?php echo $profile_name; ?> Says :<br></span>

                                    <?php echo $post['Caption']; ?>
                                </p>

                                <p class="post-time"><?php echo date("M,Y,d", strtotime($post['Date_upload'])); ?></p>

                                <p class="post-time" style="color: #0b5ed7"><?php echo $post['HashTags']; ?></p>

                            </div>

                        </div>

                    </div>

                <?php } ?>

                <div class="col-md-12 col-lg-10 col-xl-8 mt-2 mb-2" style="width: 100%; ">

                    <div class="card" style="border-radius: 10px; background: #F5F5F5; border-color: white;">

                        <div class="card-body">

                            <div class="d-flex flex-start align-items-center">

                                <div class="comments-section">

                                    <img src="<?php echo 'assets/images/profiles/' . $_SESSION['img_path'] ?>" class="icon" style="width: 45px; height: 45px;">

                                    <form class="comments-section" id="comments-section">

                                        <input type="text" class="comment-box" placeholder="Your Opinion" name="comment" id="comment">

                                        <input type="hidden" name="post_id" value="<?php echo $post['content_id'] ?>" id="post_identity">
                                        <input type="hidden" name="type" value="<?php echo $post['type'] ?>" id="type">

                                        <button class="comment-button" type="button" name="submit" onclick="return report()"><i class="fa-regular fa-paper-plane fa-lg"></i></button>

                                    </form>

                                </div>

                            </div>

                        </div>

                    </div><br>
                </div>
            </div>
            <!-- Design for right column -->

            <div class="right-col">

                <!-- structure for profile card section-->

                <div class="style-wrapper mt-2" style="background: #F5F5F5;">

                    <div class="suggestion_card">

                        <div>
                            <img src="<?php echo "assets/images/profiles/" . $_SESSION['img_path']; ?>" style="border-radius: 50%; width: 60px; height: 60px; vertical-align: middle; float: left; margin-top: 6px;">
                        </div>

                        <div>
                            <p class="username" style="margin-left: 8px;"><?php echo $_SESSION['username']; ?></p>

                            <p class="sub-text" style="margin-left: 19px;"><?php echo $_SESSION['fullname']; ?></p>

                        </div>

                        <a href="logout.php"><button class="fallow-btn" style="margin-left: 30px; font-size: small">LOG OUT</button></a>

                    </div>

                </div>
            </div>


        </div>
    </section>

</body>

<script src="notifast/notifast.min.js"></script>

<script src="notifast/function.js"></script>

<script type="text/javascript">
    function like() {

        const post_id = document.getElementById('post_id').value;

        $.ajax({
            type: "post",
            url: "like.php",
            data: {
                'post_id': post_id,
            },
            cache: false,
            success: function(html) {
                $("#data-contents").load(window.location.href + " #data-contents");
            }
        });
        return false;
    }

    function unlike() {

        const post_ids = document.getElementById('post_ids').value;

        $.ajax({
            type: "post",
            url: "unlike.php",
            data: {
                'post_id': post_ids,
            },
            cache: false,
            success: function(html) {
                $("#data-contents").load(window.location.href + " #data-contents");
            }
        });
        return false;
    }

    function report() {

        const post_id = document.getElementById('post_identity').value;

        const comment = document.getElementById('comment').value;
        const type = document.getElementById('type').value;

        console.log(post_id);

        $.ajax({
            type: "post",
            url: "reports_action.php",
            data: {
                'post_id': post_id,
                'comment': comment,
                'type': type
            },
            cache: false,
            success: function(html) {
                $("#here").load(window.location.href + " #here");

                clearInput();

                notification_function("Success Message", "Your Opinion Successfully Shared With Community", "#0F73FA");

                setInterval(function() {
                    window.location.href = 'home.php';
                }, 500);
            }
        });

        return false;
    }

    function clearInput() {
        const getValue = document.getElementById("comment");

        if (getValue.value != "") {
            getValue.value = "";
        }
    }

    $(document).bind("contextmenu", function(e) {
        return false;
    });
</script>

<script>
    $(document).ready(function() {
        setInterval(function() {
            $("#here").load(window.location.href + " #here");
        }, 10000);
    });
</script>


<script type="text/javascript">
    document.getElementById("logo-img").onclick = function() {
        location.href = "home.php";
    };
</script>

</html>