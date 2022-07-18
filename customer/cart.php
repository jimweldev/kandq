<?php

$baseUrl = "../";
$page = "cart";

include $baseUrl . "assets/templates/customer/header.inc.php";

?>

<?= alert(); ?>

<h1 class="h3 mb-3">My Cart</h1>

<form class="input-group mb-4" action="<?= $baseUrl ?>assets/includes/customer/search.inc.php" method="POST">
	<input class="form-control form-control-lg" type="text" name="query" placeholder="Search items..">
	<button class="input-group-text btn-success" type="submit" name="searchCart"><i class="align-middle" data-feather="search"></i></button>
</form>

<?php

$customersId = $_SESSION["id"];
$query = isset($_GET["q"]) ? $_GET["q"] : "";

?>

<div class="row">
	
	<?php

	$sql = "SELECT carts.id as carts_id, products.id as id, products.name as name, products.price as price, products.stocks as stocks, carts.quantity as quantity FROM carts LEFT JOIN products ON carts.products_id = products.id WHERE customers_id = $customersId AND (products.name LIKE '%$query%' OR products.description LIKE '%$query%') AND status = 1 ORDER BY id DESC";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {

		while ($row = mysqli_fetch_assoc($result)) {

			echo "<div class='col-lg-4'>";
		
				echo "<div class='card'>";
					
					$productsId = $row["id"];

					$sql2 = "SELECT * FROM product_images WHERE products_id = $productsId limit 1";
					$result2 = mysqli_query($conn, $sql2);

					while ($row2 = mysqli_fetch_assoc($result2)) {

						echo "<div class='ratio ratio-16x9'>";
							echo "<img class='rounded-top' src='" . $baseUrl . "assets/uploads/products/" . $row2["image"] . "'>";
						echo "</div>";

					}

					echo "<div class='card-body'>";
						echo "<h5 class='card-title mb-0'>" . $row["name"] . "</h5>";
						echo "<div class='mb-3'>";
							rating($row["id"]);
						echo "</div>";

						echo "<table class='w-100 mb-3'>";
							echo "<tr>";
								echo "<th>Price:</th>";
								echo "<td>₱" . number_format($row["price"], 2) . "</td>";
							echo "</tr>";
							echo "<tr>";
								echo "<th>Stocks:</th>";
								echo "<td>x" . $row["stocks"] . "</td>";
							echo "</tr>";
							echo "<tr>";
								echo "<th>Quantity:</th>";
								echo "<td>x" . $row["quantity"] . "</td>";
							echo "</tr>";
						echo "</table>";

						echo "<form class='input-group mb-4' action='" . $baseUrl . "assets/includes/customer/cart.inc.php' method='POST'>";
							echo "<input type='hidden' name='productsId' value='" . $row["id"] . "'>";
							echo "<input class='form-control form-control-lg text-center' type='number' min='1' max='" . $row["stocks"] . "' value='" . $row["quantity"] . "' name='quantity' placeholder='Set quantity..'>";
							echo "<button class='input-group-text btn-success' type='submit' name='setQuantity'>Set Quantity</button>";
						echo "</form>";

						echo "<div class='d-grid gap-2'>";
							echo "<a class='btn btn-success rounded-pill' href='./check-out?id=" . $row["carts_id"] . "'>Buy Now</a>";
							echo "<a class='btn btn-danger rounded-pill' data-bs-toggle='modal' data-bs-target='#removeModal' data-bs-name='Product Name' data-bs-href='" . $baseUrl . "assets/includes/customer/cart.inc.php?removeToCart&id=" . $row["carts_id"] . "'>Remove</a>";
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

</div>

<?php

include $baseUrl . "assets/templates/customer/footer.inc.php";

?>

<div class="modal fade" id="removeModal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Remove to Cart</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<p>Are you sure you want to remove <strong class="data"></strong> from your cart?</p>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
				<a href="#" class="btn btn-danger data">Remove</a>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	var removeModal = document.getElementById('removeModal')

	removeModal.addEventListener('show.bs.modal', function (event) {
		var button = event.relatedTarget

		var name = button.getAttribute('data-bs-name')
		var modalBodyName = removeModal.querySelector('.modal-body .data')
		modalBodyName.innerHTML = name

		var href = button.getAttribute('data-bs-href')
		var modalFooterHref = removeModal.querySelector('.modal-footer .data')
		modalFooterHref.href = href;
	})
</script>