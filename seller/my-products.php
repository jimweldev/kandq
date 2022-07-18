<?php

$baseUrl = "../";
$page = "myProducts";

include $baseUrl . "assets/templates/seller/header.inc.php";

?>

<div class="d-flex justify-content-between align-items-center mb-3">
	<h1 class="h3 mb-0">My Products</h1>

	<a class="btn btn-info" href="./add/product">Add</a>
</div>

<form class="input-group mb-4" action="<?= $baseUrl ?>assets/includes/seller/search.inc.php" method="POST">
	<input class="form-control form-control-lg" type="text" name="query" placeholder="Search items..">
	<button class="input-group-text btn-success" type="submit" name="searchMyProducts"><i class="align-middle" data-feather="search"></i></button>
</form>

<?php

$sellersId = $_SESSION["id"];
$query = isset($_GET["q"]) ? $_GET["q"] : "";

echo "<div class='row'>";

	$sql = "SELECT * FROM products WHERE stocks <> 0 AND (name LIKE '%$query%' OR description LIKE '%$query%') AND sellers_id = $sellersId ORDER BY name ASC";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {

		while ($row = mysqli_fetch_assoc($result)) {

			echo "<div class='col-lg-4'>";
				
				echo "<div class='card'>";

					$productsId = $row["id"];

					$sql2 = "SELECT * FROM product_images WHERE products_id = $productsId limit 1";
					$result2 = mysqli_query($conn, $sql2);

					while ($row2 = mysqli_fetch_assoc($result2)) {

						echo "<div class='ratio ratio-16x9 rounded-top'>";
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
						echo "</table>";

						echo "<a class='btn btn-info btn-sm' href='./view/my-product?id=" . $row["id"] . "'>View</a> ";
						echo "<a class='btn btn-primary btn-sm' href='./edit/my-product?id=" . $row["id"] . "'>Edit</a> ";
						echo "<a class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#deleteModal' data-bs-name='" . $row["name"] . "' data-bs-href='" . $baseUrl . "assets/includes/seller/product.inc.php?deleteProduct&id=" . $row["id"] . "'>Delete</a> ";
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

echo "</div>";

?>

<?php

include $baseUrl . "assets/templates/seller/footer.inc.php";

?>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Delete Product</h5>
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