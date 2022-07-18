<?php

$baseUrl = "../../../";

include $baseUrl . "assets/includes/dbh.inc.php";

if (isset($_POST["searchProducts"])) {
	
	$query = mysqli_real_escape_string($conn, $_POST["query"]);

	header("Location: " . $baseUrl . "seller/products?q=" . $query);
	exit();	

}

if (isset($_POST["searchMyProducts"])) {
	
	$query = mysqli_real_escape_string($conn, $_POST["query"]);

	header("Location: " . $baseUrl . "seller/my-products?q=" . $query);
	exit();	

}

if (isset($_POST["searchOrders"])) {
	
	$query = mysqli_real_escape_string($conn, $_POST["query"]);

	header("Location: " . $baseUrl . "seller/orders?q=" . $query);
	exit();	

}