<?php



require '../init.php';
include('../config.php');
include 'function/ReusedFunction.php';

session_regenerate_id(true);

checkUserIsAdmin();

$type = isset($_GET['type']) ? $_GET['type'] : null;
$message = isset($_GET['message']) ? $_GET['message'] : null;
alertToast($type, $message);







$result = [];

if (isset($_POST['searchData']) && isset($_POST['search']) && !empty($_POST['searchData'])) {
    $result = findStudentUsers($_POST['searchData']);
} else {
    $result = fetchAllStudent();
}

if (empty($_POST['searchData'])) {
    $result = fetchAllStudent();
}









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
                            <h1 class="m-0">Students</h1>
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
                    <section class="content mt-4">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="">
                                        <div class="p-4">
                                            <!-- content -->

                                            <section class="content">

                                                <div class="mb-4">
                                                    <form action="students.php" method="post" class="d-flex">
                                                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search" name="searchData">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-sidebar" name="search">
                                                                <i class="fas fa-search fa-fw"></i>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Students List</h3>

                                                    </div>

                                                    <div class="card-body p-0">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th style="width: 1%">
                                                                        # ID
                                                                    </th>
                                                                    <th style="width: 20%;">
                                                                        Name
                                                                    </th>
                                                                    <th style="width: 15%;">
                                                                        Gender
                                                                    </th>
                                                                    <th style="width: 15%;">
                                                                        Student ID
                                                                    <th style="width: 10%;">
                                                                        Lecturer
                                                                    </th>
                                                                    <th style="width: 10%;" class="text-center">
                                                                        Course
                                                                    </th>
                                                                    <th style="width: 20%">
                                                                        Intake DATE
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                <?php
                                                                // if (mysqli_num_rows($result) == 0) {
                                                                //     echo '<span class="text-bold text-lg pl-4">No Reports found.</span>';
                                                                // } else {
                                                                //     while ($row = $result->fetch_assoc()) {

                                                                foreach ($result as $row) {
                                                                ?>
                                                                    <tr>
                                                                        <td>
                                                                            <?php echo $row['id']; ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php echo $row['name']; ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php echo $row['gender']; ?>

                                                                        </td>
                                                                        <td>
                                                                            <?php echo $row['studentsID']; ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php echo $row['teacherID']; ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php echo $row['course']; ?>
                                                                        </td>

                                                                        <td class="project-state">
                                                                            <?php echo $row['intake_Date']; ?>
                                                                        </td>
                                                                        <td class="project-actions text-right fd">
                                                                            <a href="studentEdit.php?stuID=<?php echo $row['id']; ?>"><button class="btn btn-success"> Edit</button></a>
                                                                        </td>
                                                                    </tr>
                                                                <?php
                                                                }

                                                                ?>

                                                            </tbody>
                                                        </table>
                                                    </div>

                                                </div>

                                            </section>

                                        </div>
                                    </div>
                                </div>
                            </div>
                    </section>


                </div>
            </section>

        </div>
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