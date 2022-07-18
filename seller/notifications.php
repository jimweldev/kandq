<?php

$baseUrl = "../";
$page = "products";

include $baseUrl . "assets/templates/seller/header.inc.php";

?>

<h1 class="h3 mb-3">Notifications</h1>

<?php

$usersId = $_SESSION["id"];

$sql = "UPDATE notifications SET status = 0 WHERE users_id = $usersId AND status = 1";
$result = mysqli_query($conn, $sql);

$sql = "SELECT * FROM notifications WHERE users_id = $usersId ORDER BY id DESC";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {

	while ($row = mysqli_fetch_assoc($result)) {

		echo "<div class='card'>";
			echo "<div class='card-body'>";
				echo "<div class='row g-0 align-items-center'>";
					echo "<div class='col-1 d-flex justify-content-center'>";
						echo "<i class='text-warning' data-feather='bell'></i>";
					echo "</div>";
					echo "<div class='col-11'>";
						echo "<div class='text-dark'>" . $row["title"] . "</div>";
						echo "<div class='text-muted small mt-1'>" . $row["description"] . "</div>";
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