<?php

include $baseUrl . "assets/includes/dbh.inc.php";

session_start();

if (isset($_SESSION["role"])) {

    if ($_SESSION["role"] == "customer") {
			
		header("Location: " . $baseUrl . "customer");
		exit();

	} else if ($_SESSION["role"] == "seller") {

		header("Location: " . $baseUrl . "seller");
		exit();

	} else if ($_SESSION["role"] == "admin") {

		header("Location: " . $baseUrl . "admin");
		exit();

	}

}

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
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link href="<?= $baseUrl; ?>assets/css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-none">
	<div class="container-fluid">
		<a class="navbar-brand" href="<?= $baseUrl; ?>">
			<img src="<?= $baseUrl; ?>assets/img/icons/logo-1.png" height="48" class="d-inline-block align-text-top">
		</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				<li class="nav-item">
					<a class="nav-link <?= page("home", $page); ?>" aria-current="page" href="<?= $baseUrl; ?>">Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link <?= page("aboutUs", $page); ?>" href="<?= $baseUrl; ?>#about">About Us</a>
				</li>
				<li class="nav-item">
					<a class="nav-link <?= page("products", $page); ?>" href="<?= $baseUrl; ?>products">Products</a>
				</li>
			</ul>
			<div class="d-flex">
				<a class="btn btn-outline-success me-2" href="<?= $baseUrl; ?>sign-in">Sign in</a>
				<a class="btn btn-success" href="<?= $baseUrl; ?>sign-up">Sign up</a>
			</div>
		</div>
	</div>
</nav>