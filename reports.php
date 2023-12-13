<?php

require 'init.php';

session_regenerate_id(true);

?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">

    <title>College Community</title>

    <link rel="icon" href="assets/images/event_accepted_50px.png" type="image/icon type">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-+qdLaIRZfNu4cVPK/PxJJEy0B0f3Ugv8i482AKY7gwXwhaCroABd086ybrVKTa0q" crossorigin="anonymous">

    <title>Document</title>

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

    <link href="https://vjs.zencdn.net/7.20.3/video-js.css" rel="stylesheet" />

    <link href="https://unpkg.com/@videojs/themes@1/dist/sea/index.css" rel="stylesheet">

    <style>
        .post-source {

            width: 100%;

            height: px;

            object-fit: cover;

            border-radius: 10px;

        }

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

        .post-image {
            width: 100%;

            height: px;

            object-fit: cover;

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
    require 'component/createPageHeader.php'

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
        header('location: shorts.php');

        exit;
    }

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

                    <div class="post">

                        <div class="info">

                            <div class="user">

                                <div class="profile-pic"><img src="<?php echo "assets/images/profiles/" . $profile_img; ?>"></div>

                                <p class="username"><?php echo $profile_name; ?></p>

                            </div>


                        </div>
                        <?php if ($post['type'] == 'videos') { ?>
                            <video id="my-video" class="video-js vjs-theme-sea post-source" controls preload="none" data-setup="{}" poster="<?php echo 'assets/videos/' . $post['thumnail_path_name']; ?>">
                                <source src="<?php echo 'assets/videos/' . $post['content_path_name']; ?>" type="video/mp4" />
                                <p class="vjs-no-js">
                                    To view this video please enable JavaScript, and consider upgrading to a
                                    web browser that
                                    <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                                </p>
                            </video>
                        <?php } else { ?>
                            <img src="<?php echo 'assets/images/posts/' . $post['content_path_name']; ?>" alt="Image" class="post-image">
                        <?php } ?>


                        <div id="post_info">
                            <div class="post-content">

                                <div class="reactions-wrapper">

                                    <?php

                                    include('check_like_statusVid.php'); ?>

                                    <?php if ($reaction_status) { ?>

                                        <form">
                                            <input type="hidden" value="<?php echo $post['content_id']; ?>" name="post_id" id="post_ids">
                                            <button style="background: none; border: none;" type="submit" name="reaction">
                                                <i style="color: #fb3958;" class="icon fas fa-heart" onclick="return unlike();"></i>
                                            </button>
                                            </form>

                                        <?php } else { ?>

                                            <form>
                                                <input type="hidden" value="<?php echo $post['content_id']; ?>" name="post_id" id="post_id">
                                                <button style="background: none; border: none;" type="submit" name="reaction">
                                                    <i style="color: #22262A;" class="icon fas fa-heart" onclick="return like();"></i>
                                                </button>
                                            </form>

                                        <?php } ?>

                                </div>

                                <p class="reactions"><?php echo $post['Likes']; ?> Reactions</p>

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

                                    <form class="comments-section">

                                        <input type="text" class="comment-box" placeholder="Your Opinion" name="comment" id="comment">

                                        <input type="hidden" name="post_id" value="<?php echo $post['content_id'] ?>" id="post_identity">
                                        <input type="hidden" name="post_id" value="<?php echo $post['type'] ?>" id="type">

                                        <button class="comment-button" type="submit" name="submit">
                                            <i class="fa-regular fa-paper-plane fa-lg" onclick="return report();"></i>
                                        </button>

                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>
                    <br>
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

<script src="https://vjs.zencdn.net/7.20.3/video.min.js"></script>

<script src="notifast/notifast.min.js"></script>

<script src="notifast/function.js"></script>

<script type="text/javascript">
    function like() {

        const post_id = document.getElementById('post_id').value;

        $.ajax({
            type: "post",
            url: "like_vid.php",
            data: {
                'post_id': post_id,
            },
            cache: false,
            success: function(html) {
                $("#post_info").load(window.location.href + " #post_info");
            }
        });
        return false;
    }

    function unlike() {

        const post_ids = document.getElementById('post_ids').value;

        $.ajax({
            type: "post",
            url: "unlike_vid.php",
            data: {
                'post_id': post_ids,
            },
            cache: false,
            success: function(html) {
                $("#post_info").load(window.location.href + " #post_info");
            }
        });
        return false;
    }

    function report() {

        const post_id = document.getElementById('post_identity').value;

        const comment = document.getElementById('comment').value;
        const type = document.getElementById('type').value;

        console.log(comment);

        $.ajax({
            type: "post",
            url: "reports_action.php",
            data: {
                'post_id': post_id,
                'comment': comment,
                'type': type,
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
            $("#comments").load(window.location.href + " #comments");
        }, 10000);
    });
</script>

<script type="text/javascript">
    document.getElementById("logo-img").onclick = function() {
        location.href = "home.php";
    };
</script>

</html>