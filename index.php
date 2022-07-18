<?php

$baseUrl = "./";
$page = "home";

include $baseUrl . "assets/templates/home/header.inc.php";

?>

<div id="carousel" class="carousel carousel-dark slide" data-bs-ride="carousel">
	<div class="carousel-indicators">
		<button type="button" data-bs-target="#carousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
		<button type="button" data-bs-target="#carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
		<button type="button" data-bs-target="#carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
	</div>
  
	<div class="carousel-inner">
		<div class="carousel-item active">
			<img src="./assets/img/photos/carousel-1.png" class="d-block w-100">
		</div>
		<div class="carousel-item">
			<img src="./assets/img/photos/carousel-2.png" class="d-block w-100">
		</div>
		<div class="carousel-item">
			<img src="./assets/img/photos/carousel-3.png" class="d-block w-100">
		</div>
	</div>

	<button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="visually-hidden">Previous</span>
	</button>
	<button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="visually-hidden">Next</span>
	</button>
</div>

<div class="py-5 px-4" id="about">
	<div class="container">

		<div class="row">
			<div class="col-lg-6 text-center mx-auto">
				
				<h1 class="display-4 text-success">About Us</h1>

				<p class="lead">Welcome to K&Q DIY Accessories. We offer Assorted Acrylic Letter Beads, Small Glass Beads, Fashion Seed Beads Strand Necklace, A-Z Initial Letter Pendant Bracelet, Women Personalized Mutilayer Gold Bracelet Fashion Vintage Charm, Friendship Bracelet, and many more.</p>

			</div>
		</div>

	</div>
</div>

<div class="py-5 px-4 bg-success">
	<div class="container">

		<h1 class="display-4 text-white text-center">Recent Products</h1>

		<?php

		$query = isset($_GET["q"]) ? $_GET["q"] : "";

		echo "<div class='row'>";

			$sql = "SELECT * FROM products WHERE stocks <> 0 ORDER BY name DESC LIMIT 3";
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
								echo "<h5 class='card-title mb-0'>Product Name</h5>";
								echo "<div class='mb-3'>";
									rating($row["id"]);
								echo "</div>";

								echo "<table class='w-100 mb-3'>";
									echo "<tr>";
										echo "<th>Price:</th>";
										echo "<td>₱" . number_format($row["price"], 2) . "</td>";
									echo "</tr>";
									echo "<tr>";
										echo "<th>Stocks:</th>";
										echo "<td>x" . $row["stocks"] . "</td>";
									echo "</tr>";
								echo "</table>";

								echo "<div class='d-grid gap-'>";
									echo "<a class='btn btn-success rounded-pill' href='./view/product?id=" . $row["id"] . "'>Product Details</a>";
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

	</div>
</div>

<?php

$baseUrl = "./";

include $baseUrl . "assets/templates/home/footer.inc.php";

?>