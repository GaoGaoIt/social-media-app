<?php



require '../init.php';
include('../config.php');
include 'function/ReusedFunction.php';

session_regenerate_id(true);

checkUserIsAdmin();


// alertToast($type, $message);
$result = fetchPostsData();





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

  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index.php" class="brand-link">
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
              <h1 class="m-0">Posts</h1>
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
          <!-- <section class="content">
            <div class="container-fluid">
              <h2 class="text-center display-4">Search</h2>
              <div class="row">
                <div class="col-md-8 offset-md-2">
                  <form action="" id="searchForm" >
                    <div class="input-group">
                      <input type="search" class="form-control form-control-lg" placeholder="Search Author Name">
                      <div class="input-group-append">
                        <button type="submit" class="btn btn-lg btn-default">
                          <i class="fa fa-search"></i>
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </section> -->

          <section class="content mt-4">
            <div class="container-fluid">

              <div class="row">
                <div class="col-lg-12">
                  <div class="">
                    <div class="p-4">

                      <!-- <div class="row row-cols-2 row-cols-lg-4"> -->


                      <?php
                      if (mysqli_num_rows($result) == 0) {
                        echo '<span class="text-bold text-lg">No Posts found.</span>';
                      }
                      if ($result) {
                        echo '<div class="row">'; // Bootstrap row

                        while ($row = mysqli_fetch_assoc($result)) {
                          echo '<div class="col-sm-6 col-lg-4 mb-4">'; // Bootstrap column

                          echo '<div class="card">';

                          switch ($row['type']) {
                            case 'posts':
                              echo '<img src="../assets/images/posts/' . $row['content_path_name'] . '" class="card-img-top img-thumbnail" alt="...">';
                              break;

                            case 'videos':
                              echo '<video preload="none" poster="../assets/videos/' . $row['thumnail_path_name'] . '" controls class="card-img-top img-thumbnail">';
                              echo '<source src="../assets/videos/' . $row['content_path_name'] . '" type="video/mp4">';
                              echo '</video>';
                              break;

                            case 'events':
                              echo '<img src="../assets/images/posts/' . $row['content_path_name'] . '" class="card-img-top img-thumbnail" alt="...">';
                              echo '<div class="p-4 event-details">';
                              echo '<p class="card-text">Event Will Be Held On: ' . $row['Event_Date'] . ' At: ' . $row['Event_Time'] . '</p>';
                              echo '<a href="' . $row['Invite_Link'] . '"><button class="btn btn-primary">Invite Link</button></a>';
                              echo '</div>';
                              break;
                          }

                          echo '<div class="card-body">';
                          echo '<h5 class="card-text">' . $row['Caption'] . '</h5>';
                          echo '<p class="card-text">Created By ' . fetchUserName($row['user_id']) . '</p>';
                          echo '<div class="p-4">';
                          if ($row['is_deleted'] == 1) {
                            echo '<a class="btn btn-success mt-auto w-100" href="globalAction.php?delateData=' . $row['content_id'] . '">
                                  <i class="fas fa-trash"></i> Restore
                              </a>';
                          } else {
                            echo '<a class="btn btn-danger mt-auto w-100" href="globalAction.php?delateData=' . $row['content_id'] . '">
                                  <i class="fas fa-trash"></i> Block
                              </a>';
                          }
                          echo '</div>';
                          echo '</div>';

                          echo '</div>';

                          echo '</div>'; // Close Bootstrap column
                        }

                        echo '</div>'; // Close Bootstrap row
                        mysqli_free_result($result);
                      } else {
                        echo "Error: " . mysqli_error($conn);
                      }
                      ?>






                      <!-- </div> -->
                    </div>
          </section>


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



</body>

</html>