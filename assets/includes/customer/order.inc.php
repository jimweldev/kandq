<?php

$baseUrl = "../../../";

include $baseUrl . "assets/includes/dbh.inc.php";

session_start();

if (isset($_POST["placeOrder"])) {

	$cartsId = mysqli_real_escape_string($conn, $_POST["cartsId"]);
	$customersId = mysqli_real_escape_string($conn, $_POST["customersId"]);
	$sellersId = mysqli_real_escape_string($conn, $_POST["sellersId"]);
	$productsId = mysqli_real_escape_string($conn, $_POST["productsId"]);
	$price = mysqli_real_escape_string($conn, $_POST["price"]);
	$quantity = mysqli_real_escape_string($conn, $_POST["quantity"]);
	$shippingFee = 0.00;
	$stocks = mysqli_real_escape_string($conn, $_POST["stocks"]);
	$totalPrice = 0.00;
	// $commission = (($totalPrice * 5) / 100);
	$commission = 0.00;
	$deliveryDate = "0000-00-00";
	$modeOfPayment = mysqli_real_escape_string($conn, $_POST["modeOfPayment"]);
	$statusDescription = "pending";
	$status = 1;	

	$sql = "INSERT INTO orders (customers_id, sellers_id, products_id, price, quantity, shipping_fee, total_price, commission, mode_of_payment, delivery_date, status_description, status) VALUES ($customersId, $sellersId, $productsId, $price, $quantity, $shippingFee, $totalPrice, $commission, '$modeOfPayment', '$deliveryDate', '$statusDescription', $status)";

	if (mysqli_query($conn, $sql)) {

		$sql = "UPDATE carts SET status = 0 WHERE id = $cartsId";

		if (mysqli_query($conn, $sql)) {

			$stocks = $stocks - $quantity;

			$sql = "UPDATE products SET stocks = $stocks WHERE id = $productsId";

			if (mysqli_query($conn, $sql)) {

				$title = "Place Order";
				$description = "A customer place an order";

				$sql = "INSERT INTO notifications (users_id, title, description, status) VALUES ($sellersId, '$title', '$description', 1)";

				if (mysqli_query($conn, $sql)) {

					header("Location: " . $baseUrl . "customer/orders?success");
					exit();

				}

			}

		}

	}

	header("Location: " . $baseUrl . "customer/cart?error=SQL error");
	exit();

}

if (isset($_GET["continue"])) {

	$ordersId = mysqli_real_escape_string($conn, $_GET["id"]);
	$modeOfPayment = mysqli_real_escape_string($conn, $_GET["modeOfPayment"]);

	if ($modeOfPayment == "Cash on Delivery") {

		$status_description = "to ship";
		
		$sql = "UPDATE orders SET status_description = '$status_description' WHERE id = $ordersId";

		if (mysqli_query($conn, $sql)) {
			
			header("Location: " . $baseUrl . "customer/orders?success");
			exit();

		}

	}

	if ($modeOfPayment == "PayMaya" || $modeOfPayment == "GCash") {

		$status_description = "to pay";
		
		$sql = "UPDATE orders SET status_description = '$status_description' WHERE id = $ordersId";

		if (mysqli_query($conn, $sql)) {
			
			header("Location: " . $baseUrl . "customer/orders?success");
			exit();

		}

	}

	header("Location: " . $baseUrl . "customer/orders?error=SQL error");
	exit();

}

if (isset($_GET["pay"])) {

	$ordersId = mysqli_real_escape_string($conn, $_GET["id"]);
	$status_description = "to ship";

	$sql = "UPDATE orders SET status_description = '$status_description' WHERE id = $ordersId";

	if (mysqli_query($conn, $sql)) {
		
		header("Location: " . $baseUrl . "customer/orders?success");
		exit();

	}

}

if (isset($_GET["received"])) {

	$ordersId = mysqli_real_escape_string($conn, $_GET["id"]);
	$status_description = "to rate";

	$sql = "UPDATE orders SET status_description = '$status_description' WHERE id = $ordersId";

	if (mysqli_query($conn, $sql)) {

		$sql2 = "SELECT * FROM orders WHERE id = $ordersId";
		$result2 = mysqli_query($conn, $sql2);

		if (mysqli_num_rows($result2) > 0) {

			while ($row2 = mysqli_fetch_assoc($result2)) {

				$sellersId = $row2["sellers_id"];
				$title = "Received Order";
				$description = "The customer received the order";

				$sql2 = "INSERT INTO notifications (users_id, title, description, status) VALUES ($sellersId, '$title', '$description', 1)";

				if (mysqli_query($conn, $sql2)) {

					header("Location: " . $baseUrl . "customer/orders?success");
					exit();

				}

			}

		}		

	}

}

if (isset($_GET["cancelOrder"])) {

	$ordersId = mysqli_real_escape_string($conn, $_GET["id"]);
	$status_description = "cancelled";

	$sql = "UPDATE orders SET status_description = '$status_description', status = 0 WHERE id = $ordersId";

	if (mysqli_query($conn, $sql)) {
		
		header("Location: " . $baseUrl . "customer/orders?success");
		exit();

	}

}