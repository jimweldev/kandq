<?php

$baseUrl = "../";
$page = "verification";

include $baseUrl . "assets/templates/admin/header.inc.php";

?>

<h1 class="h3 mb-3">Seller Verification</h1>

<div class="row">
	<div class="col-lg-4">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col mt-0">
						<h5 class="card-title">Total Products</h5>
					</div>

					<div class="col-auto">
						<div class="stat text-primary">
							<i class="align-middle" data-feather="truck"></i>
						</div>
					</div>
				</div>
				<h1 class="mt-1 mb-0">

				<?php

				$sql = "SELECT COUNT(id) as count FROM products";
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
						<h5 class="card-title">Total Sales</h5>
					</div>

					<div class="col-auto">
						<div class="stat text-primary">
							<i class="align-middle" data-feather="truck"></i>
						</div>
					</div>
				</div>
				<h1 class="mt-1 mb-0">
					
				<?php

				$sql = "SELECT COUNT(id) as count FROM orders WHERE (status_description = 'completed' OR status_description = 'to rate')";
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
						<h5 class="card-title">Total Commission</h5>
					</div>

					<div class="col-auto">
						<div class="stat text-primary">
							<i class="align-middle" data-feather="truck"></i>
						</div>
					</div>
				</div>
				<h1 class="mt-1 mb-0">

				<?php

				$sql = "SELECT SUM(price) as sum FROM orders WHERE (status_description = 'completed' OR status_description = 'to rate')";
				$result = mysqli_query($conn, $sql);

				if (mysqli_num_rows($result) > 0) {

					while ($row = mysqli_fetch_assoc($result)) {

						echo "₱" . number_format(($row["sum"] * 5) / 100, 2);

					}

				}

				?>

				</h1>
			</div>
		</div>
	</div>
</div>

<?php

include $baseUrl . "assets/templates/admin/footer.inc.php";

?>