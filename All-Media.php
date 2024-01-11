<?php

include 'Media-Provider.php';

if (!isset($_SESSION['id'])) {
    header('location: login.php');

    exit;
}

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <title>College Community</title>

    <meta charset="utf-8">

    <link rel="icon" href="assets/images/event_accepted_50px.png" type="image/icon type">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-+qdLaIRZfNu4cVPK/PxJJEy0B0f3Ugv8i482AKY7gwXwhaCroABd086ybrVKTa0q" crossorigin="anonymous">

    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" /> -->

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />

    <link rel="stylesheet" href="assets/css/style.css">

    <link rel="stylesheet" href="assets/css/profile-page.css">

    <!-- <link rel="stylesheet" href="assets/css/section.css"> -->

    <link rel="stylesheet" href="assets/css/posting.css">

    <link rel="stylesheet" href="assets/css/right_col.css">

    <link rel="stylesheet" href="assets/css/responsive.css">

    <link rel="stylesheet" href="assets/css/discover.css">

    <link rel="stylesheet" href="assets/css/results.css">

    <style>
        .post-source {

            width: 100%;

            height: 500px;

            object-fit: cover;

            border-radius: 10px;

        }

        .title {
            padding-left: 10px;
        }

        .gallery-items-likes {
            color: lightskyblue;
        }

        .dicovery-container {
            margin: 24px;
            background-color: lightgrey;
            padding: 20px;
            border-radius: 16px;
            height: 100vh;
        }

        .gallery-items {
            height: auto;
            width: 100px;
        }
    </style>

</head>

<body>
    <?php
    require 'component/noSearchHeader.php'
    ?>

    <?php

    include('config.php');

    $id = $_SESSION['id'];

    // Fetch posts
    $postSQL = "SELECT * FROM pivot_content_data WHERE type = 'posts' AND user_id = ?;";
    $stmtPost = $conn->prepare($postSQL);
    $stmtPost->bind_param("i", $id);
    $stmtPost->execute();
    $posts = $stmtPost->get_result();
    
    // Fetch events
    $eventSQL = "SELECT * FROM pivot_content_data WHERE type = 'events' AND user_id = ?;";
    $stmtEvent = $conn->prepare($eventSQL);
    $stmtEvent->bind_param("i", $id);
    $stmtEvent->execute();
    $events = $stmtEvent->get_result();
    
    // Fetch videos
    $videoSQL = "SELECT * FROM pivot_content_data WHERE type = 'videos' AND user_id = ?;";
    $stmtVideo = $conn->prepare($videoSQL);
    $stmtVideo->bind_param("i", $id);
    $stmtVideo->execute();
    $shorts = $stmtVideo->get_result();

    ?>

    </nav>
    <br><br><br>

    <h3 class="title">All Posts<small></small></h3><br>


    <ul class="nav nav-pills">

        <li class="active"><a data-toggle="pill" href="#home"><i class="icon fas fa-vote-yea fa-lg"></i>Posts</a></li>

        <li><a data-toggle="pill" href="#menu3"><i class="icon fas fa-video fa-lg"></i>Videos</a></li>

        <li><a data-toggle="pill" href="#menu-4"><i class="icon fas fa-calendar-check fa-lg"></i>Events</a></li>

    </ul>

    <div class="tab-content">

        <div id="home" class="tab-pane fade in active">

            <main>

                <div class="dicovery-container">

                    <div class="gallery">

                        <?php foreach ($posts as $post) { ?>
                            <div class="gallery-items">

                                <img src="<?php echo "assets/images/posts/" . $post['content_path_name']; ?>" alt="post" class="gallery-img">

                                <div class="gallery-item-info">

                                    <ul>

                                        <li class="gallery-items-likes"><span class="hide-gallery-elements"><?php echo $post['Likes']; ?></span>

                                            <i class="icon fas fa-thumbs-up"></i>

                                        </li>

                                        <li class="gallery-items-likes"><span class="hide-gallery-elements">Opinions</span>

                                            <a href="single-post.php?post_id=<?php echo $post['content_id']; ?>" style="color: lightskyblue"><i class="icon fas fa-comment"></i></a>

                                        </li>
                                    </ul>

                                </div>

                            </div>

                        <?php } ?>

                    </div>

                </div>

            </main>

        </div>

        <div id="menu-4" class="tab-pane fade">

            <br>
            <ul class="list-group">

                <?php

                // $events = find_Events();

                foreach ($events as $event) { ?>

                    <div class="result-section">

                        <li class="list-group-item search-result-item">

                            <img src="assets/images/calender.jpg" alt="profile-image">

                            <div class="profile_card" style="margin-left: 20px;">

                                <div>
                                    <p class="username" style="text-transform: capitalize; font-weight: bold;"><?php echo $event['Caption']; ?></p>

                                    <p class="sub-text"><?php echo "Post Uploaded : " . $event['Date_upload']; ?></p>
                                </div>

                            </div>

                            <div class="search-result-item-button">

                                <button style="background: white none" class="btn btn-outline-primary">
                                    <a style="font-weight: bold; text-decoration: none;" href="Single-Event.php?post_id=<?php echo $event['content_id']; ?>">

                                        View Event</a></button>
                            </div>

                        </li>
                        <br>

                    </div>
                <?php } ?>

            </ul>
        </div>

        <div id="menu3" class="tab-pane fade">

            <br>

            <ul class="list-group">

                <?php

                // $shorts = find_Shorts();

                foreach ($shorts

                    as $video) {
                ?>

                    <div class="result-section">

                        <li class="list-group-item search-result-item">

                            <img src="assets/images/video.png" alt="profile-image">

                            <div class="profile_card" style="margin-left: 20px;">

                                <div>
                                    <p class="username" <?php $vid_data = "Single-Video.php?post_id= " . $video['content_id']; ?> <?php $new_string =  mb_strimwidth($video['Caption'], 0, 200, "....<br><a href='$vid_data'> Read More</a>"); ?> style="text-transform: capitalize; font-weight: bold; font-size: 13px;"><?php echo $new_string ?></p>

                                </div>

                            </div>

                            <div class="search-result-item-button">

                                <button style="background: white none" class="btn btn-outline-primary">
                                    <a style="text-decoration: none; font-weight: bold;" href="Single-Video.php?post_id=<?php echo $video['content_id']; ?>">
                                        View Video
                                    </a>
                                </button>
                            </div>

                        </li>
                        <br>

                    </div>

                <?php } ?>
            </ul>
        </div>
    </div>
</div>


</body>

<script type="text/javascript">
    document.getElementById("logo-img").onclick = function() {
        location.href = "home.php";
    };
</script>

</html>