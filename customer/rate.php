<?php

$baseUrl = "../";
$page = "rate";

include $baseUrl . "assets/templates/customer/header.inc.php";

?>

<h1 class="h3 mb-3">Rate</h1>

<?php

$productsId = $_GET["id"];
// $ordersId = $_GET["ordersId"];

$sql = "SELECT * FROM products WHERE id = $productsId";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {

	while ($row = mysqli_fetch_assoc($result)) {

		echo "<div class='card'>";
			echo "<div class='card-body'>";
				echo "<div class='row'>";
					echo "<div class='col-lg-8'>";

						$sql2 = "SELECT * FROM product_images WHERE products_id = $productsId limit 1";
						$result2 = mysqli_query($conn, $sql2);

						while ($row2 = mysqli_fetch_assoc($result2)) {

							echo "<img class='card-img-top' src='" . $baseUrl . "assets/uploads/products/" . $row2["image"] . "'>";

						}

					echo "</div>";

					echo "<form class='col-lg-4' action='" . $baseUrl . "assets/includes/customer/rate.inc.php' method='POST'>";

						echo "<input type='hidden' name='productsId' value='" . $productsId . "'>";
						echo "<input type='hidden' name='ordersId' value='" . $ordersId . "'>";

						echo "<h5 class='card-title mb-0'>" . $row["name"] . "</h5>";
						echo "<div class='mb-3'>";
							echo "<i class='align-middle text-warning' data-feather='star'></i>";
							echo "<i class='align-middle text-warning' data-feather='star'></i>";
							echo "<i class='align-middle text-warning' data-feather='star'></i>";
							echo "<i class='align-middle text-warning' data-feather='star'></i>";
							echo "<i class='align-middle' data-feather='star'></i>";
						echo "</div>";

						echo "<p class='card-text'>" . $row["description"] . "</p>";

						echo "<hr>";

						echo "<label class='form-label'>Rate</label>";
						echo "<div class='mb-3 ms-3'>";
							echo "<label class='form-check'>";
								echo "<input class='form-check-input' type='radio' value='1' name='rating' checked>";
								echo "<span class='form-check-label'>";
									echo "<i class='align-middle text-warning' data-feather='star'></i>";
								echo "</span>";
							echo "</label>";
							echo "<label class='form-check'>";
								echo "<input class='form-check-input' type='radio' value='2' name='rating'>";
								echo "<span class='form-check-label'>";
									echo "<i class='align-middle text-warning' data-feather='star'></i>";
									echo "<i class='align-middle text-warning' data-feather='star'></i>";
								echo "</span>";
							echo "</label>";
							echo "<label class='form-check'>";
								echo "<input class='form-check-input' type='radio' value='3' name='rating'>";
								echo "<span class='form-check-label'>";
									echo "<i class='align-middle text-warning' data-feather='star'></i>";
									echo "<i class='align-middle text-warning' data-feather='star'></i>";
									echo "<i class='align-middle text-warning' data-feather='star'></i>";
								echo "</span>";
							echo "</label>";
							echo "<label class='form-check'>";
								echo "<input class='form-check-input' type='radio' value='4' name='rating'>";
								echo "<span class='form-check-label'>";
									echo "<i class='align-middle text-warning' data-feather='star'></i>";
									echo "<i class='align-middle text-warning' data-feather='star'></i>";
									echo "<i class='align-middle text-warning' data-feather='star'></i>";
									echo "<i class='align-middle text-warning' data-feather='star'></i>";
								echo "</span>";
							echo "</label>";
							echo "<label class='form-check'>";
								echo "<input class='form-check-input' type='radio' value='5' name='rating'>";
								echo "<span class='form-check-label'>";
									echo "<i class='align-middle text-warning' data-feather='star'></i>";
									echo "<i class='align-middle text-warning' data-feather='star'></i>";
									echo "<i class='align-middle text-warning' data-feather='star'></i>";
									echo "<i class='align-middle text-warning' data-feather='star'></i>";
									echo "<i class='align-middle text-warning' data-feather='star'></i>";
								echo "</span>";
							echo "</label>";
						echo "</div>";

						echo "<div class='mb-3'>";
							echo "<label class='form-label'>Review</label>";
							echo "<textarea class='form-control' rows='3' placeholder='Enter a review' name='review'></textarea>";
						echo "</div>";

						echo "<div class='d-grid gap-2'>";
							echo "<button class='btn btn-success rounded-pill' type='submit' name='rate'>Submit</button>";
						echo "</div>";
					echo "</form>";
				echo "</div>";
			echo "</div>";
		echo "</div>";

	}

}

?>

		

<?php

include $baseUrl . "assets/templates/customer/footer.inc.php";

?>