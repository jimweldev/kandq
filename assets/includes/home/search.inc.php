<?php

$baseUrl = "../../../";

include $baseUrl . "assets/includes/dbh.inc.php";

if (isset($_POST["searchProducts"])) {
	
	$query = mysqli_real_escape_string($conn, $_POST["query"]);

	header("Location: " . $baseUrl . "products?q=" . $query);
	exit();	

}