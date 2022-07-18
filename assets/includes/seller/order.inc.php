<?php

$baseUrl = "../../../";

include $baseUrl . "assets/includes/dbh.inc.php";

session_start();

if (isset($_POST["setShippingFee"])) {

	$ordersId = mysqli_real_escape_string($conn, $_POST["ordersId"]);
	$shippingFee = mysqli_real_escape_string($conn, $_POST["shippingFee"]);
	$statusDescription = "continued";

	$sql = "SELECT * FROM orders WHERE id = $ordersId";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {

		while ($row = mysqli_fetch_assoc($result)) {

			$customersId = $row["customers_id"];
			$price = $row["price"];
			$quantity = $row["quantity"];
			$totalPrice = ($price * $quantity) + $shippingFee;

			$sql2 = "UPDATE orders SET shipping_fee = $shippingFee, total_price = $totalPrice, status_description = '$statusDescription' WHERE id = $ordersId";

			if (mysqli_query($conn, $sql2)) {

				$title = "Set Price";
				$description = "The seller set the price";

				$sql = "INSERT INTO notifications (users_id, title, description, status) VALUES ($customersId, '$title', '$description', 1)";

				if (mysqli_query($conn, $sql)) {

					header("Location: " . $baseUrl . "seller/orders?success");
					exit();

				}

			}

		}

	}

}

if (isset($_POST["setDeliveryDate"])) {

	$ordersId = mysqli_real_escape_string($conn, $_POST["ordersId"]);
	$deliveryDate = mysqli_real_escape_string($conn, $_POST["deliveryDate"]);
	$statusDescription = "to receive";

	$sql = "UPDATE orders SET delivery_date = '$deliveryDate', status_description = '$statusDescription' WHERE id = $ordersId";

	if (mysqli_query($conn, $sql)) {

		$sql2 = "SELECT * FROM orders WHERE id = $ordersId";
		$result2 = mysqli_query($conn, $sql2);

		if (mysqli_num_rows($result2) > 0) {

			while ($row2 = mysqli_fetch_assoc($result2)) {

				$customersId = $row2["customers_id"];
				$title = "Arrange Order";
				$description = "The seller arranged the order";

				$sql2 = "INSERT INTO notifications (users_id, title, description, status) VALUES ($customersId, '$title', '$description', 1)";

				if (mysqli_query($conn, $sql2)) {

					header("Location: " . $baseUrl . "seller/orders?success");
					exit();

				}

			}

		}

	}

}

if (isset($_GET["deleteOrder"])) {

	$ordersId = mysqli_real_escape_string($conn, $_GET["id"]);

	$sql = "DELETE FROM orders WHERE id = $ordersId";

	if (mysqli_query($conn, $sql)) {
		
		header("Location: " . $baseUrl . "seller/orders?success");
		exit();

	}

}