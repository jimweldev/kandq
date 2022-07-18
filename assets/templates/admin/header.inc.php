<?php

include $baseUrl . "assets/includes/dbh.inc.php";

session_start();

allowedRole($baseUrl, "admin");

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="<?= $baseUrl; ?>assets/img/icons/logo.png" />
	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-blank.html" />
	<title>K&Q DIY Accessories</title>
	<!-- DATA TABLES -->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link href="<?= $baseUrl; ?>assets/css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
<div class="wrapper">
	<nav id="sidebar" class="sidebar js-sidebar">
		<div class="sidebar-content js-simplebar">
			<a class="sidebar-brand" href="<?= $baseUrl ?>admin">
				<span class="align-middle">K&Q Accessories</span>
			</a>

			<ul class="sidebar-nav">
				<li class="sidebar-item <?= page("dashboard", $page); ?>">
					<a class="sidebar-link" href="<?= $baseUrl ?>admin">
						<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
					</a>
				</li>

				<li class="sidebar-item <?= page("users", $page); ?>">
					<a class="sidebar-link" href="<?= $baseUrl ?>admin/users">
						<i class="align-middle" data-feather="users"></i> <span class="align-middle">Users</span>
					</a>
				</li>

				<li class="sidebar-item <?= page("products", $page); ?>">
					<a class="sidebar-link" href="<?= $baseUrl ?>admin/products">
						<i class="align-middle" data-feather="tag"></i> <span class="align-middle">Products</span>
					</a>
				</li>

				<!-- <li class="sidebar-item">
					<a class="sidebar-link" href="<?= $baseUrl ?>admin/verification">
						<i class="align-middle" data-feather="book"></i> <span class="align-middle">Seller Verification</span>
					</a>
				</li> -->
			</ul>
		</div>
	</nav>

	<div class="main">
		<nav class="navbar navbar-expand navbar-light navbar-bg">
			<a class="sidebar-toggle js-sidebar-toggle">
				<i class="hamburger align-self-center"></i>
			</a>

			<div class="navbar-collapse collapse">
				<ul class="navbar-nav navbar-align">
					<li class="nav-item dropdown">
						<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
							<i class="align-middle" data-feather="settings"></i>
						</a>

						<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
							
							<?php

							$usersId = $_SESSION["id"];

							$sql = "SELECT * FROM users WHERE id = $usersId";
							$result = mysqli_query($conn, $sql);

							if (mysqli_num_rows($result) > 0) {

								while ($row = mysqli_fetch_assoc($result)) {

									echo "<img src='" . $baseUrl . "assets/uploads/profiles/" . $row["profile"] . "' class='avatar img-fluid rounded me-1' alt='" . $row["firstname"] . "' /> <span class='text-dark'>" . $row["firstname"] . "</span>";

								}

							}

							?>
							
						</a>
						<div class="dropdown-menu dropdown-menu-end">
							<a class="dropdown-item" href="<?= $baseUrl; ?>admin/profile"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
							<a class="dropdown-item" href="<?= $baseUrl; ?>assets/includes/sessions.inc.php?signOut"><i class="align-middle me-1" data-feather="log-out"></i> Log out</a>
						</div>
					</li>
				</ul>
			</div>
		</nav>

		<main class="content">
			<div class="container-fluid p-0">