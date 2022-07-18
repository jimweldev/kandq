<?php

$baseUrl = "../../../";

include $baseUrl . "assets/includes/dbh.inc.php";

if (isset($_POST["searchProducts"])) {
	
	$query = mysqli_real_escape_string($conn, $_POST["query"]);

	header("Location: " . $baseUrl . "customer/?q=" . $query);
	exit();	

}

if (isset($_POST["searchCart"])) {
	
	$query = mysqli_real_escape_string($conn, $_POST["query"]);

	header("Location: " . $baseUrl . "customer/cart?q=" . $query);
	exit();	

}

if (isset($_POST["searchOrders"])) {
	
	$query = mysqli_real_escape_string($conn, $_POST["query"]);

	header("Location: " . $baseUrl . "customer/orders?q=" . $query);
	exit();	

}

if (isset($_POST["searchOrderHistory"])) {
	
	$query = mysqli_real_escape_string($conn, $_POST["query"]);

	header("Location: " . $baseUrl . "customer/order-history?q=" . $query);
	exit();	

}

if (isset($_POST["searchSellerProducts"])) {

	$sellersId = $_POST["sellersId"];
	
	$query = mysqli_real_escape_string($conn, $_POST["query"]);

	header("Location: " . $baseUrl . "customer/view/seller?id=" . $sellersId . "&q=" . $query);
	exit();	

}

http://localhost/kandq/customer/view/seller?id=2