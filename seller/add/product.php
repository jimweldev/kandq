<?php

$baseUrl = "../../";
$page = "myProducts";

include $baseUrl . "assets/templates/seller/header.inc.php";

?>

<?= alert(); ?>

<div class="d-flex justify-content-between align-items-center mb-3">
	<h1 class="h3 mb-0">Add Product</h1>

	<a class="btn btn-info" href="../my-products">Back</a>
</div>

<?php

$usersId = $_SESSION["id"];

$sql = "SELECT * FROM complete_address WHERE users_id = $usersId";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {

	if (empty($row["address"]) || empty($row["barangay"]) || empty($row["city"]) || empty($row["province"]) || empty($row["zip"])) {
		
		echo "<div class='card'>";
			echo "<div class='card-body'>";
				echo "<p class='lead mb-0'>Kindly update your <a href='../../seller/profile/complete-address'>address</a> first..</p>";
			echo "</div>";
		echo "</div>";

	} else {

		echo "<div class='card'>";
			echo "<form class='card-body' action='" . $baseUrl . "assets/includes/seller/product.inc.php' method='POST' enctype='multipart/form-data'>";
				echo "<div class='row'>";
					echo "<div class='col-lg-6'>";
						echo "<div class='mb-3'>";
							echo "<label class='form-label'>Product Name</label>";
							echo "<input class='form-control form-control-lg' type='text' placeholder='Enter product name' name='name' required>";
						echo "</div>";

						echo "<div class='mb-3'>";
							echo "<label class='form-label'>Product Description</label>";
							echo "<textarea class='form-control' rows='5' placeholder='Enter product description' name='description' required></textarea>";
						echo "</div>";
					echo "</div>";

					echo "<div class='col-lg-6'>";
						echo "<div class='mb-3'>";
							echo "<label class='form-label'>Price</label>";
							echo "<input class='form-control form-control-lg' type='number' placeholder='Enter product price' name='price' step='0.25' required>";
						echo "</div>";

						echo "<div class='mb-3'>";
							echo "<label class='form-label'>Stocks</label>";
							echo "<input class='form-control form-control-lg' type='number' placeholder='Enter product quantity' name='stocks' required>";
						echo "</div>";

						echo "<div class='mb-3'>";
							echo "<label class='form-label'>Images</label>";
							echo "<input class='form-control form-control-lg' type='file' multiple accept='image/*' name='images[]' required>";
						echo "</div>";
					echo "</div>";

					echo "<div class='text-center mt-3'>";
						echo "<button class='btn btn-lg btn-success' type='submit' name='addProduct'>Confirm</button>";
					echo "</div>";
				echo "</div>	";
			echo "</form>";
		echo "</div>";

	}

}

?>

<?php

include $baseUrl . "assets/templates/seller/footer.inc.php";

?>