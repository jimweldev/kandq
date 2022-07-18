<?php

$baseUrl = "../../";
$page = "profile";

include $baseUrl . "assets/templates/admin/header.inc.php";

?>

<h1 class="h3 mb-3">Profile</h1>

<?php

$usersId = $_SESSION["id"];

$sql = "SELECT * FROM complete_address WHERE users_id = $usersId";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {

	echo "<div class='card'>";
		echo "<div class='card-body'>";
			echo "<div class='row'>";
				echo "<div class='col-lg-4'>";
					echo "<div class='list-group'>";
						echo "<a href='" . $baseUrl . "admin/profile' class='list-group-item list-group-item-action'>
						Update Profile
						</a>";
						echo "<a href='" . $baseUrl . "admin/profile/complete-address' class='list-group-item list-group-item-action active'>Complete Address</a>";
						echo "<a href='" . $baseUrl . "admin/profile/change-password' class='list-group-item list-group-item-action'>Change Password</a>";
					echo "</div>";
				echo "</div>";

				echo "<div class='col-lg-8'>";
					echo "<h5 class='card-title mb-4'>Complete Address</h5>";

					echo "<form action='" . $baseUrl . "assets/includes/admin/profile.inc.php' method='POST' enctype='multipart/form-data'>";
						echo "<div class='mb-3'>";
							echo "<div class='row g-3'>";
								echo "<div class='col-lg-7'>";
									echo "<label class='form-label'>Address</label>";
									echo "<input class='form-control form-control-lg' type='text' placeholder='Address' name='address' value='" . $row["address"] . "'>";
								echo "</div>";
								echo "<div class='col-lg-5'>";
									echo "<label class='form-label'>Barangay</label>";
									echo "<input class='form-control form-control-lg' type='text' placeholder='Barangay' name='barangay' value='" . $row["barangay"] . "'>";
								echo "</div>";
							echo "</div>";
						echo "</div>";

						echo "<div class='mb-3'>";
							echo "<div class='row g-3'>";
								echo "<div class='col-lg-5'>";
									echo "<label class='form-label'>City/Municipality</label>";
									echo "<input class='form-control form-control-lg' type='text' placeholder='City/Municipality' name='city' value='" . $row["city"] . "'>";
								echo "</div>";
								echo "<div class='col-lg-5'>";
									echo "<label class='form-label'>Province</label>";
									echo "<input class='form-control form-control-lg' type='text' placeholder='Province' name='province' value='" . $row["province"] . "'>";
								echo "</div>";
								echo "<div class='col-lg-2'>";
									echo "<label class='form-label'>Zip</label>";
									echo "<input class='form-control form-control-lg' type='text' placeholder='Zip' name='zip' value='" . $row["zip"] . "'>";
								echo "</div>";
							echo "</div>";
						echo "</div>";

						echo "<div class='mb-3'>";
							echo "<label class='form-label'>Password</label>";
							echo "<input class='form-control form-control-lg' type='password' placeholder='Enter your password' name='password'>";
						echo "</div>";

						echo "<div class='text-center mt-3'>";
							echo "<button class='btn btn-lg btn-success' type='submit' name='updateAddress'>Update</button>";
						echo "</div>";
					echo "</form>";
				echo "</div>";
			echo "</div>";
		echo "</div>";
	echo "</div>";

}

?>

<?php

include $baseUrl . "assets/templates/admin/footer.inc.php";

?>