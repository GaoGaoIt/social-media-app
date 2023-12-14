<?php



require '../init.php';
include('../config.php');
include 'function/ReusedFunction.php';

session_regenerate_id(true);

checkUserIsAdmin();

$type = isset($_GET['type']) ? $_GET['type'] : null;
$message = isset($_GET['message']) ? $_GET['message'] : null;
alertToast($type, $message);
$result = fetchEventsData();





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
							<h1 class="m-0">Student Posts Page</h1>
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
											<!-- content -->

											<section class="content">

												<div class="card">
													<div class="card-header">
														<h3 class="card-title">Events Management</h3>

													</div>
													<div class="card-body p-0">
														<table class="table table-striped projects">
															<thead>
																<tr>
																	<th style="width: 1%">
																		# ID
																	</th>
																	<th style="width: 20%;">
																		Events Caption
																	</th>
																	<th style="width: 15%;">
																		Events Image
																	</th>
																	<th style="width: 15%;">
																		student HashTag
																	<th style="width: 10%;">
																		Students Avatar
																	</th>
																	<th style="width: 10%;" class="text-center">
																		Status
																	</th>
																	<th style="width: 20%">
																	</th>
																</tr>
															</thead>
															<tbody>

																<?php
																if (mysqli_num_rows($result) == 0) {
																	echo '<span class="text-bold text-lg">No Posts found.</span>';
																} else {
																	while ($row = $result->fetch_assoc()) {
																?>
																		<tr>
																			<td>
																				<?php echo $row['content_id']; ?>
																			</td>
																			<td>
																				<a>
																					<?php echo $row['Caption']; ?> <!-- Assuming 'title' is the column name in your database -->
																				</a>
																				<br>
																				<small>
																					Created <?php echo $row['Date_upload']; ?> <!-- Assuming 'created_at' is the column name for the creation date -->
																				</small>
																			</td>
																			<td>
																				<img alt="Avatar" class="" <?php echo 'src="../assets/images/posts/' . $row['content_path_name'] . '""' ?> style="width: 120px;  height: 120px;">
																			</td>
																			<td>
																				<span class="badge badge-success text-lg" style="padding: 10px;"><?php echo $row['HashTags'] ?></span>
																			</td>
																			<td>
																				<img alt="Avatar" class="table-avatar" <?php echo 'src="../assets/images/profiles/' . fetchUserAvatar($row['user_id']) . '""' ?> style="width: 60px;  height: 60px;">
																			</td>


																			<!-- Add similar code for other columns based on your database structure -->
																			<td class="project-state">
																				<?php
																				if ($row['status'] == 'PUBLISH') {
																					echo '<span class="badge badge-success p-3">' . $row['status'] . '</span>';
																				} else {
																					echo '<span class="badge badge-danger p-3">' . $row['status'] . '</span>';
																				}
																				?>
																			</td>
																			<td class="project-actions text-right fd">
																				<?php
																				if($row['type'] == 'events'){
																					echo '<a class="btn btn-info btn-sm" href="globalAction.php?specialContent=' . $row['content_id'] . '">
																						<i class="fas fa-trash"></i> Make Special
																					</a>';
																				}
																				else{
																					echo '<a class="btn btn-warning btn-sm" href="globalAction.php?specialContent=' . $row['content_id'] . '">
																						<i class="fas fa-trash"></i> Make Normal Events
																					</a>';
																				}
																				?>

																				<a class="btn btn-info btn-sm" href="globalAction.php?EditData=<?php echo $row['content_id']; ?>">
																					<i class="fas fa-pencil-alt"></i>
																					Edit
																				</a>
																				<?php
																				
																				if ($row['is_deleted'] == 1) {
																					echo '<a class="btn btn-danger btn-sm" href="globalAction.php?delateData=' . $row['content_id'] . '">
																						<i class="fas fa-trash"></i> Retore
																					</a>';
																				} else {
																					echo '<a class="btn btn-danger btn-sm" href="globalAction.php?delateData=' . $row['content_id'] . '">
																						<i class="fas fa-trash"></i> Block
																					</a>';
																				}
																				?>
																			</td>
																		</tr>
																<?php
																	}
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