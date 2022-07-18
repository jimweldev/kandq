<?php

$baseUrl = "../../../";

include $baseUrl . "assets/includes/dbh.inc.php";

session_start();

if (isset($_POST["addProduct"])) {

	$sellersId = $_SESSION["id"];
	$name = mysqli_real_escape_string($conn, $_POST["name"]);
	$description = mysqli_real_escape_string($conn, $_POST["description"]);
	$price = mysqli_real_escape_string($conn, $_POST["price"]);
	$stocks = mysqli_real_escape_string($conn, $_POST["stocks"]);

	$sql = "INSERT INTO products (sellers_id, name, description, price, stocks) VALUES ($sellersId, '$name', '$description', $price, $stocks)";

	if (mysqli_query($conn, $sql)) {

		$productsId = mysqli_insert_id($conn);

		foreach ($_FILES["images"]['tmp_name'] as $key => $file) {

			$fileName = $_FILES['images']['name'][$key];
			$fileTmpName = $_FILES['images']['tmp_name'][$key];

	        $exp = explode(".", $fileName);

			$fileExt = strtolower(end($exp));

			$fileName = uniqid("", true) . "." . $fileExt;

			$fileDestination = $baseUrl . "assets/uploads/products/" . $fileName;

			move_uploaded_file($fileTmpName, $fileDestination);

			$sql = "INSERT INTO product_images (products_id, image) VALUES ($productsId, '$fileName')";
			mysqli_query($conn, $sql);

		}

		header("Location: " . $baseUrl . "seller/add/product?success");
		exit();

	}

	header("Location: " . $baseUrl . "seller/add/product?error=SQL error");
	exit();

}

if (isset($_POST["editProduct"])) {

	$productsId = $_POST["productsId"];
	$name = mysqli_real_escape_string($conn, $_POST["name"]);
	$description = mysqli_real_escape_string($conn, $_POST["description"]);
	$price = mysqli_real_escape_string($conn, $_POST["price"]);
	$stocks = mysqli_real_escape_string($conn, $_POST["stocks"]);

	if (empty($_FILES["images"]['tmp_name'][0])) {

		$sql = "UPDATE products SET name = '$name', description = '$description', price = $price, stocks = $stocks WHERE id = $productsId";
		mysqli_query($conn, $sql);

		header("Location: " . $baseUrl . "seller/edit/my-product?id=" . $productsId . "&success");
		exit();	

	} else {

		$sql = "DELETE FROM product_images WHERE products_id = $productsId";
		mysqli_query($conn, $sql);

		$sql = "UPDATE products SET name = '$name', description = '$description', price = $price, stocks = $stocks WHERE id = $productsId";
		mysqli_query($conn, $sql);

		foreach ($_FILES["images"]['tmp_name'] as $key => $file) {

			$fileName = $_FILES['images']['name'][$key];
			$fileTmpName = $_FILES['images']['tmp_name'][$key];

	        $exp = explode(".", $fileName);

			$fileExt = strtolower(end($exp));

			$fileName = uniqid("", true) . "." . $fileExt;

			$fileDestination = $baseUrl . "assets/uploads/products/" . $fileName;

			move_uploaded_file($fileTmpName, $fileDestination);

			$sql = "INSERT INTO product_images (products_id, image) VALUES ($productsId, '$fileName')";
			mysqli_query($conn, $sql);

		}

		header("Location: " . $baseUrl . "seller/edit/my-product?id=" . $productsId . "&success");
		exit();	

	}

	header("Location: " . $baseUrl . "seller/edit/my-product?id=" . $productsId . "&error=SQL error");
	exit();		

}

if (isset($_GET["deleteProduct"])) {

	$productsId = $_GET["id"];

	$sql = "DELETE FROM products WHERE id = $productsId";
	
	if (mysqli_query($conn, $sql)) {
		
		header("Location: " . $baseUrl . "seller/my-products?success");
		exit();

	}

	header("Location: " . $baseUrl . "seller/my-products?error=SQL error");
	exit();

}