<?php

$baseUrl = "../";
$page = "products";

include $baseUrl . "assets/templates/seller/header.inc.php";

?>

<h1 class="h3 mb-3">Products</h1>

<form class="input-group mb-4" action="<?= $baseUrl ?>assets/includes/seller/search.inc.php" method="POST">
	<input class="form-control form-control-lg" type="text" name="query" placeholder="Search items..">
	<button class="input-group-text btn-success" type="submit" name="searchProducts"><i class="align-middle" data-feather="search"></i></button>
</form>

<?php

$query = isset($_GET["q"]) ? $_GET["q"] : "";

echo "<div class='row'>";

	$sql = "SELECT * FROM products WHERE stocks <> 0 AND (name LIKE '%$query%' OR description LIKE '%$query%') ORDER BY name ASC";
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

						echo "<div class='d-grid gap-'>";
							echo "<a class='btn btn-success rounded-pill' href='./view/product?id=" . $row["id"] . "'>Product Details</a>";
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

echo "</div>";

?>

<?php

include $baseUrl . "assets/templates/seller/footer.inc.php";

?>