<?php

$baseUrl = "../";
$page = "orders";

include $baseUrl . "assets/templates/seller/header.inc.php";

?>

<?= alert(); ?>

<h1 class="h3 mb-3">Orders</h1>

<form class="input-group mb-4" action="<?= $baseUrl ?>assets/includes/seller/search.inc.php" method="POST">
	<input class="form-control form-control-lg" type="text" name="query" placeholder="Search items..">
	<button class="input-group-text btn-success" type="submit" name="searchOrders"><i class="align-middle" data-feather="search"></i></button>
</form>

<?php

$sellersId = $_SESSION["id"];
$query = isset($_GET["q"]) ? $_GET["q"] : "";

?>

<div class="card">
	<div class="card-header">
		<nav>
			<div class="nav nav-tabs" id="nav-tab" role="tablist">
				<button class="nav-link active" data-bs-toggle="tab" data-bs-target="#nav-1" type="button" role="tab">Pending</button>
				<button class="nav-link" data-bs-toggle="tab" data-bs-target="#nav-2" type="button" role="tab">To ship</button>
				<button class="nav-link" data-bs-toggle="tab" data-bs-target="#nav-3" type="button" role="tab">Cancelled</button>
			</div>
		</nav>
	</div>
	<div class="card-body">
		
		<div class="tab-content" id="nav-tabContent">
			<div class="tab-pane fade show active" id="nav-1" role="tabpanel">
				<div class="row">
					
					<?php 

					$sql = "SELECT orders.id as orders_id, products.id as products_id, products.name as name, orders.price as price, orders.quantity as quantity, orders.shipping_fee as shipping_fee FROM orders LEFT JOIN products ON orders.products_id = products.id WHERE (products.name LIKE '%$query%' OR products.description LIKE '%$query%') AND (orders.status_description = 'pending') AND orders.sellers_id = $sellersId AND orders.status = 1";
					$result = mysqli_query($conn, $sql);

					if (mysqli_num_rows($result) > 0) {

						while ($row = mysqli_fetch_assoc($result)) {

							echo "<div class='col-lg-4'>";
								echo "<div class='card shadow-none border'>";

									$productsId = $row["products_id"];

									$sql2 = "SELECT * FROM product_images WHERE products_id = $productsId LIMIT 1";
									$result2 = mysqli_query($conn, $sql2);

									while ($row2 = mysqli_fetch_assoc($result2)) {

										echo "<div class='ratio ratio-16x9'>";
											echo "<img class='rounded-top' src='" . $baseUrl . "assets/uploads/products/" . $row2["image"] . "'>";
										echo "</div>";

									}
									
									echo "<div class='card-body'>";
										echo "<h5 class='card-title mb-0'>" . $row["name"] . "</h5>";
										echo "<div class='mb-3'>";
											rating($row["products_id"]);
										echo "</div>";

										echo "<table class='w-100 mb-3'>";
											echo "<tr>";
												echo "<th>Price:</th>";
												echo "<td>???" . number_format($row["price"], 2) . "</td>";
											echo "</tr>";
											echo "<tr>";
												echo "<th>Quantity:</th>";
												echo "<td>x" . $row["quantity"] . "</td>";
											echo "</tr>";
											echo "<tr>";
												echo "<th>Shipping Fee:</th>";

												if ($row["shipping_fee"] == 0) {
													
													echo "<td>--</td>";

												} else {

													echo "<td>???" . $row["shipping_fee"] . "</td>";

												}

											echo "</tr>";
											echo "<tr>";
												echo "<td colspan='2'><hr></td>";
											echo "</tr>";
											echo "<tr>";
												echo "<th>Total Price:</th>";
												
												if ($row["shipping_fee"] == 0) {
													
													echo "<td>--</td>";

												} else {

													echo "<td>???" . number_format(($row["price"] * $row["quantity"] + $row["shipping_fee"]), 2) . "</td>";

												}

											echo "</tr>";
										echo "</table>";

										echo "<form class='input-group mb-4' action='" . $baseUrl . "assets/includes/seller/order.inc.php' method='POST'>";
											echo "<input type='hidden' name='ordersId' value='" . $row["orders_id"] . "'>";
											echo "<input class='form-control form-control-lg' type='number' min='0' name='shippingFee' placeholder='Set shipping fee..'>";
											echo "<button class='input-group-text btn-success' type='submit' name='setShippingFee'>Set Shipping Fee</button>";
										echo "</form>";
									echo "</div>";
								echo "</div>";
							echo "</div>";

						}

					} else {

					echo "<div class='col-12'>";
						echo "<div class='card shadow-none'>";
							echo "<div class='card-body'>";
								echo "<p class='lead mb-0'>No results..</p>";
							echo "</div>";
						echo "</div>";
					echo "</div>";

					}

					?>

				</div>
			</div>
			<div class="tab-pane fade" id="nav-2" role="tabpanel">
				<div class="row">
					
					<?php 

					$sql = "SELECT orders.id as orders_id, products.id as products_id, products.name as name, orders.price as price, orders.quantity as quantity, orders.shipping_fee as shipping_fee, orders.delivery_date as delivery_date FROM orders LEFT JOIN products ON orders.products_id = products.id WHERE (products.name LIKE '%$query%' OR products.description LIKE '%$query%') AND (orders.status_description = 'to receive' OR orders.status_description = 'to ship' OR orders.status_description = 'continued') AND orders.sellers_id = $sellersId AND orders.status = 1";
					$result = mysqli_query($conn, $sql);

					if (mysqli_num_rows($result) > 0) {

						while ($row = mysqli_fetch_assoc($result)) {

							echo "<div class='col-lg-4'>";
								echo "<div class='card shadow-none border'>";

									$productsId = $row["products_id"];

									$sql2 = "SELECT * FROM product_images WHERE products_id = $productsId LIMIT 1";
									$result2 = mysqli_query($conn, $sql2);

									while ($row2 = mysqli_fetch_assoc($result2)) {

										echo "<div class='ratio ratio-16x9'>";
											echo "<img class='rounded-top' src='" . $baseUrl . "assets/uploads/products/" . $row2["image"] . "'>";
										echo "</div>";

									}
									
									echo "<div class='card-body'>";
										echo "<h5 class='card-title mb-0'>" . $row["name"] . "</h5>";
										echo "<div class='mb-3'>";
											rating($row["products_id"]);
										echo "</div>";

										echo "<table class='w-100 mb-3'>";
											echo "<tr>";
												echo "<th>Price:</th>";
												echo "<td>???" . number_format($row["price"], 2) . "</td>";
											echo "</tr>";
											echo "<tr>";
												echo "<th>Quantity:</th>";
												echo "<td>x" . $row["quantity"] . "</td>";
											echo "</tr>";
											echo "<tr>";
												echo "<th>Shipping Fee:</th>";

												if ($row["shipping_fee"] == 0) {
													
													echo "<td>--</td>";

												} else {

													echo "<td>???" . $row["shipping_fee"] . "</td>";

												}

											echo "</tr>";
											echo "<tr>";
												echo "<td colspan='2'><hr></td>";
											echo "</tr>";
											echo "<tr>";
												echo "<th>Total Price:</th>";
												
												if ($row["shipping_fee"] == 0) {
													
													echo "<td>--</td>";

												} else {

													echo "<td>???" . number_format(($row["price"] * $row["quantity"] + $row["shipping_fee"]), 2) . "</td>";

												}

											echo "</tr>";
										echo "</table>";

										echo "<div class='d-grid gap-2'>";

											if ($row["delivery_date"] < date("Y-m-d")) {
												
												echo "<a class='btn btn-success rounded-pill' href='./arrange-shipment?id=" . $row["orders_id"] . "'>Arrange Shipment</a>";

											} else {

												echo "<a class='btn btn-success rounded-pill' href='./view/arrange-shipment?id=" . $row["orders_id"] . "'>View Arrange Shipment</a>";

											}

											
										echo "</div>";
									echo "</div>";
								echo "</div>";
							echo "</div>";

						}

					} else {

					echo "<div class='col-12'>";
						echo "<div class='card shadow-none'>";
							echo "<div class='card-body'>";
								echo "<p class='lead mb-0'>No results..</p>";
							echo "</div>";
						echo "</div>";
					echo "</div>";

					}

					?>

				</div>
			</div>
			<div class="tab-pane fade" id="nav-3" role="tabpanel">
				<div class="row">
					
					<?php 

					$sql = "SELECT orders.id as orders_id, products.id as products_id, products.name as name, orders.price as price, orders.quantity as quantity, orders.shipping_fee as shipping_fee FROM orders LEFT JOIN products ON orders.products_id = products.id WHERE (products.name LIKE '%$query%' OR products.description LIKE '%$query%') AND orders.sellers_id = $sellersId AND orders.status = 0";
					$result = mysqli_query($conn, $sql);

					if (mysqli_num_rows($result) > 0) {

						while ($row = mysqli_fetch_assoc($result)) {

							echo "<div class='col-lg-4'>";
								echo "<div class='card shadow-none border'>";

									$productsId = $row["products_id"];

									$sql2 = "SELECT * FROM product_images WHERE products_id = $productsId LIMIT 1";
									$result2 = mysqli_query($conn, $sql2);

									while ($row2 = mysqli_fetch_assoc($result2)) {

										echo "<div class='ratio ratio-16x9'>";
											echo "<img class='rounded-top' src='" . $baseUrl . "assets/uploads/products/" . $row2["image"] . "'>";
										echo "</div>";

									}
									
									echo "<div class='card-body'>";
										echo "<h5 class='card-title mb-0'>" . $row["name"] . "</h5>";
										echo "<div class='mb-3'>";
											rating($row["products_id"]);
										echo "</div>";

										echo "<table class='w-100 mb-3'>";
											echo "<tr>";
												echo "<th>Price:</th>";
												echo "<td>???" . number_format($row["price"], 2) . "</td>";
											echo "</tr>";
											echo "<tr>";
												echo "<th>Quantity:</th>";
												echo "<td>x" . $row["quantity"] . "</td>";
											echo "</tr>";
										echo "</table>";

										echo "<div class='d-grid gap-2'>";
											echo "<a class='btn btn-danger rounded-pill' data-bs-toggle='modal' data-bs-target='#deleteModal' data-bs-name='" . $row["name"] . "' data-bs-href='" . $baseUrl . "assets/includes/seller/order.inc.php?deleteOrder&id=" . $row["orders_id"] . "'>Delete</a>";
										echo "</div>";
									echo "</div>";
								echo "</div>";
							echo "</div>";

						}

					} else {

					echo "<div class='col-12'>";
						echo "<div class='card shadow-none'>";
							echo "<div class='card-body'>";
								echo "<p class='lead mb-0'>No results..</p>";
							echo "</div>";
						echo "</div>";
					echo "</div>";

					}

					?>

				</div>
			</div>
		</div>

	</div>
</div>

<?php

include $baseUrl . "assets/templates/seller/footer.inc.php";

?>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Delete Order</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<p>Are you sure you want to delete <strong class="data"></strong>?</p>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
				<a href="#" class="btn btn-danger data">Delete</a>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	var deleteModal = document.getElementById('deleteModal')

	deleteModal.addEventListener('show.bs.modal', function (event) {
		var button = event.relatedTarget

		var name = button.getAttribute('data-bs-name')
		var modalBodyName = deleteModal.querySelector('.modal-body .data')
		modalBodyName.innerHTML = name

		var href = button.getAttribute('data-bs-href')
		var modalFooterHref = deleteModal.querySelector('.modal-footer .data')
		modalFooterHref.href = href;
	})
</script>