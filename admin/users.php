<?php

$baseUrl = "../";
$page = "users";

include $baseUrl . "assets/templates/admin/header.inc.php";

?>

<h1 class="h3 mb-3">Users</h1>

<div class="card">
	<div class="card-body">
		<table id="datatables-reponsive" class="table table-striped w-100">
			<thead>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Role</th>
				</tr>
			</thead>
			<tbody>

			<?php

			$sql = "SELECT * FROM users";
			$result = mysqli_query($conn, $sql);

			if (mysqli_num_rows($result) > 0) {

				while ($row = mysqli_fetch_assoc($result)) {

					echo "<tr>";
						echo "<td>" . $row["id"] . "</td>";
						echo "<td>" . $row["firstname"] . " " . $row["lastname"] . "</td>";
						echo "<td>" . $row["role"] . "</td>";
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