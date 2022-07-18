<?php

$baseUrl = "../../";
$page = "orders";

include $baseUrl . "assets/templates/seller/header.inc.php";

?>

<div class="d-flex justify-content-between align-items-center mb-3">
	<h1 class="h3 mb-0">Arrange Shipment</h1>
	<a class="btn btn-dark" href="../orders">Back</a>
</div>

<?php

$ordersId = $_GET["id"];
$query = isset($_GET["q"]) ? $_GET["q"] : "";

$sql = "SELECT orders.id as orders_id, products.id as products_id, orders.customers_id as customers_id, orders.sellers_id as sellers_id, products.name as name, orders.delivery_date as delivery_date, orders.price as price, orders.quantity as quantity, orders.shipping_fee as shipping_fee, orders.total_price as total_price
FROM orders
LEFT JOIN products
ON orders.products_id = products.id WHERE orders.id = $ordersId";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {

	while ($row = mysqli_fetch_assoc($result)) {

		echo "<div class='card'>";
			echo "<div class='card-body'>";
				
				echo "<div class='row'>";
					echo "<div class='col-lg-7'>";
						echo "<h1 class='h1 mb-0'>" . $row["name"] . "</h1>";
						echo "<div class='mb-3'>";
							rating($row["products_id"]);
						echo "</div>";

						$productsId = $row["products_id"];

						$sql2 = "SELECT * FROM product_images WHERE products_id = $productsId limit 1";
						$result2 = mysqli_query($conn, $sql2);

						while ($row2 = mysqli_fetch_assoc($result2)) {

							echo "<img class='rounded w-100' src='" . $baseUrl . "assets/uploads/products/" . $row2["image"] . "'>";

						}
						
					echo "</div>";

					echo "<div class='col-lg-5'>";
						echo "<h1 class='h3 mb-3'>Waybill</h1>";

						echo "<table class='table table-bordered w-100 mb-3'>";
							echo "<tr>";
								echo "<th>Order ID</th>";
								echo "<td>" . $row["orders_id"] . "</td>";
							echo "</tr>";
							echo "<tr>";
								echo "<th>Delivery Date</th>";
								echo "<td>" . date('M d, Y', strtotime($row["delivery_date"])) . "</td>";
							echo "</tr>";
							echo "<tr>";
								echo "<th>To</th>";
								echo "<td>";

									$customersId = $row["customers_id"];

									$sql3 = "SELECT * FROM complete_address WHERE users_id = $customersId";
									$result3 = mysqli_query($conn, $sql3);

									while ($row3 = mysqli_fetch_assoc($result3)) {

										$sql4 = "SELECT * FROM users WHERE id = $customersId";
										$result4 = mysqli_query($conn, $sql4);

										while ($row4 = mysqli_fetch_assoc($result4)) {

											echo "<p class='mb-0'>" . $row4["firstname"] . " " . $row4["lastname"] . " | " . $row4["contact_no"] . "</p>";

										}

										
										echo "<p class='mb-0'>" . $row3["address"] . ", " . $row3["barangay"] . "</p>";
										echo "<p class='mb-0'>" . $row3["city"] . ", " . $row3["province"] . "</p>";
										echo "<p class='mb-0'>" . $row3["zip"] . "</p>";

									}
										
								echo "</td>";
							echo "</tr>";
							echo "<tr>";
								echo "<th>From</th>";
								echo "<td>";

									$sellersId = $row["sellers_id"];

									$sql3 = "SELECT * FROM complete_address WHERE users_id = $sellersId";
									$result3 = mysqli_query($conn, $sql3);

									while ($row3 = mysqli_fetch_assoc($result3)) {

										$sql4 = "SELECT * FROM users WHERE id = $sellersId";
										$result4 = mysqli_query($conn, $sql4);

										while ($row4 = mysqli_fetch_assoc($result4)) {

											echo "<p class='mb-0'>" . $row4["firstname"] . " " . $row4["lastname"] . " | " . $row4["contact_no"] . "</p>";

										}

										
										echo "<p class='mb-0'>" . $row3["address"] . ", " . $row3["barangay"] . "</p>";
										echo "<p class='mb-0'>" . $row3["city"] . ", " . $row3["province"] . "</p>";
										echo "<p class='mb-0'>" . $row3["zip"] . "</p>";

									}
										
								echo "</td>";
							echo "</tr>";
							echo "<tr>";
								echo "<td colspan='2'>";
									echo "<table class='w-100'>";
										echo "<tr>";
											echo "<th>Price:</th>";
											echo "<td>₱" . $row["price"] . "</td>";
										echo "</tr>";
										echo "<tr>";
											echo "<th>Quantity:</th>";
											echo "<td>x" . $row["quantity"] . "</td>";
										echo "</tr>";
										echo "<tr>";
											echo "<th>Shipping Fee:</th>";
											echo "<td>₱" . $row["shipping_fee"] . "</td>";
										echo "</tr>";
										echo "<tr>";
											echo "<td colspan='2'><hr></td>";
										echo "</tr>";
										echo "<tr>";
											echo "<th>Total Price:</th>";
											echo "<td>₱" . $row["total_price"] . "</td>";
										echo "</tr>";
									echo "</table>";
								echo "</td>";
							echo "</tr>";
										
						echo "</table>";

						// echo "<form class='input-group mb-4' action='" . $baseUrl . "assets/includes/seller/order.inc.php' method='POST'>";
						// 	echo "<input type='hidden' name='ordersId' value='" . $row["orders_id"] . "'>";
						// 	echo "<input class='form-control form-control-lg' type='date' name='deliveryDate' placeholder='Set Delivery Date..'>";
						// 	echo "<button class='input-group-text btn-success' type='submit' name='setDeliveryDate'>Set Delivery Date</button>";
						// echo "</form>";
					echo "</div>";
				echo "</div>";

			echo "</div>";
		echo "</div>";

	}

}

?>

<?php

include $baseUrl . "assets/templates/seller/footer.inc.php";

?>