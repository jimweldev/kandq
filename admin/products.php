<?php

$baseUrl = "../";
$page = "products";

include $baseUrl . "assets/templates/admin/header.inc.php";

?>

<h1 class="h3 mb-3">Products</h1>

<div class="card">
	<div class="card-body">
		<table id="datatables-reponsive" class="table table-striped w-100">
			<thead>
				<tr>
					<th>ID</th>
					<th>Seller</th>
					<th>Product</th>
					<th>Price</th>
					<th>Stocks</th>
				</tr>
			</thead>
			<tbody>

			<?php

			$sql = "SELECT * FROM products";
			$result = mysqli_query($conn, $sql);

			if (mysqli_num_rows($result) > 0) {

				while ($row = mysqli_fetch_assoc($result)) {

					echo "<tr>";
						echo "<td>" . $row["id"] . "</td>";
						echo "<td>" . $row["sellers_id"] . "</td>";
						echo "<td>" . $row["name"] . "</td>";
						echo "<td>₱" . number_format($row["price"], 2) . "</td>";
						echo "<td>x" . $row["stocks"] . "</td>";
					echo "</tr>";

				}

			}

			?>

			</tbody>
		</table>
	</div>
</div>

<?php

include $baseUrl . "assets/templates/admin/footer.inc.php";

?>