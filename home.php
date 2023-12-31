<?php

require 'init.php';

session_regenerate_id(true);

if (!isset($_SESSION['id'])) {
    header('location: login.php');

    exit;
}
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">

    <title>College Community</title>

    <link rel="icon" href="assets/images/event_accepted_50px.png" type="image/icon type">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-+qdLaIRZfNu4cVPK/PxJJEy0B0f3Ugv8i482AKY7gwXwhaCroABd086ybrVKTa0q" crossorigin="anonymous">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />

    <link rel="stylesheet" href="assets/css/style.css">

    <link rel="stylesheet" href="assets/css/section.css">

    <link rel="stylesheet" href="assets/css/posting.css">

    <link rel="stylesheet" href="assets/css/responsive.css">

    <link rel="stylesheet" href="assets/css/right_col.css">

    <link rel="stylesheet" href="assets/css/profile-page.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <style>
        .style-wrapper {

            width: 90%;

            height: 70px;

            background: #F5F5F5;

            border: 1px solid #fdfdfd;

            padding: 10px;

            padding-right: 0;

            display: flex;

            align-items: center;

            overflow: hidden;

            border-radius: 10px;
        }


        .profile-pics {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            overflow: hidden;
            padding: 3px;
            background: linear-gradient(45deg, rgb(255, 230, 0), rgb(255, 0, 128) 80%);
        }

        .profile-pics img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #fff;
            cursor: pointer;

        }


        .profile-cards {
            width: 90%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 5px;
            background: #F5F5F5;
            border-radius: 10px;
        }

        .profile-cards .profile-pics {
            flex: 0 0 auto;
            padding: 0;
            background: none;
            width: 50px;
            height: 50px;
            margin-right: 10px;
        }

        .profile-cards:first-child .profile-pics {
            width: 70px;
            height: 70px;
        }

        .profile-cards .profile-pics img {
            border: none;
        }

        .profile-cards .username {
            font-weight: 500;
            font-size: 14px;
            color: #000;
            font-weight: bold;

        }

        .sub-text {
            font-size: 13px;
            font-weight: 500;
            margin-top: 4px;
            color: #939393;

        }

        .action-btn {
            opacity: 2;
            font-weight: 700;
            font-size: 12px;
            color: #55B7F7;
            border: none;
            margin-left: 100px;
            text-transform: uppercase;
        }
    </style>
</head>

