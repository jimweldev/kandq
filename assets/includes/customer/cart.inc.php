<?php

$baseUrl = "../../../";

include $baseUrl . "assets/includes/dbh.inc.php";

session_start();

if (isset($_GET["addToCart"])) {

	$customersId = $_SESSION["id"];
	$productsId = mysqli_real_escape_string($conn, $_GET["id"]);
	$quantity = 1;
	$status = 1;

	$sql = "SELECT * FROM carts WHERE customers_id = $customersId AND products_id = $productsId AND STATUS = 1";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {

		header("Location: " . $baseUrl . "customer/view/product?id=" . $productsId . "&info=This item is already in your cart");
		exit();

	}

	$sql = "INSERT INTO carts (customers_id, products_id, quantity, status) VALUES ($customersId, $productsId, $quantity, $status)";

	if (mysqli_query($conn, $sql)) {

		header("Location: " . $baseUrl . "customer/cart?success");
		exit();

	}

	header("Location: " . $baseUrl . "customer/cart?error=SQL error");
	exit();

}

if (isset($_POST["setQuantity"])) {
	
	$customersId = $_SESSION["id"];
	$productsId = mysqli_real_escape_string($conn, $_POST["productsId"]);
	$quantity = mysqli_real_escape_string($conn, $_POST["quantity"]);
	
	$sql = "UPDATE carts SET quantity = $quantity WHERE products_id = $productsId AND customers_id = $customersId";

	if (mysqli_query($conn, $sql)) {

		header("Location: " . $baseUrl . "customer/cart?success");
		exit();	

	}

	header("Location: " . $baseUrl . "customer/cart?error=SQL error");
	exit();	

}

if (isset($_GET["removeToCart"])) {

	$cartsId = $_GET["id"];

	$sql = "DELETE FROM carts WHERE id = $cartsId";
	mysqli_query($conn, $sql);

	header("Location: " . $baseUrl . "customer/cart?success");
	exit();	

}