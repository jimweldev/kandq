<?php

function value($get) {

	if (isset($_GET[$get])) {

		echo $_GET[$get];

	}

}

function page($page, $active) {

	if ($page == $active) {
		
		echo "active";

	}

}

function alert() {

	if (isset($_GET["success"])) {
		
		echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
			echo "<i class='align-middle me-2' data-feather='check-circle'></i>";
			echo "<strong>Success!</strong>";
			echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
		echo "</div>";

	} else if (isset($_GET["error"])) {

		echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>";
			echo "<i class='align-middle me-2' data-feather='alert-circle'></i>";
			echo "<strong>Error!</strong> " . $_GET["error"];
			echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
		echo "</div>";

	} else if (isset($_GET["info"])) {

		echo "<div class='alert alert-info alert-dismissible fade show' role='alert'>";
			echo "<i class='align-middle me-2' data-feather='alert-circle'></i>";
			echo "<strong>Info!</strong> " . $_GET["info"];
			echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
		echo "</div>";

	}

}

function allowedRole($baseUrl, $role) {

	if ($_SESSION["role"] != $role) {

		header("Location: " . $baseUrl);
		exit();
		
	}
}

function rating($productId) {

	global $conn;

	$sql = "SELECT AVG(rating) as rating FROM ratings WHERE products_id = $productId";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {

		$row = mysqli_fetch_assoc($result);

		if ($row["rating"] >= 4.5) {
			
			echo "<i class='align-middle text-warning' data-feather='star'></i>";
			echo "<i class='align-middle text-warning' data-feather='star'></i>";
			echo "<i class='align-middle text-warning' data-feather='star'></i>";
			echo "<i class='align-middle text-warning' data-feather='star'></i>";
			echo "<i class='align-middle text-warning' data-feather='star'></i>";

		} else if ($row["rating"] >= 3.5) {

			echo "<i class='align-middle text-warning' data-feather='star'></i>";
			echo "<i class='align-middle text-warning' data-feather='star'></i>";
			echo "<i class='align-middle text-warning' data-feather='star'></i>";
			echo "<i class='align-middle text-warning' data-feather='star'></i>";
			echo "<i class='align-middle' data-feather='star'></i>";

		} else if ($row["rating"] >= 2.5) {

			echo "<i class='align-middle text-warning' data-feather='star'></i>";
			echo "<i class='align-middle text-warning' data-feather='star'></i>";
			echo "<i class='align-middle text-warning' data-feather='star'></i>";
			echo "<i class='align-middle' data-feather='star'></i>";
			echo "<i class='align-middle' data-feather='star'></i>";

		} else if ($row["rating"] >= 1.5) {

			echo "<i class='align-middle text-warning' data-feather='star'></i>";
			echo "<i class='align-middle text-warning' data-feather='star'></i>";
			echo "<i class='align-middle' data-feather='star'></i>";
			echo "<i class='align-middle' data-feather='star'></i>";
			echo "<i class='align-middle' data-feather='star'></i>";

		} else if ($row["rating"] >= 0.5) {

			echo "<i class='align-middle text-warning' data-feather='star'></i>";
			echo "<i class='align-middle' data-feather='star'></i>";
			echo "<i class='align-middle' data-feather='star'></i>";
			echo "<i class='align-middle' data-feather='star'></i>";
			echo "<i class='align-middle' data-feather='star'></i>";

		} else {

			echo "<p class='text-muted'>no ratings yet..</p>";

		}
		

	} else {

		echo "<p class='text-muted'>No ratings yet..</p>";

	}

}