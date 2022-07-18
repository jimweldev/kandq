<?php

$baseUrl = "../../../";

include $baseUrl . "assets/includes/dbh.inc.php";

session_start();

if (isset($_POST["rate"])) {

	$productsId = mysqli_real_escape_string($conn, $_POST["productsId"]);
	$customersId = $_SESSION["id"];
	$rating = mysqli_real_escape_string($conn, $_POST["rating"]);
	$review = mysqli_real_escape_string($conn, $_POST["review"]);

	$sql = "INSERT INTO ratings (products_id, customers_id, rating, review) VALUES ($productsId, $customersId, $rating, '$review')";

	if (mysqli_query($conn, $sql)) {

		$ordersId = mysqli_real_escape_string($conn, $_POST["ordersId"]);
		$statusDescription = 'completed';

		$sql = "UPDATE orders SET status_description = '$statusDescription' WHERE id = $ordersId";

		if (mysqli_query($conn, $sql)) {

			$sql2 = "SELECT * FROM orders WHERE id = $ordersId";
			$result2 = mysqli_query($conn, $sql2);

			if (mysqli_num_rows($result2) > 0) {

				while ($row2 = mysqli_fetch_assoc($result2)) {

					$sellersId = $row2["sellers_id"];
					$title = "Rate";
					$description = "The customer rated the order";

					$sql2 = "INSERT INTO notifications (users_id, title, description, status) VALUES ($sellersId, '$title', '$description', 1)";

					if (mysqli_query($conn, $sql2)) {

						header("Location: " . $baseUrl . "customer/order-history?success");
						exit();

					}

				}

			}	

		}

	}

	header("Location: " . $baseUrl . "customer/rate?error=SQL error");
	exit();

}