<?php

$baseUrl = "../../../";

include $baseUrl . "assets/includes/dbh.inc.php";

session_start();

if (isset($_POST["sendMessage"])) {

	$customersId = mysqli_real_escape_string($conn, $_POST["customersId"]);
	$sellersId = mysqli_real_escape_string($conn, $_POST["sellersId"]);
	$userRole = "seller";
	$message = mysqli_real_escape_string($conn, $_POST["message"]);
	$createdAt = date('Y-m-d h:i:s', time());

	$sql = "INSERT INTO messages (sellers_id, customers_id, user_role, message, created_at) VALUES ($sellersId, $customersId, '$userRole', '$message', '$createdAt')";

	if (mysqli_query($conn, $sql)) {

		header("Location: " . $baseUrl . "seller/chat?id=" . $customersId);
		exit();

	}

	header("Location: " . $baseUrl . "seller/chat?id=" . $customersId . "&error=SQL error");
	exit();

}