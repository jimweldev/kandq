<?php

$baseUrl = "../";
$page = "orderHistory";

include $baseUrl . "assets/templates/seller/header.inc.php";

?>

<h1 class="h3 mb-3">Order History</h1>

<form class="input-group mb-4" action="" method="POST">
	<input class="form-control form-control-lg" type="text" name="query" placeholder="Search items..">
	<button class="input-group-text btn-success" type="submit" name=""><i class="align-middle" data-feather="search"></i></button>
</form>

<?php 

$sellersId = $_SESSION["id"];
$query = isset($_GET["q"]) ? $_GET["q"] : "";

$sql = "SELECT orders.id as orders_id, products.id as products_id, products.name as name, products.description as description, orders.price as price, orders.quantity as quantity, orders.shipping_fee as shipping_fee, orders.total_price as total_price, orders.delivery_date as delivery_date FROM orders LEFT JOIN products ON orders.products_id = products.id WHERE (products.name LIKE '%$query%' OR products.description LIKE '%$query%') AND (orders.status_description = 'completed') AND orders.status = 1 AND orders.sellers_id = $sellersId ORDER BY orders.id DESC";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {

	while ($row = mysqli_fetch_assoc($result)) {

		echo "<div class='card'>";
			echo "<div class='card-body'>";
				echo "<div class='row'>";
					echo "<div class='col-lg-8'>";

						$productsId = $row["products_id"];

						$sql2 = "SELECT * FROM product_images WHERE products_id = $productsId limit 1";
						$result2 = mysqli_query($conn, $sql2);

						while ($row2 = mysqli_fetch_assoc($result2)) {

							echo "<img class='card-img-top' src='" . $baseUrl . "assets/uploads/products/" . $row2["image"] . "'>";

						}

					echo "</div>";

					echo "<div class='col-lg-4'>";
						echo "<h5 class='card-title mb-0'>" . $row["name"] . "</h5>";
						echo "<div class='mb-3'>";
							rating($row["products_id"]);
						echo "</div>";

						echo "<p class='card-text'>" . $row["description"] . "</p>";

						echo "<table class='w-100 mb-0'>";
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
								echo "<td>₱" . number_format($row["shipping_fee"], 2) . "</td>";
							echo "</tr>";
							echo "<tr>";
								echo "<td colspan='2'><hr></td>";
							echo "</tr>";
							echo "<tr>";
								echo "<th>Total Price:</th>";
								echo "<td>₱" . number_format($row["total_price"], 2) . "</td>";
							echo "</tr>";
						echo "</table>";
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

<?php

include $baseUrl . "assets/templates/seller/footer.inc.php";

?>