<?php

include $baseUrl . "assets/includes/dbh.inc.php";

session_start();

allowedRole($baseUrl, "seller");

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
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link href="<?= $baseUrl; ?>assets/css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
<div class="wrapper">
	<nav id="sidebar" class="sidebar js-sidebar">
		<div class="sidebar-content js-simplebar">
			<a class="sidebar-brand" href="<?= $baseUrl; ?>seller">
				<span class="align-middle">K&Q Accessories</span>
			</a>

			<ul class="sidebar-nav">
				<li class="sidebar-item <?= page("dashboard", $page); ?>">
					<a class="sidebar-link" href="<?= $baseUrl; ?>seller">
						<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
					</a>
				</li>

				<li class="sidebar-item <?= page("products", $page); ?>">
					<a class="sidebar-link" href="<?= $baseUrl; ?>seller/products">
						<i class="align-middle" data-feather="codepen"></i> <span class="align-middle">Products</span>
					</a>
				</li>

				<li class="sidebar-item <?= page("myProducts", $page); ?>">
					<a class="sidebar-link" href="<?= $baseUrl; ?>seller/my-products">
						<i class="align-middle" data-feather="aperture"></i> <span class="align-middle">My Products</span>
					</a>
				</li>

				<li class="sidebar-item <?= page("orders", $page); ?>">
					<a class="sidebar-link" href="<?= $baseUrl; ?>seller/orders">
						<i class="align-middle" data-feather="shopping-bag"></i> <span class="align-middle">Orders</span>
					</a>
				</li>

				<li class="sidebar-item <?= page("orderHistory", $page); ?>">
					<a class="sidebar-link" href="<?= $baseUrl; ?>seller/order-history">
						<i class="align-middle" data-feather="arrow-left-circle"></i> <span class="align-middle">Order History</span>
					</a>
				</li>
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
						<a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
							<div class="position-relative">
								<i class="align-middle" data-feather="bell"></i>
								
								<?php 

								$usersId = $_SESSION["id"];

								$sql = "SELECT COUNT(id) as count FROM notifications WHERE users_id = $usersId AND status = 1 ORDER BY id DESC";
								$result = mysqli_query($conn, $sql);

								if (mysqli_num_rows($result) > 0) {

									while ($row = mysqli_fetch_assoc($result)) {
										if ($row["count"] != 0) {
											echo "<span class='indicator'>";
												echo $row["count"];
											echo "</span>";
										}

									}

								}

								?>

							</div>
						</a>
						<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown">
							<div class="dropdown-menu-header">
								Notifications
							</div>
							<div class="list-group">

								<?php

								$usersId = $_SESSION["id"];

								$sql = "SELECT * FROM notifications WHERE users_id = $usersId AND status = 1 ORDER BY id DESC";
								$result = mysqli_query($conn, $sql);

								if (mysqli_num_rows($result) > 0) {

									while ($row = mysqli_fetch_assoc($result)) {

										echo "<div class='list-group-item'>";
											echo "<div class='row g-0 align-items-center'>";
												echo "<div class='col-2'>";
													echo "<i class='text-warning' data-feather='bell'></i>";
												echo "</div>";
												echo "<div class='col-10'>";
													echo "<div class='text-dark'>" . $row["title"] . "</div>";
													echo "<div class='text-muted small mt-1'>" . $row["description"] . "</div>";
												echo "</div>";
											echo "</div>";
										echo "</div>";

									}

								}

								?>
								
							</div>
							<div class="dropdown-menu-footer">
								<a href="<?= $baseUrl ?>seller/notifications" class="text-muted">Show all notifications</a>
							</div>
						</div>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-icon dropdown-toggle" href="#" id="messagesDropdown" data-bs-toggle="dropdown">
							<div class="position-relative">
								<i class="align-middle" data-feather="message-square"></i>
							</div>
						</a>
						<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="messagesDropdown">
							<div class="dropdown-menu-header">
								<div class="position-relative">
									Messages
								</div>
							</div>
							<div class="list-group">
								
								<?php

								$sql = "SELECT a.* FROM messages a INNER JOIN (SELECT id, user_role, message, created_at, MAX(id) AS maxid FROM messages GROUP BY customers_id) as b ON a.id = b.maxid ORDER BY a.id DESC";
								$result = mysqli_query($conn, $sql);

								if (mysqli_num_rows($result) > 0) {

									while ($row = mysqli_fetch_assoc($result)) {

										$usersId = $row["customers_id"];

										$sql2 = "SELECT * FROM users WHERE id = $usersId";
										$result2 = mysqli_query($conn, $sql2);

										while ($row2 = mysqli_fetch_assoc($result2)) {

											echo "<a href='" . $baseUrl . "seller/chat?id=" . $usersId . "' class='list-group-item'>";
												echo "<div class='row g-0 align-items-center'>";
													echo "<div class='col-2'>";
														echo "<img src='" . $baseUrl . "assets/uploads/profiles/" . $row2["profile"] . "' class='avatar img-fluid rounded-circle'>";
													echo "</div>";
													echo "<div class='col-10 ps-2'>";
														echo "<div class='text-dark'>" . $row2["firstname"] . " " . $row2["lastname"] . "</div>";
														echo "<div class='text-muted small mt-1'>" . $row["message"] . "</div>";
														echo "<div class='text-muted small mt-1'>" . date('M d | g:i A', strtotime($row["created_at"])) . "</div>";
													echo "</div>";
												echo "</div>";
											echo "</a>	";

										}

									}

								}

								?>

							</div>
						</div>
					</li>
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
							<a class="dropdown-item" href="<?= $baseUrl; ?>seller/profile"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
							<a class="dropdown-item" href="<?= $baseUrl; ?>assets/includes/sessions.inc.php?signOut"><i class="align-middle me-1" data-feather="log-out"></i> Log out</a>
						</div>
					</li>
				</ul>
			</div>
		</nav>

		<main class="content">
			<div class="container-fluid p-0">