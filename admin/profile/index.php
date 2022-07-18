<?php

$baseUrl = "../../";
$page = "profile";

include $baseUrl . "assets/templates/admin/header.inc.php";

?>

<h1 class="h3 mb-3">Profile</h1>

<?php

$usersId = $_SESSION["id"];

$sql = "SELECT * FROM users WHERE id = $usersId";
$result = mysqli_query($conn, $sql);


while ($row = mysqli_fetch_assoc($result)) {

	echo "<div class='card'>";
		echo "<div class='card-body'>";
			echo "<div class='row'>";
				echo "<div class='col-lg-4'>";
					echo "<div class='list-group'>";
						echo "<a href='" . $baseUrl . "admin/profile' class='list-group-item list-group-item-action active'>
						Update Profile
						</a>";
						echo "<a href='" . $baseUrl . "admin/profile/complete-address' class='list-group-item list-group-item-action'>Complete Address</a>";
						echo "<a href='" . $baseUrl . "admin/profile/change-password' class='list-group-item list-group-item-action'>Change Password</a>";
					echo "</div>";
				echo "</div>";

				echo "<div class='col-lg-8'>";
					echo "<h5 class='card-title mb-4'>Update Profile</h5>";

					echo "<div class='text-center mb-4'>";
						echo "<img alt='Charles Hall' src='" . $baseUrl . "assets/uploads/profiles/" . $row["profile"] . "' class='rounded img-responsive mt-2'
							width='128' height='128' />";
					echo "</div>";

					echo "<form action='" . $baseUrl . "assets/includes/admin/profile.inc.php' method='POST' enctype='multipart/form-data'>";
						echo "<div class='mb-3'>";
							echo "<label class='form-label'>Name</label>";
							echo "<div class='row g-3'>";
								echo "<div class='col-lg-6'>";
									echo "<input class='form-control form-control-lg' type='text' placeholder='First name' name='firstname' value='" . $row["firstname"] . "'>";
								echo "</div>";
								echo "<div class='col-lg-6'>";
									echo "<input class='form-control form-control-lg' type='text' placeholder='Last name' name='lastname' value='" . $row["lastname"] . "'>";
								echo "</div>";
							echo "</div>";
						echo "</div>";

						echo "<div class='mb-3'>";
							echo "<label class='form-label'>Contact No</label>";
							echo "<input class='form-control form-control-lg' type='text' placeholder='Enter your contact no' name='contactNo' value='" . $row["contact_no"] . "'>";
						echo "</div>";

						echo "<div class='mb-3'>";
							echo "<label class='form-label'>Profile Image</label>";
							echo "<input class='form-control form-control-lg' type='file' accept='image/*' name='image' />";
						echo "</div>";

						echo "<div class='mb-3'>";
							echo "<label class='form-label'>Password</label>";
							echo "<input class='form-control form-control-lg' type='password' placeholder='Enter your password' name='password'>";
						echo "</div>";

						echo "<div class='text-center mt-3'>";
							echo "<button class='btn btn-lg btn-success' type='submit' name='updateProfile'>Update</button>";
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