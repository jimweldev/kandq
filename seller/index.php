<?php

$baseUrl = "../";
$page = "dashboard";

include $baseUrl . "assets/templates/seller/header.inc.php";

?>

<h1 class="h3 mb-3">Dashboard</h1>

<div class="row">
	<div class="col-lg-4">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col mt-0">
						<h5 class="card-title">Products</h5>
					</div>

					<div class="col-auto">
						<div class="stat text-primary">
							<i class="align-middle" data-feather="truck"></i>
						</div>
					</div>
				</div>
				<h1 class="mt-1 mb-0">
					
				<?php

				$sellersId = $_SESSION["id"];

				$sql = "SELECT COUNT(id) as count FROM products WHERE sellers_id = $sellersId";
				$result = mysqli_query($conn, $sql);

				if (mysqli_num_rows($result) > 0) {

					while ($row = mysqli_fetch_assoc($result)) {

						echo $row["count"];

					}

				}

				?>

				</h1>
			</div>
		</div>
	</div>

	<div class="col-lg-4">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col mt-0">
						<h5 class="card-title">Sales</h5>
					</div>

					<div class="col-auto">
						<div class="stat text-primary">
							<i class="align-middle" data-feather="truck"></i>
						</div>
					</div>
				</div>
				<h1 class="mt-1 mb-0">

				<?php

				$sellersId = $_SESSION["id"];

				$sql = "SELECT COUNT(id) as count FROM orders WHERE sellers_id = $sellersId AND (status_description = 'completed' OR status_description = 'to rate')";
				$result = mysqli_query($conn, $sql);

				if (mysqli_num_rows($result) > 0) {

					while ($row = mysqli_fetch_assoc($result)) {

						echo $row["count"];

					}

				}

				?>

				</h1>
			</div>
		</div>
	</div>

	<div class="col-lg-4">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col mt-0">
						<h5 class="card-title">Total Earnings</h5>
					</div>

					<div class="col-auto">
						<div class="stat text-primary">
							<i class="align-middle" data-feather="truck"></i>
						</div>
					</div>
				</div>
				<h1 class="mt-1 mb-0">
					
				<?php

				$sellersId = $_SESSION["id"];

				$sql = "SELECT SUM(price) as sum FROM orders WHERE sellers_id = $sellersId AND (status_description = 'completed' OR status_description = 'to rate')";
				$result = mysqli_query($conn, $sql);

				if (mysqli_num_rows($result) > 0) {

					while ($row = mysqli_fetch_assoc($result)) {

						echo "₱" . number_format($row["sum"] - ($row["sum"] * 5) / 100, 2);

					}

				}

				?>

				</h1>
			</div>
		</div>
	</div>
</div>

<div class="card">
	<div class="card-header">
		<h5 class="card-title">Sales</h5>
	</div>
	<div class="card-body">
		<table id="datatables-reponsive" class="table table-striped w-100">
			<thead>
				<tr>
					<th>ID</th>
					<th>Seller</th>
					<th>Product</th>
					<th>Price</th>
					<th>Commission</th>
					<th>Earning</th>
				</tr>
			</thead>
			<tbody>

			<?php

			$sql = "SELECT * FROM orders WHERE (status_description = 'completed' OR status_description = 'to rate') AND sellers_id = $sellersId";
			$result = mysqli_query($conn, $sql);

			if (mysqli_num_rows($result) > 0) {

				while ($row = mysqli_fetch_assoc($result)) {

					echo "<tr>";
						echo "<td>" . $row["id"] . "</td>";

						$sql2 = "SELECT * FROM users WHERE id = $sellersId";
						$result2 = mysqli_query($conn, $sql2);

						while ($row2 = mysqli_fetch_assoc($result2)) {

							echo "<td>" . $row2["firstname"] . " " . $row2["lastname"] . "</td>";

						}

						$productsId = $row["products_id"];

						$sql2 = "SELECT * FROM products WHERE id = $productsId";
						$result2 = mysqli_query($conn, $sql2);

						while ($row2 = mysqli_fetch_assoc($result2)) {

							echo "<td>" . $row2["name"] . "</td>";

						}

						echo "<td>₱" . number_format($row["price"], 2) . "</td>";
						echo "<td>₱" . number_format(($row["price"] * 5) / 100, 2) . "</td>";
						echo "<td>₱" . number_format($row["price"] - (($row["price"] * 5) / 100), 2) . "</td>";
					echo "</tr>";

				}

			}

			?>

			</tbody>
		</table>
	</div>
</div>

<?php

include $baseUrl . "assets/templates/seller/footer.inc.php";

?>