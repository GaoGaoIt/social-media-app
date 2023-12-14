<?php



require '../init.php';
include('../config.php');
include 'function/ReusedFunction.php';

session_regenerate_id(true);

// checkUserIsAdmin();
$type = isset($_GET['type']) ? $_GET['type'] : null;
$message = isset($_GET['message']) ? $_GET['message'] : null;
alertToast($type, $message);


$dataId = isset($_GET['data']) ? $_GET['data'] : null;
$result = EditData($dataId);





?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">


</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">



    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="index3.html" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link">Post</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link">Event</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link">Report </a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
          <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search"></i>
          </a>
          <div class="navbar-search-block">
            <form class="form-inline">
              <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                  <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>

        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-comments"></i>
            <span class="badge badge-danger navbar-badge">3</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Brad Diesel
                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">Call me whenever you can...</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    John Pierce
                    <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">I got your message bro</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Nora Silvester
                    <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">The subject goes here</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
          </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">15</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">15 Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> 4 new messages
              <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-users mr-2"></i> 8 friend requests
              <span class="float-right text-muted text-sm">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-file mr-2"></i> 3 new reports
              <span class="float-right text-muted text-sm">2 days</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
          </div>
        </li>
        <!-- <li class="nav-item">
					<a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
						<i class="fas fa-th-large"></i>
					</a>
				</li> -->
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img src="../assets/images/profiles/synergyCollegeDefault.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-2" style="opacity: .8">
        <span class="brand-text font-weight-light">Synergy College</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="<?php echo "../assets/images/profiles/" . $_SESSION['img_path']; ?>" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block"><?php echo $_SESSION['fullname']; ?></a>
          </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <?php require 'component/sideNav.php'; ?>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">

          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Edit Page</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
              <div class="row">
                <?php
                if (mysqli_num_rows($result) == 0) {
                  echo '<span class="text-bold text-lg">No Posts found.</span>';
                } else {
                  while ($row = $result->fetch_assoc()) {
                ?>


                    <div class=" col">
                      <?php
                      if ($row['type'] == 'posts' || $row['type'] == 'events') {
                      ?>
                        <!-- post or events -->
                        <form method="post" action="globalAction.php" enctype="multipart/form-data">

                          <div class="form-group">
                            <label for="caption">What On Your Mind</label>
                            <textarea type="text" class="form-control" id="caption" rows="4" placeholder="caption here" onchange="get_caption();" name="caption" maxlength="500"></textarea>
                          </div><br>

                          <div class="form-group">
                            <label for="tag-id">Hash Tags</label>
                            <input type="text" class="form-control" id="tag-id" aria-describedby="caption-area" placeholder="Hash Tags" onchange="get_hash();" name="hash-tags">
                          </div><br>

                          <div class="form-group">
                            <label for="tag-id">Add Media (Image Files Only Accept)</label>
                            <input class="form-control" type="file" id="formFile" onchange="preview()" name="image">
                            <input type="hidden" name="dataId" value="<?php echo $dataId ?>">
                            <input type="hidden" name="type" value="<?php echo $row['type']; ?>">
                          </div>

                          <br>

                          <div class="form-group">
                            <button type="submit" class="btn btn-primary" name="updateData">Submit</button>
                            <button onclick="clearImage()" class="btn btn-primary">Clear Preview</button>
                          </div>

                        </form>

                      <?php } else { ?>
                        <!-- video -->
                        <form action="globalAction.php" method="POST" enctype="multipart/form-data">

                          <div class="form-group">
                            <label for="caption">What On Your Mind : </label>
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
                          <input type="hidden" name="dataId" value="<?php echo $dataId ?>">
                          <input type="hidden" name="type" value="<?php echo $row['type']; ?>">

                          <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="updateData" value="Publish Video">
                            <button onclick="clearImage()" class="btn btn-primary">Clear Preview</button>
                          </div>

                        </form>

                      <?php } ?>

                    </div>

                    <div class="col mb-4">
                      <!-- <?php
                            if ($row['type'] == 'events') {
                              $typeName = 'Events';
                            } elseif ($row['type'] == 'posts') {
                              $typeName = 'Post';
                            } elseif ($row['type'] == 'videos') {
                              $typeName = 'Video';
                            }elseif($row['type'] == 'special'){
                              $typeName = 'Events';
                            }
                            ?> -->

                      <h1 class="profile-user-name" style="font-size: 2rem;font-weight: 300;">Preview <?php echo $typeName ?></h1><br>

                      <div class="card p-4">

                        <div class="d-flex justify-content-between">

                          <div class="user">

                            <!-- <div class="" style=""><img src="../assets/images/temp_profile.webp"></div> -->

                            <p class="username">Preview <?php echo $typeName ?></p>

                          </div>

                          <i class="fas fa-ellipsis-v options"></i>

                        </div>
                        <?php
                        $imagePath = $row['content_path_name'] ? "../assets/images/posts/{$row['content_path_name']}" : "../assets/images/no-photo.png";

                        $videoPath  = "../assets/videos/{$row['content_path_name']}";
                        ?>
                        <?php
                        if ($row['type'] == 'videos') {
                          
                          echo '<div class="ratio ratio-4x3">';
                          echo '<iframe src="' . $videoPath . '" id="frame" title="YouTube video" allowfullscreen></iframe>';
                          echo '</div>';
                        } else {
                          // If it's not a video, display the image
                          echo '<img src="' . $imagePath . '" id="frame" class="post-img" style="max-height: 460px;">';
                        }
                        ?>
                        <div class="mt-4">
                          <p class="description" id="caption-data">

                            <span>Caption : <br></span>

                            <?php echo $row['Caption'] ?>

                          </p>

                          <p class="post-time" id="current-date"><?php echo $row['Date_upload'] ?></p>

                          <p class="post-time" id="hash-tags" style="color: #3942e7;"><i><?php echo $row['HashTags']  ?></i></p>

                        </div>

                      </div>
                    </div>



                <?php
                  }
                }
                ?>


              </div>
            </div>
          </div>
        </div>
      </section>

    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong>Copyright &copy; 2023-2024 <a href="#">Sam & Jing Yee</a>.</strong>
      All rights reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- search content author -->
  <script src="dist/js/pages/searchContent.js"></script>
  <!-- daterangepicker -->
  <script src="plugins/moment/moment.min.js"></script>
  <script src="plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.js"></script>
  <!-- AdminLTE for demo purposes -->

  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="dist/js/pages/dashboard.js"></script>

  <script src="../assets/js/preview-helper.js"> </script>



</body>

</html>