<?php

$baseUrl = "../../";
$page = "seller";

include $baseUrl . "assets/templates/customer/header.inc.php";

?>

<h1 class="h3 mb-3">Seller</h1>

<?php

$query = isset($_GET["q"]) ? $_GET["q"] : "";

$sellersId = $_GET["id"];

$sql = "SELECT * FROM users WHERE id = $sellersId";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {

	echo "<div class='d-flex mb-5'>";
		echo "<img class='rounded me-4' width='20%' src='" . $baseUrl . "assets/uploads/profiles/" . $row["profile"] . "'>";

		echo "<div>";
			echo "<h2 class='mb-2'>" . $row["firstname"] . " " . $row["lastname"] . "</h2>";
			echo "<p>" .  $row["contact_no"] . "</p>";
		echo "</div>";
	echo "</div>";

}

?>

<form class="input-group mb-4" action="<?= $baseUrl ?>assets/includes/customer/search.inc.php" method="POST">
	<input type="hidden" name="sellersId" value="<?= $_GET["id"]; ?>">
	<input class="form-control form-control-lg" type="text" name="query" placeholder="Search items..">
	<button class="input-group-text btn-success" type="submit" name="searchSellerProducts"><i class="align-middle" data-feather="search"></i></button>
</form>

<?php

// $sellersId = $_SESSION["id"];
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
								echo "<td>???" . number_format($row["price"], 2) . "</td>";
							echo "</tr>";
							echo "<tr>";
								echo "<th>Stocks:</th>";
								echo "<td>x" . $row["stocks"] . "</td>";
							echo "</tr>";
						echo "</table>";

						echo "<div class='d-grid gap-'>";
							echo "<a class='btn btn-success rounded-pill' href='./product?id=" . $row["id"] . "'>Product Details</a>";
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

include $baseUrl . "assets/templates/customer/footer.inc.php";

?>