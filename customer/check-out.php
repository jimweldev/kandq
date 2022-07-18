<?php

$baseUrl = "../";
$page = "cart";

include $baseUrl . "assets/templates/customer/header.inc.php";

?>

<div class="d-flex justify-content-between align-items-center mb-3">
	<h1 class="h3 mb-0">Check Out</h1>
	<a class="btn btn-dark" href="./cart">Back</a>
</div>

<?php

$productsId = $_GET["id"];
$query = isset($_GET["q"]) ? $_GET["q"] : "";

$sql = "SELECT carts.id as carts_id, products.id as id, products.name as name, products.price as price, products.stocks as stocks, carts.quantity as quantity FROM carts LEFT JOIN products ON carts.products_id = products.id WHERE carts.id = $productsId AND (products.name LIKE '%$query%' OR products.description LIKE '%$query%') AND status = 1 ORDER BY id DESC";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {

	while ($row = mysqli_fetch_assoc($result)) {

		echo "<div class='card'>";
			echo "<div class='card-body'>";
				
				echo "<div class='row'>";
					echo "<div class='col-lg-7'>";
						echo "<h1 class='h1 mb-0'>" . $row["name"] . "</h1>";
						echo "<div class='mb-3'>";
							rating($row["id"]);
						echo "</div>";

						$productsId = $row["id"];

						$sql2 = "SELECT * FROM product_images WHERE products_id = $productsId limit 1";
						$result2 = mysqli_query($conn, $sql2);

						while ($row2 = mysqli_fetch_assoc($result2)) {

							echo "<img class='rounded w-100' src='" . $baseUrl . "assets/uploads/products/" . $row2["image"] . "'>";

						}
						
					echo "</div>";

					echo "<div class='col-lg-5'>";
						echo "<div class='d-flex justify-content-between align-items-center mb-3'>";
							echo "<h1 class='h3 mb-0'>Delivery Address</h1>";

							echo "<a class='btn btn-info' href='" . $baseUrl . "customer/profile/complete-address'><i class=' me-1' data-feather='edit'></i> <span class='align-middle'>Edit</span></a>";
						echo "</div>";

						$usersId = $_SESSION["id"];

						$sql2 = "SELECT * FROM users WHERE id = $usersId";
						$result2 = mysqli_query($conn, $sql2);

						while ($row2 = mysqli_fetch_assoc($result2)) {

							echo "<p class='mb-0'>" . $row2["firstname"] . " " . $row2["lastname"] . " | " . $row2["contact_no"] ."</p>";
							
							$sql3 = "SELECT * FROM complete_address WHERE users_id = $usersId";
							$result3 = mysqli_query($conn, $sql3);

							while ($row2 = mysqli_fetch_assoc($result3)) {

								if (empty($row2["address"]) || empty($row2["barangay"]) || empty($row2["city"]) || empty($row2["province"]) || empty($row2["zip"])) {
									
									echo "<p class='rounded bg-warning text-white mt-2 p-2'><i data-feather='alert-circle'></i> <strong>Address Not Complete.</strong> Please update your address</p>";

									$isAddressComplete = false;

								} else {

									echo "<p class='mb-0'>" . $row2["address"] . ", " . $row2["barangay"] . "</p>";
									echo "<p class='mb-0'>" . $row2["city"] . ", " . $row2["province"] . "</p>";
									echo "<p class=''>" . $row2["zip"] . "</p>";

									$isAddressComplete = true;

								}

							}

						}

						echo "<h1 class='h3'>Order</h1>";

						echo "<table class='w-100 mb-4'>";
							echo "<tr>";
								echo "<th>Price:</th>";
								echo "<td>₱" . number_format($row["price"], 2) . "</td>";
							echo "</tr>";
							echo "<tr>";
								echo "<th>Quantity:</th>";
								echo "<td>x" . $row["quantity"] . "</td>";
							echo "</tr>";
							echo "<tr>";
								echo "<th>Shipping Fee:</th>";
								echo "<td>--</td>";
							echo "</tr>";
							echo "<tr>";
								echo "<td colspan='2'><hr></td>";
							echo "</tr>";
							echo "<tr>";
								echo "<th>Total:</th>";
								echo "<td>₱" . number_format($row["price"] * $row["quantity"], 2) . " + Shipping Fee</td>";
							echo "</tr>";
						echo "</table>";

						echo "<h1 class='h3'>Payment Method</h1>";

						echo "<form action='" . $baseUrl . "assets/includes/customer/order.inc.php' method='POST'>";
							echo "<input type='hidden' name='cartsId' value='" . $row["carts_id"] . "'>";
							echo "<input type='hidden' name='customersId' value='" . $_SESSION["id"] . "'>";

							// SELLERS ID
							$productsId = $row["id"];

							$sql3 = "SELECT * FROM products WHERE id = $productsId";
							$result3 = mysqli_query($conn, $sql3);

							while ($row3 = mysqli_fetch_assoc($result3)) {

								echo "<input type='hidden' name='sellersId' value='" . $row3["sellers_id"] . "'>";								

							}

							echo "<input type='hidden' name='productsId' value='" . $row["id"] . "'>";
							echo "<input type='hidden' name='quantity' value='" . $row["quantity"] . "'>";
							echo "<input type='hidden' name='price' value='" . ($row["price"] * $row["quantity"]) . "'>";
							echo "<input type='hidden' name='stocks' value='" . $row["stocks"] . "'>";
							echo "<div class='mb-3 ms-3'>";
								echo "<label class='form-check'>";
									echo "<input class='form-check-input' type='radio' value='Cash on Delivery' name='modeOfPayment' checked>";
									echo "<span class='form-check-label'>";
										echo "Cash on Delivery";
									echo "</span>";
								echo "</label>";
								echo "<label class='form-check'>";
									echo "<input class='form-check-input' type='radio' value='GCash' name='modeOfPayment'>";
									echo "<span class='form-check-label'>";
										echo "GCash";
									echo "</span>";
								echo "</label>";
								echo "<label class='form-check'>";
									echo "<input class='form-check-input' type='radio' value='PayMaya' name='modeOfPayment'>";
									echo "<span class='form-check-label'>";
										echo "PayMaya";
									echo "</span>";
								echo "</label>";
							echo "</div>";

							if (!$isAddressComplete) {

								echo "<div class='d-grid gap-2'>";
									echo "<a class='btn btn-success rounded-pill disabled'>Place Order</a>";
								echo "</div>";

							} else {

								echo "<div class='d-grid gap-2'>";
									echo "<button class='btn btn-success rounded-pill' type='submit' name='placeOrder'>Place Order</button>";
								echo "</div>";

							}

						echo "</form>";
						
					echo "</div>";
				echo "</div>";

			echo "</div>";
		echo "</div>";

	}

} else {

	echo "<div class='col-12'>";
		echo "<div class='card'>";
			echo "<div class='card-body'>";
				echo "<p class='lead mb-0'>No results..</p>";
			echo "</div>";
		echo "</div>";
	echo "</div>";
	
}

?>

<?php

include $baseUrl . "assets/templates/customer/footer.inc.php";

?>