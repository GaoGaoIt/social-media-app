<?php 

session_start();

if(!isset($_SESSION['id']))
{
  header('location: login.php');

  exit;
}

?>

<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="UTF-8">

  <title>Title</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-+qdLaIRZfNu4cVPK/PxJJEy0B0f3Ugv8i482AKY7gwXwhaCroABd086ybrVKTa0q" crossorigin="anonymous">

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>

  <title>Document</title>

  <link rel="stylesheet" href="assets/css/style.css">

  <link rel="stylesheet" href="assets/css/profile-page.css">

  <link rel="stylesheet" href="assets/css/section.css">

  <link rel="stylesheet" href="assets/css/posting.css">

  <link rel="stylesheet" href="assets/css/right_col.css">

  <link rel="stylesheet" href="assets/css/responsive.css">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</head>

<body>

<!-- Nav Bar Design -->

<nav class="navbar">

  <div class="nav-wrapper">

      <img src="assets/images/black_logo.png" class="brand-img">

      <div class="nav-items">

          <i class="icon fas fa-home fa-lg"></i>

          <i class="icon fas fa-plus-square fa-lg"></i>

          <i class="icon fas fa-calendar-alt fa-lg"></i>

          <i class="icon fas fa-heart fa-lg"></i>

      </div>

  </div>

</nav>

<header class="profile-header">

  <div class="profile-container">

    <div class="profile">

      <div class="profile-image">

        <img src="<?php echo $_SESSION['img_path'] ?>" alt="profile picture">

      </div>

      <div class="profile-user-settings">

        <h1 class="profile-user-name"><?php echo $_SESSION['username']; ?></h1>

        <button class="profile-button profile-edit-button">Edit Profile</button>

        <button class="profile-button profile-settings-btn" aria-label="profile settings">

          <i class="icon fas fa-cog"></i>

        </button>

      </div>

      <div class="profile-status">

        <ul>
          <li><span class="profile-status-count"><?php echo $_SESSION['fallowers'] ?></span> Posts</li>

          <li><span class="profile-status-count"><?php echo $_SESSION['fallowing'] ?></span> Fallowing</li>

          <li><span class="profile-status-count"><?php echo $_SESSION['fallowers'] ?></span> Followers</li>

        </ul>

      </div>

      <div class="social">

        <ul>
          <li><i class="fas fa-envelope"></i><?php echo " ".$_SESSION['email'] ?></li>

          <li><i class="fab fa-facebook-square"></i><?php echo " ".$_SESSION['facebook'] ?></li>

          <li><i class="fab fa-whatsapp-square"></i><?php echo " ".$_SESSION['whatsapp'] ?></li>

        </ul>

      </div>

      <div class="profile-bio">

        <p><span class="profile-real-name"><?php echo $_SESSION['fullname']?></span> <?php echo " ".$_SESSION['bio']?> </p>

      </div>

    </div>

  </div>

</header>

<!-- design photo gallery -->

<main>

  <div class="profile-container">

    <div class="gallery">

      <div class="gallery-items">

        <img src="assets/images/posts/post_2.jpg" alt="post" class="gallery-img">

        <div class="gallery-item-info">

          <ul>

            <li class="gallery-items-likes"><span class="hide-gallery-elements">Reactions : </span>

              <i class="icon fas fa-thumbs-up"></i>

            </li>

            <li class="gallery-items-comments"><span class="hide-gallery-elements">Opinions : </span>

              <i class="icon fas fa-comment"></i>

            </li>

          </ul>

        </div>

      </div>

      <! More Testing samples -->

      <div class="gallery-items">

        <img src="assets/images/posts/post_1.jpg" alt="post" class="gallery-img">

        <div class="gallery-item-info">

          <ul>

            <li class="gallery-items-likes"><span class="hide-gallery-elements">Reactions : </span>

              <i class="icon fas fa-thumbs-up"></i>

            </li>

            <li class="gallery-items-comments"><span class="hide-gallery-elements">Opinions : </span>

              <i class="icon fas fa-comment"></i>

            </li>

          </ul>

        </div>

      </div>

      <div class="gallery-items">

        <img src="assets/images/posts/post_2.jpg" alt="post" class="gallery-img">

        <div class="gallery-item-info">

          <ul>

            <li class="gallery-items-likes"><span class="hide-gallery-elements">Reactions : </span>

              <i class="icon fas fa-thumbs-up"></i>

            </li>

            <li class="gallery-items-comments"><span class="hide-gallery-elements">Opinions : </span>

              <i class="icon fas fa-comment"></i>

            </li>

          </ul>

        </div>

      </div>

      <div class="gallery-items">

        <img src="assets/images/posts/post_1.jpg" alt="post" class="gallery-img">

        <div class="gallery-item-info">

          <ul>

            <li class="gallery-items-likes"><span class="hide-gallery-elements">Reactions : </span>

              <i class="icon fas fa-thumbs-up"></i>

            </li>

            <li class="gallery-items-comments"><span class="hide-gallery-elements">Opinions : </span>

              <i class="icon fas fa-comment"></i>

            </li>

          </ul>

        </div>

      </div>

      <div class="gallery-items">

        <img src="assets/images/posts/post_2.jpg" alt="post" class="gallery-img">

        <div class="gallery-item-info">

          <ul>

            <li class="gallery-items-likes"><span class="hide-gallery-elements">Reactions : </span>

              <i class="icon fas fa-thumbs-up"></i>

            </li>

            <li class="gallery-items-comments"><span class="hide-gallery-elements">Opinions : </span>

              <i class="icon fas fa-comment"></i>

            </li>

          </ul>

        </div>

      </div>

    </div>

  </div>

</main>

</body>

</html>