<?php

$baseUrl = "../../";
$page = "products";

include $baseUrl . "assets/templates/seller/header.inc.php";

?>

<h1 class="h3 mb-3">View Product</h1>

<?php

$productsId = $_GET["id"];

$sql = "SELECT * FROM products WHERE id = $productsId";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {

	while ($row = mysqli_fetch_assoc($result)) {

		echo "<div class='card'>";
			echo "<div class='card-body'>";
				echo "<div class='row'>";
					echo "<div class='col-lg-4'>";
						echo "<h5 class='card-title mb-0'>" . $row["name"] . "</h5>";
						echo "<div class='mb-3'>";
							rating($row["id"]);
						echo "</div>";

						echo "<p class='card-text'>" . $row["description"] . "</p>";

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
					echo "</div>";

					echo "<div class='col-lg-8'>";
						echo "<div class='row g-3'>";

							$sql2 = "SELECT * FROM product_images WHERE products_id = $productsId";
							$result2 = mysqli_query($conn, $sql2);

							while ($row2 = mysqli_fetch_assoc($result2)) {

								echo "<div class='col-lg-6 flex-fill'>";
									echo "<a data-fancybox='gallery' data-src='" . $baseUrl . "/assets/uploads/products/" . $row2["image"] . "'>";
										echo "<div class='ratio ratio-16x9'>";
											echo "<img class='rounded w-100' src='" . $baseUrl . "/assets/uploads/products/" . $row2["image"] . "'>";
										echo "</div>";
									echo "</a>";
								echo "</div>";

							}

						echo "</div>";
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