<body>

    <!-- Nav Bar Design -->
    <?php
    require 'component/header.php'
    ?>


    <section class="main">

        <div class="wrapper">

            <!-- Design for left column -->

            <div class="left-col" id="left-col">

                <!-- Wrapper For Status -->

                <?php include('Clubs.php'); ?>

                <!-- Wrapper for posting -->

                <?php include('get_latest_posts.php'); ?>

                <?php

                include('get_dataById.php');

                foreach ($posts as $post) {
                    $data = get_UserData($post['user_id']);

                    $profile_img = $data[2];

                    $profile_name = $data[0];

                ?>

                    <?php
                    switch ($post['type']) {
                        case 'posts':
                            echo '<div class="card mt-4 rounded border">';
                            echo '<img src="assets/images/posts/' . $post['content_path_name'] . '" class="post-img">';
                            echo '<div id="post_info_data">';
                            echo '<div class="post-content">';
                            echo '<div class="d-flex d-flex align-items-center">';
                            include('check_like_status.php');
                            echo '<a href="reports.php?contentId=' . $post["content_id"] . '"><button class="btn btn-danger">Report</button></a>';
                            if ($reaction_status) {
                                echo '<form>';
                                echo '<input type="hidden" value="' . $post["content_id"] . '" name="post_ids" id="post_ids">';
                                echo '<button style="background: none; border: none;" type="submit" name="reaction">';
                                echo '<i style="color: #fb3958;" class="icon fas fa-heart fa-lg" onclick="return unlike(' . $post['content_id'] . ');"></i>';
                                echo '</button>';
                                echo '</form>';
                            } else {
                                echo '<form>';
                                echo '<input type="hidden" value="' . $post['content_id'] . '" name="post_id" id="post_id">';
                                echo '<button style="background: none; border: none;" type="submit" name="reaction">';
                                echo '<i style="color: #22262A;" class="icon fas fa-heart fa-lg" onclick="return like(' . $post['content_id'] . ');"></i>';
                                echo '</button>';
                                echo '</form>';
                            }
                            echo '<a href="single-post.php?post_id=' . $post["content_id"] . '" style="color: #22262A;"><i class="icon fas fa-comment fa-lg"></i></a>';
                            echo '</div>';
                            echo '<p class="reactions" id="reactions_' . $post['content_id'] . '">' . $post['Likes'] . 'Reactions</p>';
                            echo '<p class="description">';
                            echo '<span><?php echo $profile_name; ?> Says:<br></span>';
                            echo $post['Caption'];
                            echo '</p>';
                            echo '<p class="post-time">' . date("M, Y, d", strtotime($post['Date_upload'])) . '</p>';
                            echo '<p class="post-time" style="color: #0b5ed7">' . $post['HashTags'] . '</p>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            break;

                        case 'events':
                        case 'special':
                            echo '<div class="card mt-4 rounded border ">';
                            echo '<img src="assets/images/posts/' . $post['content_path_name'] . '" class="post-img">';
                            echo '<div id="post_info_data">';
                            echo '<div class="post-content">';
                            echo '<div class="d-flex align-items-center">';
                            include('check_like_status.php');
                            echo '<div class="d-flex gap-2">';
                            echo '<a href="' . $post["Invite_Link"] . '"><button class="btn btn-info">Invitation Link</button></a>';
                            echo '<a href="reports.php?contentId=' . $post["content_id"] . '"><button class="btn btn-danger">Report</button></a>';
                            echo '</div>';
                            if ($reaction_status) {
                                echo '<form>';
                                echo '<input type="hidden" value="' . $post["content_id"] . '" name="post_ids" id="post_ids">';
                                echo '<button style="background: none; border: none;" type="submit" name="reaction">';
                                echo '<i style="color: #fb3958;" class="icon fas fa-heart fa-lg" onclick="return unlike(' . $post['content_id'] . ');"></i>';
                                echo '</button>';
                                echo '</form>';
                            } else {
                                echo '<form>';
                                echo '<input type="hidden" value="' . $post['content_id'] . '" name="post_id" id="post_id">';
                                echo '<button style="background: none; border: none;" type="submit" name="reaction">';
                                echo '<i style="color: #22262A;" class="icon fas fa-heart fa-lg" onclick="return like(' . $post['content_id'] . ');"></i>';
                                echo '</button>';
                                echo '</form>';
                            }
                            echo '<a href="Single-Event.php?post_id=' . $post["content_id"] . '" style="color: #22262A;"><i class="icon fas fa-comment fa-lg"></i></a>';
                            echo '</div>';
                            echo '<p class="reactions" id="reactions_' . $post['content_id'] . '">' . $post['Likes'] . 'Reactions</p>';
                            echo '<p class="description">';
                            echo '<span><?php echo $profile_name; ?> Says:<br></span>';
                            echo $post['Caption'];
                            echo '</p>';
                            echo '<p class="post-time">' . date("M, Y, d", strtotime($post['Date_upload'])) . '</p>';
                            echo '<p class="post-time" style="color: #0b5ed7">' . $post['HashTags'] . '</p>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            break;

                        case 'videos':
                            echo '<div class="card mt-4 rounded border ">';
                            echo '<video preload="none" poster="assets/videos/' . $post['thumnail_path_name'] . '" controls class="post-source mh-30">';
                            echo '    <source src="assets/videos/' . $post['content_path_name'] . '" type="video/mp4" class="">';
                            echo '</video>';

                            $element_id = rand(10, 1000000);

                            echo '<div id="' . $element_id . '">';
                            echo '    <div class="post-content">';
                            echo '        <div class="d-flex align-items-center " id="reaction">';

                            include('check_like_status.php');


                            echo '<a href="reports.php?contentId=' . $post["content_id"] . '"><button class="btn btn-danger">Report</button></a>';
                            echo '            <form class="d-flex justify-content-between">';

                            echo '                <input type="hidden" value="' . $post['content_id'] . '" name="post_id">';
                            echo '                <button style="background: none; border: none;" type="submit" name="reaction">';
                            echo '                    <i style="color: ' . ($reaction_status ? '#fb3958' : '#22262A') . ';" class="icon fas fa-heart text-lg" onclick="return ' .                               ($reaction_status ? 'unlike' : 'like') . '(' . $post['content_id'] . ');"></i>';
                            echo '                </button>';
                            echo '            </form>';
                            echo '            <a href="Single-Video.php?post_id=' . $post["content_id"] . '" style="color: #22262A;"><i class="icon fas fa-comment"></i></a>';
                            echo '        </div>';
                            echo '        <p class="reactions">' . $post['Likes'] . ' Reactions</p>';
                            echo '        <p class="description">';
                            echo '            <span>' . $profile_name . ' Says :<br></span>';
                            echo '            ' . $post['Caption'];
                            echo '        </p>';
                            echo '        <p class="post-time">' . date("M, Y, d", strtotime($post['Date_upload'])) . '</p>';
                            echo '        <p class="post-time" style="color: #0b5ed7">' . $post['HashTags'] . '</p>';
                            echo '    </div>';
                            echo '</div>';
                            echo '</div>';
                            break;
                    }
                    ?>

                <?php } ?>

                <!-- Modal For Post Options-->
                <div class="modal fade" id="post-model" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Post Options</h5>
                            </div>
                            <div class="modal-body">

                                <i class="fa-solid fa-pen-to-square" data-bs-toggle="modal" data-bs-target="#exampleModal2" data-bs-whatever="@mdo"></i><a href="" style="color: black; text-decoration: none;">Edit Post</a><br><br>

                                <i class="fa-solid fa-trash" data-bs-toggle="modal" data-bs-target="#delete_model" data-bs-whatever="@mdo"></i><a href="" style="color: black; text-decoration: none;">Delete Post</a>
                            </div>
                        </div>
                    </div>
                </div>



            </div>

            <!-- Design for right column -->

            <div class="right-col">

                <!-- structure for profile card section-->

                <div class="style-wrapper mt-2" style="background: white;">

                    <div class="suggestion_card">

                        <div>
                            <img src="<?php echo "assets/images/profiles/" . $_SESSION['img_path']; ?>" style="border-radius: 50%; width: 60px; height: 60px; vertical-align: middle; float: left; margin-top: 6px;">
                        </div>

                        <div>
                            <p class="username" style="margin-left: 11px;"><?php echo $_SESSION['username']; ?></p>

                            <p class="sub-text" style="margin-left: 19px;"><?php echo $_SESSION['fullname']; ?></p>

                        </div>

                        <a href="logout.php"><button class="fallow-btn" style="margin-left: 60px;">LOG OUT</button></a>

                    </div>

                </div>

                <!-- structure for suggestions -->

                <p class="suggesting">Recommendation For You</p>

                <?php include("get_suggestions.php"); ?>

                <?php foreach ($suggestions as $suggestion) { ?>

                    <?php if ($suggestion['User_ID'] != $_SESSION['id']) { ?>

                        <div class="profile-cards">

                            <form id="suggestion_form<?php echo $suggestion['User_ID']; ?>" method="post" action="follower_acc.php">

                                <input type="hidden" value="<?php echo $suggestion['User_ID'] ?>" name="target_id">

                                <div class="profile-pics">

                                    <img src="<?php echo "assets/images/profiles/" . $suggestion['IMAGE']; ?>" alt="profile-user" onclick="document.getElementById('suggestion_form'+<?php echo $suggestion['User_ID']; ?>).submit();">

                                </div>

                            </form>

                            <div>

                                <?php $new_string =  mb_strimwidth($suggestion['FULL_NAME'], 0, 10, ".."); ?>

                                <p class="username"><?php echo $suggestion['USER_NAME']; ?></p>

                                <p class="sub-text"><?php echo $new_string ?></p>
                            </div>

                            <form method="POST" action="fallow_user.php">

                                <input type="hidden" name="fallow_person" value='<?php echo $suggestion['User_ID']; ?>'>

                                <button type="submit" class="action-btn" name="fallow">follow</button>

                            </form>

                        </div>

                    <?php } ?>

                <?php } ?>

                <?php
                $currentDate = date('Y-m-d');

                $SQL = "SELECT * 
        FROM pivot_content_data 
        WHERE type = 'events' 
        AND status = 'PUBLISH' 
        AND Event_Date >= '$currentDate'
        ORDER BY Event_Date ASC 
        LIMIT 1;";

                $result = $conn->query($SQL);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $Event_Caption = $row["Caption"];
                        $Event_Date = $row["Event_Date"];
                        $Event_ID = $row["content_id"];
                        $Poster = $row["content_path_name"];
                ?>
                        <p class="suggesting">Upcoming Events</p>

                        <div class="card" style="width: 90%; border-radius: 10px; background: #F5F5F5; border: 1px solid #fdfdfd;">

                            <img src="<?php echo "assets/images/posts/" . $Poster; ?>" class="card-img-top" alt="Event_Card" style="border-radius: 10px;">

                            <div class="card-body">

                                <h6 class="card-title"><?php echo 'Date : ' . date("M,Y,d", strtotime($Event_Date)) ?></h6>

                                <p class="card-text"><?php echo $Event_Caption ?></p>

                                <form>
                                    <button class="fallow-btn"><a href="Single-Event.php?post_id=<?php echo $Event_ID; ?>" style="font-size: 12px;">Read More</a></button>
                                </form>
                            </div>

                        </div>
                <?php
                    }
                } else {
                    echo "<p class='suggesting'>No Upcoming Events</p>";
                }

                $conn->close();
                ?>

    </section>


    <!-- Search Modal -->
    <div class="modal fade" id="search-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form method="post" action="Results.php">
                        <input type="search" name="find" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

<script type="text/javascript">
    function like(post_id) {

        $.ajax({
            type: "post",
            url: "like.php",
            data: {
                'post_id': post_id,
            },
            cache: false,
            success: function(html) {
                $('#left-col').load(document.URL + ' #left-col');
            }
        });
        return false;
    }

    function unlike(post_id) {

        $.ajax({
            type: "post",
            url: "unlike.php",
            data: {
                'post_id': post_id,
            },
            cache: false,
            success: function(html) {
                $('#left-col').load(document.URL + ' #left-col');
            }
        });
        return false;
    }

    $(document).bind("contextmenu", function(e) {
        return false;
    });
</script>

<script type="text/javascript">
    document.getElementById("logo-img").onclick = function() {
        location.href = "home.php";
    };
</script>

</html>