<?php

session_start();

$function_out = strcmp($_SESSION['usertype'], '1');

if (!isset($_SESSION['id'])) {
  header('location: login.php');

  exit;
} else {
  if ($function_out == 0) {
    header("location: home.php");
  }
}
?>

<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="UTF-8">

  <title>EventsWave</title>

  <link rel="icon" href="assets/images/event_accepted_50px.png" type="image/icon type">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-+qdLaIRZfNu4cVPK/PxJJEy0B0f3Ugv8i482AKY7gwXwhaCroABd086ybrVKTa0q" crossorigin="anonymous">

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />

  <link rel="stylesheet" href="assets/css/style.css">

  <link rel="stylesheet" href="assets/css/section.css">

  <link rel="stylesheet" href="assets/css/posting.css">

  <link rel="stylesheet" href="assets/css/right_col.css">

  <link rel="stylesheet" href="assets/css/responsive.css">

  <link rel="stylesheet" href="assets/css/camara-upload.css">

  <link rel="stylesheet" href="assets/css/links.css">

  <link rel="stylesheet" href="notifast/notifast.min.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>

  <?php
  require 'component/createPageHeader.php'
  ?>

  <br><br><br>

  <!-- Using Bootstrap Grid System -->

  <div class="container">

    <div class="row">

      <div class="col">

        <div class="mb-5">

          <form action="video_uploader.php" method="POST" enctype="multipart/form-data">

            <div class="form-group">

              <h1 class="profile-user-name" style="font-size: 2rem;font-weight: 300;">Publish Your Short Video</h1>

            </div><br>

            <div class="form-group">

              <label for="caption">What On Your Mind : </label>

              <!--<input type="text" class="form-control" id="caption" aria-describedby="caption-area" placeholder="caption here" onchange="get_caption();" name="caption">-->

              <textarea type="text" class="form-control mt-2" id="caption" rows="4" placeholder="caption here" onchange="get_caption();" name="caption" maxlength="500"></textarea>

            </div><br>

            <div class="form-group">

              <label for="tag-id">Hash Tags : </label>

              <input type="text" class="form-control mt-2" id="tag-id" aria-describedby="caption-area" placeholder="Hash Tags" onchange="get_hash();" name="hash-tags" maxlength="50">

            </div><br>

            <div class="form-group" id="vid-group">

              <label for="tag-id">Add video : </label>

              <input id="max_id" type="hidden" name="MAX_FILE_SIZE" value="20971520" />

              <input class="form-control mt-2" type="file" id="file" name="file" onchange="upload_check()" accept="video/*">

            </div><br>

            <div class="form-group">

              <label for="tag-id">Add video Thumbnail : </label>

              <input class="form-control mt-2" type="file" id="file_thumb" name="thumbnail" accept="image/png, image/gif, image/jpeg">

            </div>
            <br>

            <div class="form-group">

              <input type="submit" class="btn btn-primary" name="posting" value="Publish Video">

              <button onclick="clearImage()" class="btn btn-primary">Clear Preview</button>

            </div>

          </form>

        </div>

      </div>

      <div class="col d-none d-lg-block">

        <h1 class="profile-user-name" style="font-size: 2rem;font-weight: 300;">Preview Post</h1><br>


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

        <div class="post">

          <div class="info">

            <div class="user">

              <div class="profile-pic"><img src="assets/images/temp_profile.webp"></div>

              <p class="username">Preview Post</p>

            </div>

            <i class="fas fa-ellipsis-v options"></i>

          </div>

          <div class="ratio ratio-4x3">

            <iframe src="" id="frame" title="YouTube video" allowfullscreen></iframe>

          </div>

          <div class="post-content">

            <div class="reactions-wrapper">

              <i class="icon fas fa-thumbs-up"></i>

              <i class="icon fas fa-comment"></i>

            </div>

            <p class="description" id="caption-data">

              <span>Caption : <br></span>

              Description is a spoken or written account of a person, object, or event. It can also mean a type or class of people or things. Discription is not a word.

            </p>

            <p class="post-time" id="current-date">2022/11/5</p>

            <p class="post-time" id="hash-tags" style="color: #3942e7;"><i>#hashtag #hashtags</i></p>

          </div>

        </div>

      </div>

    </div>

  </div>

  <script src="assets/js/preview-helper.js"> </script>

  <script src="notifast/notifast.min.js"></script>

  <script src="notifast/function.js"></script>

  <script type="text/javascript">
    document.getElementById("logo-img").onclick = function() {
      location.href = "home.php";
    };

    function upload_check() {
      const upl = document.getElementById("file");

      const max = document.getElementById("max_id").value;

      if (upl.files[0].size > max) {
        alert("File too big, Your File Must Be Under 20MB");

        upl.value = "";
      } else {

        preview();
      }
    };
  </script>



</body>

</html>